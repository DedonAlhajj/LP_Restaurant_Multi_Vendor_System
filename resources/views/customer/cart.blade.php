{{-- 1. عرض السلة (cart.index ) :


.

2. إضافة عنصر إلى السلة (cart.add):
يمكنك إضافة زر لإضافة عنصر إلى السلة من صفحة المنتج:

<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $product->id }}">
    <input type="hidden" name="name" value="{{ $product->name }}">
    <input type="hidden" name="price" value="{{ $product->price }}">
    <input type="number" name="quantity" value="1" min="1">
    <button type="submit">إضافة إلى السلة</button>
</form>

3.
 تحديث الكمية في السلة (cart.update):
تم تضمين تحديث الكمية في السلة داخل الـ View السابق الخاص بعرض السلة. النموذج الخاص بالتحديث يكون بهذا الشكل:

<form action="{{ route('cart.update') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1">
    <button type="submit">تحديث</button>
</form>

4. إزالة عنصر من السلة (cart.remove):
يمكنك استخدام هذا النموذج لإزالة عنصر محدد من السلة:
<form action="{{ route('cart.remove') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $item->id }}">
    <button type="submit">إزالة</button>
</form>

5. إفراغ السلة بالكامل (cart.clear):
هذا النموذج يستخدم لإفراغ السلة بشكل كامل:
<form action="{{ route('cart.clear') }}" method="POST">
    @csrf
    <button type="submit">إفراغ السلة</button>
</form>
--}}

{{-- @dd(Session::get('cart')) --}}



أولاً، سنقوم بإنشاء جدول لحفظ اللايكات لكل عنصر طعام.

Schema::create('likes', function (Blueprint $table) {
    $table->id(); // المفتاح الأساسي
    $table->foreignId('food_item_id')->constrained('food_items')->onDelete('cascade'); // الربط مع جدول الطعام
    $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade'); // الربط مع جدول الزبائن
    $table->timestamps(); // الوقت الذي تم فيه إضافة أو إزالة اللايك
});


2. إعداد الموديل Like:

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['food_item_id', 'customer_id'];

    // علاقة مع موديل الطعام
    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }

    // علاقة مع موديل الزبائن
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

3


. إعداد FoodItem Model للعلاقة مع اللايكات:
لإضافة العلاقة بين FoodItem واللايكات:
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    // علاقة مع اللايكات
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // للتحقق إذا قام الزبون بإضافة لايك
    public function isLikedByCustomer($customerId)
    {
        return $this->likes()->where('customer_id', $customerId)->exists();
    }
}


4. إنشاء LikeController للتحكم في اللايكات:
namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // إضافة أو إزالة اللايك
    public function toggleLike($foodItemId)
    {
        $customerId = Auth::guard('customer')->id(); // جلب ID الزبون المصادق عليه

        // التحقق إذا قام الزبون بإضافة لايك مسبقاً
        $existingLike = Like::where('food_item_id', $foodItemId)
            ->where('customer_id', $customerId)
            ->first();

        if ($existingLike) {
            // إذا كان اللايك موجود، نقوم بإزالته
            $existingLike->delete();
            return response()->json(['message' => 'Like removed successfully']);
        } else {
            // إذا لم يكن اللايك موجود، نقوم بإضافته
            Like::create([
                'food_item_id' => $foodItemId,
                'customer_id' => $customerId
            ]);
            return response()->json(['message' => 'Like added successfully']);
        }
    }

    // عرض عدد اللايكات لعنصر طعام محدد
    public function getLikesCount($foodItemId)
    {
        $likesCount = Like::where('food_item_id', $foodItemId)->count();
        return response()->json(['likes_count' => $likesCount]);
    }
}


5. إضافة الراوتات:
نضيف الراوتات للتحكم في اللايكات:
use App\Http\Controllers\LikeController;

// إضافة أو إزالة لايك
Route::post('/food-items/{foodItemId}/like', [LikeController::class, 'toggleLike'])
    ->middleware('auth:customer') // التأكد أن الزبون مصادق عليه
    ->name('food-items.like');

// جلب عدد اللايكات لعنصر معين
Route::get('/food-items/{foodItemId}/likes-count', [LikeController::class, 'getLikesCount'])
    ->name('food-items.likes-count');




مثال على الـ Blade:
<!-- عرض اللايك -->
<button id="like-button-{{ $foodItem->id }}" onclick="toggleLike({{ $foodItem->id }})">
    @if($foodItem->isLikedByCustomer(auth('customer')->id()))
        Unlike
    @else
        Like
    @endif
</button>

<script>
    function toggleLike(foodItemId) {
        fetch(`/food-items/${foodItemId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            // تحديث زر اللايك هنا إذا أردت
        })
        .catch(error => console.error('Error:', error));
    }
</script>



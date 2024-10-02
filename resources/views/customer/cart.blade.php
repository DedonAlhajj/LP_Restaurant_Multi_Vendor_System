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

@dd(Session::get('cart'))
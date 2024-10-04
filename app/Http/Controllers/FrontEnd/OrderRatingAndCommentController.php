<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\FoodItem;
use App\Models\RatingAndComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderRatingAndCommentController extends Controller
{
    //<p>التقييم: {{ number_format($foodItem->average_rating, 1) }}</p>
    // عرض صفحة إضافة تقييم وتعليق
    public function create($foodItemId)
    {
        $foodItem = FoodItem::findOrFail($foodItemId);
        return view('customer.ratings-comments.create', compact('foodItem'));
    }

    // دالة لإضافة تقييم وتعليق
    public function store(Request $request, $foodItemId,$vendor_slug)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // التأكد من وجود الطعام
            $foodItem = FoodItem::findOrFail($foodItemId);

            // إنشاء التقييم والتعليق
            RatingAndComment::create([
                'food_item_id' => $foodItem->id,
                'customer_id' => auth('customer')->id(),
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment'] ?? null,
            ]);

            DB::commit();
            return redirect()->route('customer.ratings-comments.index', ['vendor_slug' => $vendor_slug])
                ->with('success', 'Rating and comment added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while adding the rating and comment.']);
        }
    }

    // عرض صفحة تعديل التقييم والتعليق
    public function edit($id)
    {
        $ratingComment = RatingAndComment::where('id', $id)
            ->where('customer_id', auth('customer')->id())
            ->firstOrFail();

        return view('ratings-comments.edit', compact('ratingComment'));
    }

    // دالة لتعديل التقييم والتعليق
    public function update(Request $request, $id,$vendor_slug)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $ratingComment = RatingAndComment::where('id', $id)
                ->where('customer_id', auth('customer')->id())
                ->firstOrFail();

            // تحديث التقييم والتعليق
            $ratingComment->update($validatedData);

            DB::commit();
            return redirect()->route('customer.ratings-comments.index', ['vendor_slug' => $vendor_slug])
                ->with('success', 'Rating and comment updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'An error occurred while updating the rating and comment.']);
        }
    }

    // دالة لحذف التقييم والتعليق
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $ratingComment = RatingAndComment::where('id', $id)
                ->where('customer_id', auth('customer')->id())
                ->firstOrFail();

            $ratingComment->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Rating and comment deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'An error occurred while deleting the rating and comment.']);
        }
    }

    // دالة لعرض التقييمات والتعليقات الخاصة بمنتج طعام معين
    public function index($foodItemId)
    {
        try {
            $foodItem = FoodItem::findOrFail($foodItemId);
            $ratingsAndComments = RatingAndComment::where('food_item_id', $foodItem->id)
                ->with('customer')
                ->latest()
                ->get();

            return view('customer.ratings-comments.index', compact('foodItem', 'ratingsAndComments'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'An error occurred while fetching the ratings and comments.']);
        }
    }
}

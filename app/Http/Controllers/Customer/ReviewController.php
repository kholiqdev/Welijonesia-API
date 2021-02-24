<?php

namespace App\Http\Controllers\Customer;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\GetReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetReviewRequest $request
     * @return json
     */
    public function index(GetReviewRequest $request)
    {
        try {
            $review = Review::query();
            $review->with(['user']);
            
            if ($request->has('seller_id')) $review->where('seller_id', $request->seller_id);
            if ($request->has('product_id')) $review->where('product_id', $request->product_id);

            $limit = $request->input('limit', 6);

            return ResponseFormatter::success(
                ['review' => $review->paginate($limit)],

                $review->count() . ' Ulasan ditemukan'
            );
        } catch (\Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }
}

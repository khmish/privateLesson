<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewStoreRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ReviewCollection;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\ReviewCollection
     */
    public function index(Request $request)
    {
        $reviews = Review::all();

        return new ReviewCollection($reviews);
    }

    public function avarageUser(Request $request)
    {
        $reviews = Review::all();

        return new ReviewCollection($reviews);
    }

    /**
     * @param \App\Http\Requests\ReviewStoreRequest $request
     * @return \App\Http\Resources\ReviewResource
     */
    public function store(ReviewStoreRequest $request)
    {
        $hasReview=Review::where('teacher_id',$request->teacher_id)->where('student_id',$request->student_id)->first();
        if($hasReview){

            $review = Review::create($request->validated());
    
            return response(["data"=>$hasReview],201);
        }
        
        return response(['message','you already have voted!'],400);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Review $review
     * @return \App\Http\Resources\ReviewResource
     */
    public function show(Request $request, Review $review)
    {
        return new ReviewResource($review);
    }
    public function getRating(Request $request)
    {
        $hasReview=Review::where('teacher_id',$request->teacher_id)->where('student_id',$request->student_id)->firstOrFail();
        return response(["data"=>$hasReview],200);
    }

    /**
     * @param \App\Http\Requests\ReviewUpdateRequest $request
     * @param \App\Models\Review $review
     * @return \App\Http\Resources\ReviewResource
     */
    public function update(ReviewUpdateRequest $request, Review $review)
    {
        $review->update($request->validated());

        return new ReviewResource($review);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Review $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Review $review)
    {
        $review->delete();

        return response()->noContent();
    }
}

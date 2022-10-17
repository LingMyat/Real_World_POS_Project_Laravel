<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // review list
    public function reviewList(){
        $data = Review::select('reviews.*','users.image','users.name')
        ->join('users','users.id','reviews.user_id')
        ->paginate(6);
        return view('admin.Review.list',compact('data'));
    }

    // delete Review
    public function deleteReview(Review $id){
        $id->delete();
        return to_route('admin#reviewList');
    }
}

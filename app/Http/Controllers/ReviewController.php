<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    public function store(Request $request, $productid)
    {
        $user = Auth::user();

        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string|max:65535',
        ]);

        $existingReview = Review::where('user_id', $user->id)->where('product_id', $productid)->first();

        if ($existingReview){
            return redirect()->back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini.');
        }

        Review::create([
            'user_id' => $user->id,
            'product_id' => $productid,
            'rating' => $request->input('rating'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil disimpan.');
    }
}

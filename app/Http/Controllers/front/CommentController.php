<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only([

            'commentUpdate', 'commentStore'

        ]);
    }

    public function commentStore(Request $request, $id)
    {
        $request->validate(
            [
                'comment' => 'required'
            ],
            [
                'comment.required' => 'التعليق لا يجب ان يكون فارغ'
            ]);
        $product = Product::findOrFail($id);

        Comment::create([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'comment' => $request->comment
        ]);
        return redirect()->route('show-product', ['id' => $product->id, '#comments']);
    }

    public function commentUpdate($id, Request $request)
    {
        $request->validate(
            [
                'comment' => 'required'
            ],
            [
                'comment.required' => 'التعليق لا يجب ان يكون فارغ'
            ]);
            
        $comment = Comment::findOrFail($id);
        if ($comment->user_id == auth()->user()->id) {

            $comment->update(['comment' => $request->comment]);
        }
        return redirect()->route('show-product', ['id' => $comment->product_id, '#comments']);
    }
}

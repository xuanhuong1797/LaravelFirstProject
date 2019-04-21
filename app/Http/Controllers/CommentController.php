<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index', 'show');
    }

    public function store(Request $request)
    {
        $comment = new Comment();
        $user = Auth::user();
        $product = Product::findOrFail($request->id);
        $comment->user_id = $user->id;
        $comment->product_id = $product->id;
        $arrayFirst = array_first($request->data);
        //Check if request has comment
        if ($arrayFirst['name'] == 'commentBody') {
            $comment->body = $arrayFirst['value'];
        }
        $comment->save();
        //Check if have star ranking
        $arrayLast = array_last($request->data);
        if ($arrayLast['name'] == 'rating') {
            $rating = new Rating();
            $rating->user_id = $user->id;
            $rating->product_id = $product->id;
            $rating->comment_id = $comment->id;
            $rating->value = $arrayLast['value'];
            $rating->save();
        }
    }

    public function destroy(Request $request)
    {
        $comment = Comment::find($request->id)->delete();
    }

    public function update(Request $request)
    {
        $comment = Comment::find($request->id);
        $commentData = array_first($request->data);
        $rating = Rating::where('comment_id', $comment->id)->first();
        if ($rating) {
            $ratingData = array_last($request->data);
            $rating->value = $ratingData['value'];
            $rating->save();
        }
        $comment->body = $commentData['value'];
        $comment->save();

        return $comment;
    }

    public function addReply(Request $request)
    {
        $comment = new Comment();
        $product = Product::find($request->idProduct);
        $comment->user_id = Auth::user()->id;
        $comment->product_id = $product->id;
        $comment->parent_id = $request->idComment;
        $commentData = array_first($request->data);
        if ($commentData['name'] == 'commentBody') {
            $comment->body = $commentData['value'];
        }
        $comment->save();

        return $comment;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        if (Gate::allows('delete-comment', $comment)) {
            $comment->delete();
            return back()->with("info", "Comment deleted");
        }


        return back()->with("info", "Unauthorize");
    }

    public function create(Request $request)
    {
        // @dd($request->all());
        $comment = request()->validate([
            "content" => "required",
            "article_id" => "required"
        ]);

        $comment = new Comment;
        $comment->content = trim($request->content);
        $comment->article_id = $request->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        return back();
    }
}

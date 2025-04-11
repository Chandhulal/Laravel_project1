<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function course_home()
    {
        $comment = Comment::all();
        return view(
            'templates.course_home',
            [
                "comments" => $comment,
            ]
        );
    }

    public function create()
    {
        $user = Auth::user();
        Comment::create([
            'user_id' => $user->id,
            'comment' => request()->comment,
            'parent_id' => null,
        ]);
        return redirect("/course_home");
    }

    public function add_replay($id)
    {
        $user = Auth::user();
        Comment::create([
            'user_id' => $user->id,
            'comment' => request()->replay,
            'parent_id' => $id,
        ]);
        return redirect("/course_home");
    }
}

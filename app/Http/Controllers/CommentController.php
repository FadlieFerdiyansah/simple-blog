<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Post $post)
    {
        if(!auth()->user()){
            $user = 0;
        }elseif(auth()->user()->id > 0){
            $user = auth()->user()->id;
        }

        $comment = Comment::create([
            'comment' => request('comment'),
            'parent_id' => 0,
            'post_id' => $post->id,
            'user_id' => $user
        ]);

        return back();
    }
}

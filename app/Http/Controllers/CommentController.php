<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'img-id' => 'integer|required',
            'comment' => 'string|required',
        ]);
        $img_id = $request->input('img-id');
        $content = $request->input('comment');
        $user = Auth::user();

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $img_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detail', ['id' => $img_id])
            ->with(['message' => 'The comment has been published']);
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $user = Auth::user();

        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return redirect()->route('image.detail', ['id' => $comment->image->id])
                ->with(['message' => 'The comment has been deleted']);
        }
    }
}

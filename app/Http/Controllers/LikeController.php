<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function like($image_id)
    {
        $user = Auth::user();

        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();

        if ($isset_like == 0) {
            $like = new Like;
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
            $like->save();
            return response()->json([
                'like' => $like,
            ]);
        } else {

            return redirect()->route('dislike', ['image_id' => $image_id]);
        }
    }
    public function dislike($image_id)
    {
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();

        if ($like) {
            $like->delete();
            return response()->json([
                'like' => $like,
            ]);
        } else {
            return redirect()->route('like', ['image_id' => $image_id]);

        }
    }
    public function viewLikes()
    {
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('id', 'desc')->simplePaginate(3);
        return view('like.viewLikes', [
            'likes' => $likes,
        ]);

    }

}

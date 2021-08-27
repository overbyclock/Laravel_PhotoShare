<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('image.create');
    }
    public function save(Request $request)
    {
        $description = $request->input('description');
        $image_res = $request->file('image');

        $validation = $this->validate($request, [
            'description' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        $user = Auth::user();

        $image = new Image;
        $image->user_id = $user->id;
        $image->description = $description;

        if ($image) {
            $image_name = time() . $image_res->getClientOriginalName();
            Storage::disk('images')->put($image_name, File::get($image_res));
            $image->image_path = $image_name;
        }
        $image->save();

        return redirect()->route('home')
            ->with(['message' => 'Success upload']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }
    public function detail($id)
    {
        $image = Image::find($id);
        return view('image.detail', [
            'image' => $image,
        ]);
    }
    public function delete($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        if ($user && $image && $image->user->id == $user->id) {
            if ($comments && count($comments) > 1) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            if ($likes && count($likes) > 1) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            Storage::disk('images')->delete($image->image_path);
            $image->delete();
            $msg = 'OK, image deleted';
        } else {
            $msg = 'I can not delete the image';
        }
        return redirect()->route('home')->with(['message' => $msg]);
    }
    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', [
                'image' => $image,
            ]);
        } else {
            return redirect()->route('home');
        }
    }
    public function update(Request $request)
    {
        $image_id = $request->input('image_id');
        $description = $request->input('description');
        $image_res = $request->file('image');

        $validation = $this->validate($request, [
            'description' => 'required|string|max:255',
            'image' => 'image',
        ]);

        $image = Image::find($image_id);

        if ($image_res) {
            $image_name = time() . $image_res->getClientOriginalName();
            Storage::disk('images')->put($image_name, File::get($image_res));
            $image->image_path = $image_name;
        }

        if ($description) {
            $image->description = $description;
            $image->update();
        }

        return redirect()->route('image.detail', ['id' => $image_id])
            ->with(['message' => 'The image has been updated']);

    }

}

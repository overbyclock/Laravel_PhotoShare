<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function settings()
    {
        return view('user.settings');
    }

    public function update(Request $request)
    {

        $user = Auth::user();
        $id = Auth::user()->id;

        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        $image = $request->file('image');

        /*$validate = $this->validate($request,[
        'name'    => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        'nick'    => ['required','string','max:255','unique:users,nick:'.$nick],
        'email'   => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'image'   => ['required', 'string', 'max:255'],
        ]);*/

        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|max:255|unique:users,email,' . $id,
        ]);

        if ($image) {
            $image_name = time() . $image->getClientOriginalName();
            Storage::disk('users')->put($image_name, File::get($image));
            $user->image = $image_name;
        }

        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        $user->update();

        return redirect()->route('settings')
            ->with(['message' => 'Update settings OK']);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);

    }
    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile', [
            'user' => $user,
        ]);
    }
    public function getUsers($search = null)
    {
        if ($search && !empty($search)) {
            $users = User::where('nick', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'Like', '%' . $search . '%')
                ->orderBy('id', 'desc')
                ->simplePaginate(5);
            return view('user.getUsers', [
                'users' => $users,
            ]);

        } else {
            $users = User::orderBy('id', 'desc')->simplePaginate(5);
            return view('user.getUsers', [
                'users' => $users,
            ]);
        }
    }
}

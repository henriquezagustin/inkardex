<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    
    public function index()
    {
    	$users = User::all();
    	return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
    	$user = User::findOrFail($id);
    	return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
    	$user = User::findOrFail($id);

        if ($file = $request->file('photo_id')) {
            $name = 'IMG_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads', $name);

            if ($user->photos) {
                $user->photos()->delete();
            }
          
            // $photo = $user->profileImage();
            // if ($photo) {
            //     if (file_exists(public_path() . $photo->path)) {                    
            //         if (unlink(public_path() . $photo->path))
            //             $photo->delete();    
            //     }
            // }

            $user->photos()->create([
                'name' => $name,
                'path' => '/uploads/' . $name
            ]);
        }

        return redirect('/admin/users')->with('status', 'The user ' . $user->name . ' was succesfully updated.');
    }
}

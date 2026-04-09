<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time().'.'. $image->getClientOriginalExtension();

            $imagePath = Storage::disk('s3')->putFileAs(
                'myproject/users',
                $image,
                $imageName
            );

            $data['image'] = $imagePath;
        }

        // Controller এ ফাইল আপলোড করার সময়

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User added successfully');
    }
}

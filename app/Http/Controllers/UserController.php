<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function profile($name)
  {
    $user = User::where('name', '=', $name)->firstOrFail();
    return view('users.profile', compact('user'));
  }

  public function promote(User $user)
  {
    $user->is_admin = true;
    $user->save();

    return redirect()->back()->with('success', 'User is now Admin!');
  }

  public function removeAdmin(User $user)
  {
    $user->is_admin = false;
    $user->save();

    return redirect()->back()->with('success', 'User is no more an admin!');
  }

  public function update(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'password' => 'nullable|string|min:8|confirmed',
    ]);

    $user->name = $request->input('name');

    if ($request->filled('password')) {
      $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->route('profile', $user->name)->with('success', 'Profile updated successfully.');
  }
}

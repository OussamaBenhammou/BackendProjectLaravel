<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    return redirect()->back()->with('success', 'User is no more an admin!');
  }
}

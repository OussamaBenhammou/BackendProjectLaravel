<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function profile( $name){
  $user = User::where('name', '=', $name)->firstOrFail();
  return view('users.profile', compact('user'));
 }
}

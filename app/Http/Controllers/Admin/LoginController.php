<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{

  public function index()
  {
    //
    return view('admin.auth');
  }

  public function authenticate(Request $request)
  {
    $request->validate(
      [
        'email' => 'required|email',
        'password' => 'required'
      ]
    );

    $credentials = $request->only('email', 'password');
    $credentials['role'] = 'admin';

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->route('admin.movie.index');
    }

    return back()->withErrors([
      'error' => 'Your credentials are wrong'
    ])->withInput();

    // dd($credentials);
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('admin.login');
  }
}

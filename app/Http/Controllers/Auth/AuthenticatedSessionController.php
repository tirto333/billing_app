<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Di isi',
            'password.required' => 'Sandi Wajib Di isi'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect('login')->withErrors('Email anda salah / belum terdaftar !')->withInput();
        } else {
            if (!Hash::check($request->password, $user->password)) {
                return redirect('login')->withErrors('Sandi yang anda masukan salah !')->withInput();
            }
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role_id == '1') {
                return redirect('/Dashboard-Admin');
            } elseif (Auth::user()->role_id == '2') {
                return redirect('/admin');
            } elseif (Auth::user()->role_id == '3') {
                return redirect('/Dashboard-Manager');
            }elseif (Auth::user()->role_id == '4') {
                return redirect('/Dashboard-Anggota');
            }
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

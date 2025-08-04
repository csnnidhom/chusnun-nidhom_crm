<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function showLoginForm(){
        return view('pages.auth.login');
    }

    public function login(Request $request){

        try{
            $credential = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if(!$token = JWTAuth::attempt($credential)){
                return back()->withErrors([
                    'failed' => 'Email atau password salah',
                ])->withInput();
            }

            $user = Auth::user();
            $role = $user->role;

            Auth::login($user);

            session([
                'jwt_token' => $token,
                'role' => $role
            ]);

            return redirect()->intended(route('dashboard.index'));
        }catch(JWTException $e){
            Log::error('AuthController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan perihal token'])
                ->withInput();
        }catch(\Exception $e){
            Log::error('AuthController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }

    public function logout(Request $request){
        try {
            Auth::logout();

            if (session('jwt_token')) {
                JWTAuth::setToken(session('jwt_token'))->invalidate(true);
            }

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('AuthController : ' .$e->getMessage());
            return back()
                ->withErrors(['failed' => 'Terjadi kesalahan silahkan coba lagi nanti'])
                ->withInput();
        }
    }


}

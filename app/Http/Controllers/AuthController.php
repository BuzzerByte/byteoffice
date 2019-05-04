<?php
namespace buzzeroffice\Http\Controllers;

use Auth;
use buzzeroffice\Http\Requests;
use buzzeroffice\User;
use Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.sessions.login');
    }

    public function postLogin(Requests\LoginRequest $request)
    {
    
        if (User::login($request)) {
            flash()->success('Welcome to Laraspace.');
            // return response()->json($request);
            if (Auth::user()->hasRole('admin')) {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/users');
            }
        }
        flash()->error('Invalid Login Credentials');
        
        return redirect()->back();
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('admin.sessions.register');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $provider_user = Socialite::driver($provider)->user();
        $user = $this->findUserByProviderOrCreate($provider, $provider_user);
        auth()->login($user);
        flash()->success('Welcome to Laraspace.');

        return redirect()->to('/admin');
    }

    private function findUserByProviderOrCreate($provider, $provider_user)
    {
        $user = User::where($provider . '_id', $provider_user->token)
            ->orWhere('email', $provider_user->email)
            ->first();
        if (!$user) {
            $user = User::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                $provider . '_id' => $provider_user->token
            ]);
        } else {
            // Update the token on each login request
            $user[$provider . '_id'] = $provider_user->token;
            $user->save();
        }

        return $user;
    }
}

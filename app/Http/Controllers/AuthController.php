<?php
namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\User;
use Socialite;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.sessions.login');
    }

    public function postLogin(Requests\LoginRequest $request)
    {
        // return response()->json($request);
        if (User::login($request)) {
            flash('Welcome to Laraspace.')->success();
            if (Auth::user()->isAdmin()) {
                return redirect()->to('/admin');
            } else {
                return redirect()->to('/');
            }
        }
        flash('Invalid Login Credentials')->error();
        
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

    /**
     * Redirect the user to the authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        Log::info('handle provider call back');
        // $provider_user = Socialite::driver($provider)->user();
        // Log::info($provider_user);
        // $user = $this->findUserByProviderOrCreate($provider, $provider_user);
        // auth()->login($user);
        // flash('Welcome to Laraspace.')->success();

        // return redirect()->to('/admin');

        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/admin');
            } else {
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'facebook_id' => $user->id]);
                Auth::login($newUser);
                return redirect()->back();
            }
        }
        catch(Exception $e) {
            return redirect('auth/facebook');
        }
    }

    private function findUserByProviderOrCreate($provider, $provider_user)
    {
        Log::info('start find user');
        $user = User::where($provider . '_id', $provider_user->token)
            ->orWhere('email', $provider_user->email)
            ->first();
        if (!$user) {
            Log::info('create user');
            $user = User::create([
                'name' => $provider_user->name,
                'email' => $provider_user->email,
                $provider . '_id' => $provider_user->token
            ]);
        } else {
            Log::info('update token');
            // Update the token on each login request
            $user[$provider . '_id'] = $provider_user->token;
            $user->save();
        }

        return $user;
    }

    // private function redirectToFacebook(){
    //     Log::info('redirect to fb');
    //     return Socialite::driver('facebook')->redirect();
    // }

    // private function handleFacebookCallback(){
    //     try {
    //         $user = Socialite::driver('facebook')->user();
    //         $finduser = User::where('facebook_id', $user->id)->first();
    //         if ($finduser) {
    //             Auth::login($finduser);
    //             return redirect('/admin');
    //         } else {
    //             $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'facebook_id' => $user->id]);
    //             Auth::login($newUser);
    //             return redirect()->back();
    //         }
    //     }
    //     catch(Exception $e) {
    //         return redirect('auth/facebook');
    //     }
    // }
}

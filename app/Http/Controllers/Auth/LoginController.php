<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('main.login');
    }
        
    public function login(Request $request){

            $uname = $request->name;
            $password = $request->password;
        
//dd($request);        
        //$check = DB::table('users')->where('name',$uname)->get();
            //dd($check);        
        //if ( !$check ) {
        //    return redirect('/masuk/')->withError(__('Username tidak terdaftar.'));
        //}

        //if ($password != $check->plain_password)  {
        //    return redirect('/masuk/')->withError(__('Password tidak sesuai'));
        //}

        if(auth()->attempt(array('name' => $request->name, 'password' => $request->password)))
        {
            if (auth()->user()->level >0) {
               $request->session()->put('level',auth()->user()->level);

               if (auth()->user()->level == 3) {
                    return redirect()->route('main.index');
               }else{
                    return redirect()->route('home');
               }
            }else{
                $this->guard()->logout();
 
                    $request->session()->flush();
             
                    $request->session()->regenerate();
                    
                    return redirect($url)->withError(__('Maaf, Anda tidak dikenal'));
    		}
        }else{
            return redirect('/masuk/')->withError(__('Maaf, Username atau Password Anda salah.'));
        }
        
    }
    
    /**
     * Log the user out of the application.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
 
        $request->session()->flush();
 
        $request->session()->regenerate();
 
        return redirect('/masuk/')
            ->withSuccess('Terimakasih.');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

use Auth;

class RegisterController extends Controller
{
    protected $tb_user;
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->tb_user = new User();
    }

    protected function create(Request $request)
    {

        $rules = [
            'fullname' => 'required|string',
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            //'address' => 'required',
            //'phone' => 'required|numeric',
            //'level' => ['required'],
        ];

        $messages = [
            'password.min' => 'Password harus berisi minimal 8 karakter',
            'password_confirmation.same' => 'Password harus sesuai',
            //'phone.numeric' => 'Nomor telepon harus berisi angka',
        ];

        $data = $request->toArray();

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {

            if($data['password'] == $data['password_confirmation'])
            {
                $insert = $this->tb_user->store($data);
            }
            else
            {
                return back()->withInput()->withErrors($validator->messages());
            }
        }
        else
        {
            $insert = $this->tb_user->store($data);
        }

        if($insert)
        {
            if(Auth::attempt(array('name' => $insert['name'], 'password' => $insert['password'])))
            {
                if (Auth::user()->level > 0) {
                   $request->session()->put('level',auth()->user()->level);
                    return redirect()->route('home');
                }else{
                     $this->guard()->logout();
 
                    $request->session()->flush();
             
                    $request->session()->regenerate();
                    
                    return redirect($url)->withError(__('Maaf, Anda tidak dikenal'));    
                }
                
            }

        }
    }

    public function check(Request $request)
    {
        //echo 'CHECK';
        $request = $request->all();
        $check = $this->tb_user->check($request);
        return response()->json($check);
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use DataTables;
use Auth;
use Session;
use App\Models\User;

class Officer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'name',
        'email',
        'password',
        'plain_password',
        'phone_number',
        'postal_code',
        'level',
        'address',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function select_all(){
        $data = User::select('*');
            return $data;
    }

    public function select_one($id){
        $data = User::find($id);
            return $data;
    }

    public function check($request){
        $data = User::where('name', '=' ,$request)->orWhere('email','=',$request)->orWhere('plain_password', '=', $request)->where('level','=',4)->count();
        return $data;
    }

    public function store($request){

        $user = Auth::user();
        $status = null;

        //$request = $request->toArray();

        $request['level'] = (isset($request['level']) && !empty($request['level'])) ? $request['level'] : '4';

        $udata = array(
                    'remember_token'    => $request['_token'],
                    'fullname'         => $request['fullname'],
                    'name'         => 'DRV'.$request['name'],
                    'email'        => $request['email'],
                    'plain_password' => $request['password'],
                    'password'     => Hash::make($request['password']),
                    //'password'     => bcrypt($request['password']),
                    'phone_number' => $request['phone'],
                    'address'      => $request['address'],
                    'level'        => $request['level'],
                    'status' => $status
                    );

        //print_r($data);
        $user = User::create($udata);
        
        return $request;
        
    }

    public function modify($request, $id){
        $request = $request->toArray();
        $status = null;
        $udata = array(
                    'remember_token'    => $request['_token'],
                    'fullname'          => $request['fullname'],
                    'name'              => 'DRV'.$request['name'],
                    'email'             => $request['email'],
                    'phone_number' => $request['phone_number'],
                    'address'      => $request['address'],
                    'level'        => $request['level'],
                    'status'       => $status
                    );

        if(!empty($request['password'])) {

            $udata += array(
                            'plain_password'    => $request['password'],
                            'password' => Hash::make($request['password'])
                        );
        }
        
        //dd($udata);
        $user = User::find($id)->update($udata);

        return $user;
    }

    public function remove($id){
        $data = User::find($id)->delete();
        return $data;
    }

    public function select_all_ajax($search){
        $data = User::select(array('users.id','users.fullname','users.name','users.email','users.phone_number','users.address'))->where('level','=','4');  

        return $data;
    }
}

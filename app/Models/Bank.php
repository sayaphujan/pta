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

class Bank extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_name',
        'bank_num',
        'bank_own',
        ];

    public function select_all(){
        $data = Bank::select('*')->get();
            return $data;
    }

    public function select_one($id){
        $data = Bank::select('*')->where('bank_id', '=' ,$id)->first();
            return $data;
    }

    public function check($request){
        $data = Bank::where('bank_num', '=' ,$request)->count();
        return $data;
    }

    public function store($request){
        //$request = $request->toArray();

        $udata = array(
                    'bank_name'      => $request['name'],
                    'bank_num'       => $request['no'],
                    'bank_own'       => $request['owner'],
                    );

        $data = Bank::create($udata);
        
        return $data;
        
    }

    public function modify($request, $id){
        //$request = $request->toArray();

        $udata = array(
                    'bank_name'      => $request['name'],
                    'bank_num'       => $request['no'],
                    'bank_own'       => $request['owner'],
                    );

        $data = Bank::where('bank_id','=',$id)->update($udata);

        return $data;
    }

    public function remove($id){
        $data = Bank::where('bank_id','=',$id)->delete();
        return $data;
    }

    public function select_all_ajax($search){
        $data = Bank::select('*');  

        return $data;
    }
}

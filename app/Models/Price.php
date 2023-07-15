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

class Price extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price_net',
        'price_volume',
        ];

    public function select_all(){
        $data = Price::select(array('price_id','price_volume','price_net'))->get();
            return $data;
    }

    public function getprice($id){
        $data = Price::select('price_net')->where('price_id', '=' ,$id)->first();
            return response()->json($data);
    }

    public function select_one($id){
        $data = Price::select('*')->where('price_id', '=' ,$id)->first();
            return $data;
    }

    public function store($request){

        $udata = array(
                    'price_volume'     => $request['volume'],
                    'price_net'        => $request['price'],
                    );

        $data = Price::create($udata);
        
        return $data;
        
    }

    public function modify($request, $id){

        $udata = array(
                    'price_volume'     => $request['volume'],
                    'price_net'        => $request['price'],
                    );

        $data = Price::where('price_id','=',$id)->update($udata);


        return $data;
    }

    public function remove($id){
        $data = Price::where('price_id','=',$id)->delete();
        return $data;
    }

    public function select_all_ajax($search){
        $data = Price::select('*');  

        return $data;
    }
}

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
use Carbon\Carbon;

class Trans extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trans_category',
        'trans_destination',
        'trans_phone',
        'trans_note',
        'price_net',
        'price_volume',
        'price_deliv',
        'price_sum',
        'user_id',
        'driver_id',
        'price_id',
        'loc_id',
        'payment',
        'payment_status',
        'order_id',
        ];

    public function select_all($search){
        $data = Trans::select('*')->get();  

        return $data;
    }

    public function select_all_ajax_user($search, $id){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('users.id',$id)
                        ->get(); 

        return $data;
    }
    
    public function select_all_ajax_driver($search, $id){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->where('driver_id',$id)
                        ->get(); 

        return $data;
    }
    
    public function select_all_ajax($search){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->get(); 

        return $data;
    }

    public function select_all_ajax_paid_user($search,$id){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.payment_photo','!=','')
                        ->orWhere('trans.payment','=', 'Tunai')
                        ->where('users.id',$id)
                        ->get(); 

        return $data;
    }
    
    public function select_all_ajax_paid($search){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.payment_photo','!=','')
                        ->orWhere('trans.payment','=', 'Tunai')
                        ->get(); 

        return $data;
    }

    public function select_all_ajax_unpaid_user($search, $id){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.payment_photo','=', null)
                        ->where('trans.payment','!=', 'Tunai')
                        ->where('users.id',$id)
                        ->get(); 
//echo $data;
        return $data;
    }

    public function select_all_ajax_unpaid($search){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.payment_photo','=' ,null)
                        ->where('trans.payment','!=', 'Tunai')
                        ->get(); 

        return $data;
    }

    public function select_all_ajax_unverified_user($search, $id){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.payment_photo','!=','')
                        ->where('trans.payment_status','=','0')
                        ->where('users.id',$id)
                        ->get(); 

        return $data;
    }
    
    public function select_all_ajax_unverified($search){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        //->where('trans.payment_photo','!=','')
                        ->where('trans.payment_status','=','0')
                        ->get(); 

        return $data;
    }

    public function select_all_ajax_sent($search){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.trans_delivery','=','1')
                        ->get(); 

        return $data;
    }


    public function select_all_ajax_unsent($search){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.trans_delivery','=','0')
                        ->get(); 

        return $data;
    }
    
    public function select_all_ajax_sent_driver($search, $user){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->where('trans.trans_delivery','=','1')
                        ->where('driver_id', $user)
                        ->get(); 

        return $data;
    }


    public function select_all_ajax_unsent_driver($search, $user){
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->where('trans.trans_delivery','=','0')
                        ->where('driver_id', $user)
                        ->get(); 

        return $data;
    }

    public function select_one($id){
         $data = Trans::select('*')->where('trans_id', '=' ,$id)->first();
            return $data;
    }

    public function select_join($id)
    {
        $data = DB::table('trans')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->join('locs','trans.loc_id','=','locs.loc_id')
                        ->where('trans.order_id','=',$id)
                        ->first(); 

        //dd($data);
        return $data;
    }

    public function select_kurir($id)
    {
        $data = DB::table('trans')
                        ->join('users','trans.driver_id','=','users.id')
                        ->where('trans.order_id','=',$id)
                        ->first(); 

        //dd($data);
        return $data;
    }

    public function store_loc($data)
    {
        $loc = Loc::create($data);
        return $loc->id;
    }

    public function check($data)
    {
        $checkdata = null;

        $udata = User::where('name','=',$data['name'])->get()->toArray();

        //dd($udata[0]);
        if(!empty($udata) || $udata != null){
            $checkdata = $udata[0];
            $uid = $checkdata['id'];
            //dd($uid);
        }
        else
        {
            //dd($data);
           $user = User::create($data);
           $uid = $user->id;
        }
        return $uid;
    }

    public function store_cust($data)
    {

        $cust = Cust::create($data);
                //dd($cust->id);
        return $cust->id;
    }

    public function store_trans($data)
    {
        
        $udata = array();

        $trans = Trans::create($data);
        
        $udata = $trans;
        $udata['trans_id'] = $trans->id;
        
        return $udata;
    }

    public function update_payment($request, $order_id){
//dd($id);
        $udata = array(
                    'payment_photo'     => $request,
                    );

        $data = Trans::where('order_id','=',$order_id)->update($udata);


        return $data;
    }

    public function update_status($request, $order_id){
//dd($id);
        $udata = array(
                    'payment_status'     => 1,
                    'driver_id'         => $request->driver
                    );

        $data = Trans::where('order_id','=',$order_id)->update($udata);


        return $data;
    }

    public function update_delivery($id){
        
                $udata = array(
                            'trans_delivery'     => '1',
                            );
        
                $data = Trans::where('trans_id','=',$id)->update($udata, ['update_at' => false]);
        
        //echo $data;
                return $data;
            }

    public function update_status_bayar($order_id){
                $udata = array(
                            "payment_status"     => "1",
                            );
        
                $data = Trans::where("order_id","=",$order_id)->update($udata, ["update_at" => false]);
        
        //echo $data;
                return $data;
    }
    
    public function cancel_bayar($order_id){
        $data = Trans::select('*')->where('order_id', '=' ,$order_id)->first();
        if($data['payment_status'] != '2'){
            $set = '2';
        }else{
            $set = '0';
        }
        

                $udata = array(
                            "payment_status"     =>$set,
                            );
        
                $updt = Trans::where("order_id","=",$order_id)->update($udata, ["update_at" => false]);
        
        //echo $data;
                return $updt;
    }
    
    public function update_status_kirim($order_id){
                $udata = array(
                            "trans_sent"     => "1",
                            );
        
                $data = Trans::where("order_id","=",$order_id)->update($udata, ["update_at" => false]);
        
        //echo $data;
                return $data;
    }
    
    public function total_transaksi(){
         $data = Trans::select ('*')
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->count(); 

        return $data;
    }
    
    public function total_pembeli(){
         $data = Trans::select ('*')
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->groupBy('user_id')
                        ->count(); 

        return $data;
    }
    
    public function total_air_distribusi(){
         $data = Trans::select ('*')
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('trans_sent','1')
                        ->sum('price_volume'); 

        return $data;
    }
    
    public function total_air_terjual(){
         $data = Trans::select ('*')
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('trans_sent','1')
                        ->sum('price_net'); 

        return $data;
    }
    
    public function total_transaksi_today(){
         $data = Trans::select ('*')
                        ->whereDate('created_at', Carbon::today())
                        ->count();

        return $data;
    }
    
    public function total_unpaid_today(){
         $data = Trans::select ('*')
                        ->whereDate('created_at', Carbon::today())
                        ->where('payment_photo', '')
                        ->count();

        return $data;
    }
    
    public function total_paid_today(){
         $data = Trans::select ('*')
                        ->whereDate('created_at', Carbon::today())
                        ->where('payment_photo', '!=', '')
                        ->count();

        return $data;
    }
    
    public function total_unsent_today(){
         $data = Trans::select ('*')
                        ->whereDate('created_at', Carbon::today())
                        ->where('trans_sent', '0')
                        ->count();

        return $data;
    }
    
    public function total_sent_today(){
         $data = Trans::select ('*')
                        ->whereDate('created_at', Carbon::today())
                        ->where('trans_sent', '1')
                        ->count();

        return $data;
    }
    
    public function laporan_all($from, $to){
        $start  = Carbon::createFromFormat('d/m/Y', $from);
        $end    = Carbon::createFromFormat('d/m/Y', $to);
        
         $data = Trans::select ('*')
                        ->join('users','trans.user_id','=','users.id')
                        ->leftjoin('banks','trans.payment','=','banks.bank_id')
                        ->whereBetween('trans.created_at', [$start, $end])
                        ->get();

        return $data->toArray();
        //dd($data);
    }

    public function laporan_all_total_transaksi($from, $to){
        $start  = Carbon::createFromFormat('d/m/Y', $from);
        $end    = Carbon::createFromFormat('d/m/Y', $to);
        
        $data = Trans::select ('*')
                        ->whereBetween('trans.created_at', [$start, $end])
                        ->count();

        return $data;
    }

    public function laporan_all_total_pendapatan($from, $to){
        $start  = Carbon::createFromFormat('d/m/Y', $from);
        $end    = Carbon::createFromFormat('d/m/Y', $to);
        
        $data = Trans::select ('*')
                        ->whereBetween('trans.created_at', [$start, $end])
                        ->where('payment_photo', '!=', '')
                        ->sum('price_net');

        return $data;
    }

    public function laporan_all_total_air($from, $to){
        $start  = Carbon::createFromFormat('d/m/Y', $from);
        $end    = Carbon::createFromFormat('d/m/Y', $to);
        
       $data = Trans::select ('*')
                        ->whereBetween('trans.created_at', [$start, $end])
                        ->where('payment_photo', '!=', '')
                        ->sum('price_volume'); 

        return $data;
    }
}

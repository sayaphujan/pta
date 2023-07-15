<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Price;
use App\Models\Bank;
use App\Models\Trans;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->tb_user = new User();
        $this->tb_price = new Price();
        $this->tb_bank = new Bank();
        $this->tb_trans = new Trans();
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Auth::user()->level == '3')
        {
            return redirect()->route('dashboard');
        }
        else if(Auth::user()->level == '4')
        {
            return redirect()->route('trans');
        }
        
        $user = Auth::user();
        $total_transaksi = $this->tb_trans->total_transaksi();
        $total_pembeli = $this->tb_trans->total_pembeli();
        $total_air_distribusi = $this->tb_trans->total_air_distribusi();
        $total_air_terjual = $this->tb_trans->total_air_terjual();
        $total_transaksi_today = $this->tb_trans->total_transaksi_today();
        $total_unpaid_today = $this->tb_trans->total_unpaid_today();
        $total_paid_today = $this->tb_trans->total_paid_today();
        $total_unsent_today = $this->tb_trans->total_unsent_today();
        $total_sent_today = $this->tb_trans->total_sent_today();
        
        $percent_unpaid = ($total_transaksi_today == 0) ? 0 : ($total_unpaid_today/$total_transaksi_today)*100;
        $percent_paid   =  ($total_transaksi_today == 0) ? 0 : ($total_paid_today/$total_transaksi_today)*100;
        $percent_unsent =  ($total_transaksi_today == 0) ? 0 : ($total_unsent_today/$total_transaksi_today)*100;
        $percent_sent =  ($total_transaksi_today == 0) ? 0 : ($total_sent_today/$total_transaksi_today)*100;
        
        return view('home', compact('user','total_transaksi','total_pembeli','total_air_distribusi','total_air_terjual','total_transaksi_today','total_unpaid_today','total_paid_today','percent_unpaid','percent_paid','total_unsent_today','total_sent_today','percent_unsent','percent_sent'));
    }
    
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('home');
    }
    
    public function userHome()
    {
        $user = Auth::user();
        $price = $this->tb_price->select_all();
        $bank = $this->tb_bank->select_all();
        return view('trans.order', compact('user','price','bank'));
    }
}

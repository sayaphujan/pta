<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Price;
use App\Models\Trans;
use App\Models\Bank;
use DataTables;
use Auth;
use \Mpdf\Mpdf as PDF; 
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TransController extends Controller
{
    protected $tb_user;
    protected $tb_price;
    protected $tb_trans;
    protected $tb_bank;

    public function __construct()
    {
        $this->middleware('auth');
        $this->tb_trans = new Trans();
        $this->tb_user = new User();
        $this->tb_price = new Price(); 
        $this->tb_bank = new Bank(); 
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $search = (empty($request->input('search'))) ? '' : $request->input('search');
            $level = Auth::user()->level;
            $user = Auth::user()->id;

            if($level != 3 && $level != 4){
                $data = $this->tb_trans->select_all_ajax($search);
            }
            else if($level == 4){
                $data = $this->tb_trans->select_all_ajax_driver($search, $user);
            }
            else
            {
                $data = $this->tb_trans->select_all_ajax_user($search, $user);
            }
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('trans.index');
    }

    public function paid(Request $request)
    {
        if ($request->ajax()) {

            $search = (empty($request->input('search'))) ? '' : $request->input('search');
            $level = Auth::user()->level;
            $user = Auth::user()->id;

            if($level != 3 && $level != 4){
                $data = $this->tb_trans->select_all_ajax_paid($search);
            }
            else
            {
                $data = $this->tb_trans->select_all_ajax_paid_user($search, $user);
            }

            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('trans.paid');
    }

    public function unpaid(Request $request)
    {
        if ($request->ajax()) {

            $search = (empty($request->input('search'))) ? '' : $request->input('search');
            $level = Auth::user()->level;
            $user = Auth::user()->id;

            if($level != 3){
                $data = $this->tb_trans->select_all_ajax_unpaid($search);
            }
            else
            {
                $data = $this->tb_trans->select_all_ajax_unpaid_user($search, $user);
            }

            //$data = $this->tb_trans->select_all_ajax_unpaid($search);
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('trans.unpaid');
    }

    public function unverified(Request $request)
    {
        if ($request->ajax()) {

            $search = (empty($request->input('search'))) ? '' : $request->input('search');
            $level = Auth::user()->level;
            $user = Auth::user()->id;

            if($level != 3){
                $data = $this->tb_trans->select_all_ajax_unverified($search);
            }
            else
            {
                $data = $this->tb_trans->select_all_ajax_unverified_user($search, $user);
            }

            //$data = $this->tb_trans->select_all_ajax_unverified($search);
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('trans.unverified');
    }

    public function sent(Request $request)
    {
        if ($request->ajax()) {

            $search = (empty($request->input('search'))) ? '' : $request->input('search');
            $level = Auth::user()->level;
            $user = Auth::user()->id;

            if($level == 4){
                $data = $this->tb_trans->select_all_ajax_sent_driver($search, $user);
            }else if($level == 3){
                $data = $this->tb_trans->select_all_ajax_sent($search, $user);
            }

            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('trans.sent');
    }

    public function unsent(Request $request)
    {
        if ($request->ajax()) {

            $search = (empty($request->input('search'))) ? '' : $request->input('search');
            $level = Auth::user()->level;
            $user = Auth::user()->id;

            if($level == 4){
                $data = $this->tb_trans->select_all_ajax_unsent_driver($search, $user);
            }else if($level == 3){
                $data = $this->tb_trans->select_all_ajax_unsent($search, $user);
            }

            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('trans.unsent');
    }

    public function detail($order_id)
    {
        $user = Auth::user();
        $price = $this->tb_price->select_all();
        $bank = $this->tb_bank->select_all();
        $trans = $this->tb_trans->select_join($order_id);
        $kurir = $this->tb_trans->select_kurir($order_id);
        $petugas = $this->tb_user->select_all_driver();
        //dd($petugas);
        return view('trans.detail', compact('trans','user','price','bank','petugas','kurir'));
    }

    public function print($order_id)
    {
        $user = Auth::user();
        $price = $this->tb_price->select_all();
        $bank = $this->tb_bank->select_all();
        $trans = $this->tb_trans->select_join($order_id);
        
        return view('trans.print', compact('trans','user','price','bank'));
    }

    public function update_payment(Request $request, $order_id)
    {
        $data['photo'] = null;
        
            if($request->file('photo')){
                $file= $request->file('photo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                //$filename = $request->order_id;
                $file-> move(public_path('/upload/bukti'), $filename);
                $data['photo']= $filename;
            }
            //dd($data);
        $update = $this->tb_trans->update_payment($data['photo'], $order_id);

        if($update)
        {
            return redirect()->route('trans.detail', $order_id)
            ->with('success', 'Data Berhasil Diperbaharui');
        }
    }

    public function update_status(Request $request, $order_id)
    {            
        $update = $this->tb_trans->update_status($request, $order_id);

        if($update)
        {
            return redirect()->route('trans.detail', $order_id)
            ->with('success', 'Data Berhasil Diperbaharui');
        }      
    }

    public function delivery_send($id)
    {
        $delete = $this->tb_trans->update_delivery($id);
        if($delete){
            return redirect()->route('trans')
            ->with('success', 'Terkirim');
        }
        
    }

    public function update_status_bayar($order_id)
    {
        $delete = $this->tb_trans->update_status_bayar($order_id);
        if($delete){
            return redirect()->route('trans.detail', $order_id)
            ->with('success', 'Data Pembayaran diperbaharui');
        }
        
    }
    
    public function cancel_bayar($order_id)
    {
        $delete = $this->tb_trans->cancel_bayar($order_id);
        if($delete){
            return redirect()->route('trans.detail', $order_id)
            ->with('success', 'Data Pembayaran diperbaharui');
        }
        
    }
    
    public function update_status_kirim($order_id)
    {
        $delete = $this->tb_trans->update_status_kirim($order_id);
        if($delete){
            return redirect()->route('trans.detail', $order_id)
            ->with('success', 'Pesanan Diterima');
        }
        
    }
    
    public function cetak(Request $request)
    {
        $tgl = explode(" - ",$request->tglLaporan);
        $cetak = $this->tb_trans->laporan_all($tgl[0], $tgl[1]);   
        $total_air = $this->tb_trans->laporan_all_total_air($tgl[0], $tgl[1]);    
        $total_pendapatan = $this->tb_trans->laporan_all_total_pendapatan($tgl[0], $tgl[1]);    
        $total_transaksi = $this->tb_trans->laporan_all_total_transaksi($tgl[0], $tgl[1]);    
        
        //return view('cetak');
        
         // Setup a filename 
        $documentFileName = "Laporan.pdf";
 
        // Create the mPDF document
        $document = new PDF( [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_header' => '3',
            'margin_top' => '20',
            'margin_bottom' => '20',
            'margin_footer' => '2',
            'orientation' => 'L'
        ]);     
 
        // Set some header informations for output
        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documentFileName.'"'
        ];
 
        $content = '
        <h1>Laporan </h1><h3>Tanggal '.$tgl[0].' sampai '.$tgl[1].'</h3><br/>
        <table>
            <tr>
                <td>Total Volume Terjual </td><td>:</td><td>'.number_format($total_air).' m3</td>
            </tr>
            <tr>
                <td>Total Pendapatan </td><td>:</td><td>Rp.'.number_format($total_pendapatan).'</td>
            </tr>
            <tr>
                <td>Total Transaksi </td><td>:</td><td>'.number_format($total_transaksi).'</td>
            </tr>
        </table>
        <br/><br/>
        <table width="100%" border="1">
            <thead>
                <tr>
                    <th class="sorting">No</th>
                    <th class="sorting">Waktu Pemesanan</th>
                    <th class="sorting">Kode Transaksi</th>
                    <th class="sorting">Nama Pemohon</th>
                    <th class="sorting">No. Telepon</th>
                    <th>Pembayaran</th>
                    <th>Verifikasi</th>
                    <th>Pengiriman</th>
                </tr> 
            </thead>
            <tbody>';
            foreach ($cetak as $key => $value)
            {
                $created = Carbon::parse($value['created_at']);
                $payment = ($value['payment'] == 'Tunai') ? 'Pembayaran di Tempat' : $value['bank_name'];
                $verifikasi = ($value['payment_status'] == '1') ? 'Terverifikasi' : 'Belum Terverifikasi';
                $delivery = ($value['trans_sent'] == '1') ? 'Terkirim' : 'Belum Terkirim';

                $content .='
                    <tr>
                        <td>'.$value['trans_id'].'</td>
                        <td>'.$created.'</td>
                        <td>'.$value['order_id'].'</td>
                        <td>'.$value['fullname'].'</td>
                        <td>'.$value['trans_phone'].'</td>
                        <td>'.$payment.'</td>
                        <td>'.$verifikasi.'</td>
                        <td>'.$delivery.'</td>
                    </tr>
                ';
            }
        $content .='
            </tbody> 
        </table>
        ';
        // Write some simple Content
        $document->WriteHTML($content);
         
        // Save PDF on your public storage 
        Storage::disk('public')->put($documentFileName, $document->Output($documentFileName, "S"));
         
        // Get file back from storage with the give header informations
        return Storage::disk('public')->download($documentFileName, 'Request', $header); //
    }
}
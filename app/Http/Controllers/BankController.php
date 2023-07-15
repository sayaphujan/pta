<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;

class BankController extends Controller
{
    protected $tb_bank;
    
    public function __construct()
    {
        $this->middleware('auth');
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
            $data = $this->tb_bank->select_all_ajax($search);
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('banks.index');
    }

    public function create()
    {
        return view('banks.create');
    }

    public function isvalid(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'owner' => 'required|string',
            'no' => 'required|numeric',
        ];

        $messages = [
            'no.numeric' => 'Nomor rekening harus berisi angka',
        ];

        $data = $request->toArray();

        $validator = Validator::make($data, $rules, $messages);

        return $validator;
    }

    public function store(Request $request)
    {
        //dd($request);
        $validator = $this->isvalid($request);

        $data = $request->toArray();

        if ($validator->fails())
        {
           return back()->withInput()->withErrors($validator->messages());
        }
        else
        {
            $insert = $this->tb_bank->store($data);
        }

        if($insert)
        {
            return redirect()->route('banks')->with('success', 'Data berhasil ditambahkan.');
        }

    }

    public function show($id)
    {
        $bank = $this->tb_bank->select_one($id);
        return view('banks.detail', compact('bank'));
        //dd($bank);
    }
     
    public function edit($id)
    {
        $bank = $this->tb_bank->select_one($id);
        return view('banks.edit', compact('bank'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = $this->isvalid($request);

        $data = $request->toArray();

        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator->messages());
        }
        else
        {
            $update = $this->tb_bank->modify($request, $id);
        }

        if($update)
        {
            return redirect()->route('banks')->with('success', 'Data Berhasil Diperbaharui');
        }        
    }

    public function destroy($id)
    {
        $delete = $this->tb_bank->remove($id);
        if($delete){
            return redirect()->route('banks')
            ->with('success', 'Rekening Berhasil Dihapus');
        }
        
    }

    public function exist(Request $request)
    {
        //echo 'CHECK';
        $request = $request->all();
        $check = $this->tb_bank->check($request);
        return response()->json($check);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;

class OfficerController extends Controller
{
    protected $tb_officer;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->tb_officer = new Officer();
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
            $data = $this->tb_officer->select_all_ajax($search);
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('officers.index');
    }

    public function create()
    {
        return view('officers.create');
    }

    public function isvalid(Request $request)
    {
        $rules = [
            'fullname' => 'required|string',
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'address' => 'required',
            'phone' => 'required|numeric',
            'level' => ['required'],
        ];

        $messages = [
            'password.min' => 'Password harus berisi minimal 8 karakter',
            'password_confirmation.same' => 'Password harus sesuai',
            'phone.numeric' => 'Nomor telepon harus berisi angka',
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

        if ($validator->fails()) {

            if($data['password'] == $data['password_confirmation'])
            {
                $insert = $this->tb_officer->store($data);
            }
            else
            {
                return back()->withInput()->withErrors($validator->messages());
            }
        }
        else
        {
            $insert = $this->tb_officer->store($data);
        }

        if($insert)
        {
            return redirect()->route('officers')->with('success', 'Data berhasil ditambahkan.');
        }

    }

    public function show($id)
    {
        $officer = $this->tb_officer->select_one($id);
        return view('officers.detail', compact('officer'));
    }
     
    public function edit($id)
    {
        $officer = $this->tb_officer->select_one($id);
        return view('officers.edit', compact('officer'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = $this->isvalid($request);

        $data = $request->toArray();

        if ($validator->fails()) {

            if($data['password'] == $data['password_confirmation'])
            {
                $update = $this->tb_officer->modify($request, $id);
            }
            else
            {
                return back()->withInput()->withErrors($validator->messages());
            }
        }
        else
        {
            $update = $this->tb_officer->modify($request, $id);
        }

        if($update)
        {
            return redirect()->route('officers')
            ->with('success', 'Data Berhasil Diperbaharui');
        }        
    }

    public function destroy($id)
    {
        $delete = $this->tb_officer->remove($id);
        if($delete){
            return redirect()->route('officers')
            ->with('success', 'Akun Berhasil Dihapus');
        }
        
    }

    public function check(Request $request)
    {
        //echo 'CHECK';
        $request = $request->all();
        $check = $this->tb_officer->check($request);
        return response()->json($check);
    }
}

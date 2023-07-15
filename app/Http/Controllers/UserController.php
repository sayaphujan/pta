<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;

class UserController extends Controller
{
    protected $tb_user;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->tb_user = new User();
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
            $data = $this->tb_user->select_all_ajax($search);
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('users.index');
    }

    public function create()
    {
        return view('users.create');
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
        
        $data['photo'] = null;
        $filename = null;
        
        //dd($request);
        $validator = $this->isvalid($request);

            if($request->file('photo') !== null){
                $file= $request->file('photo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('/upload/profile'), $filename);
            }

        $data = $request->toArray();
        $data['photo']= $filename;

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
            return redirect()->route('users')->with('success', 'Data berhasil ditambahkan.');
        }

    }

    public function show($id)
    {
        $user = $this->tb_user->select_one($id);
        return view('users.detail', compact('user'));
    }
     
    public function edit($id)
    {
        $user = $this->tb_user->select_one($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $validator = $this->isvalid($request);
        
        $data['photo'] = null;
        $filename = null;

            if($request->file('photo') !== null){
                $file= $request->file('photo');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('/upload/profile'), $filename);
            }

        $data = $request->toArray();
        $data['photo']= $filename;
        //dd($data);

        if ($validator->fails()) {

            if($data['password'] == $data['password_confirmation'])
            {
                $update = $this->tb_user->modify($data, $id);
            }
            else
            {
                return back()->withInput()->withErrors($validator->messages());
            }
        }
        else
        {
            $update = $this->tb_user->modify($data, $id);
        }

        if($update)
        {
            if($data['url'] == 'profile')
            {
                return redirect()->route('profile', $id)
            ->with('success', 'Data Berhasil Diperbaharui');
            }else{
                return redirect()->route('users')
            ->with('success', 'Data Berhasil Diperbaharui');    
            }
            
        }
    }

    public function destroy($id)
    {
        $delete = $this->tb_user->remove($id);
        if($delete){
            return redirect()->route('users')
            ->with('success', 'Akun Berhasil Dihapus');
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

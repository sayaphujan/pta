<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;

class PriceController extends Controller
{
    protected $tb_price;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->tb_price = new Price();
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
            $data = $this->tb_price->select_all_ajax($search);
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('prices.index');
    }

    public function create()
    {
        return view('prices.create');
    }

    public function isvalid(Request $request)
    {
        $rules = [
            'price' => 'required|numeric',
            'volume' => 'required|numeric',
        ];

        $messages = [
            'price.numeric' => 'Harga harus berisi angka',
            'volume.numeric' => 'Volume harus berisi angka',
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
            $insert = $this->tb_price->store($data);
        }

        if($insert)
        {
            return redirect()->route('prices')->with('success', 'Data berhasil ditambahkan.');
        }

    }

    public function edit($id)
    {
        $price = $this->tb_price->select_one($id);
        return view('prices.edit', compact('price'));
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
            $update = $this->tb_price->modify($request, $id);
        }

        if($update)
        {
            return redirect()->route('prices')
            ->with('success', 'Data Berhasil Diperbaharui');
        }        
    }

    public function destroy($id)
    {
        $delete = $this->tb_price->remove($id);
        if($delete){
            return redirect()->route('prices')
            ->with('success', 'Akun Berhasil Dihapus');
        }
        
    }

    public function getprice($id)
    {
        $price = $this->tb_price->getprice($id);

        return responnse()->json($price);
    }
}

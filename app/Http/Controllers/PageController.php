<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use DataTables;

class PageController extends Controller
{
    protected $tb_user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->tb_page = new Page();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            
            $data = $this->tb_page->select_all_ajax();
            return Datatables::of($data)

                        ->addIndexColumn()

                        ->addColumn('action', function($row){

                               $btn = '<a href="pages/show/'.$row->id.'" class="edit btn btn-primary btn-sm">Detail</a>&nbsp;&nbsp;&nbsp;<a href="pages/edit/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;&nbsp;&nbsp;<a href="pages/destroy/'.$row->id.'" class="edit btn btn-danger btn-sm">Delete</a>';    
                                return $btn;
                        })
                        ->addColumn('content', function($row){

                               $content = strip_tags($row->content);    
                                return $content;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validation parameters
        $request->validate([
            'judul'     => 'required',
            'slug'     => 'required',
            'content'   => 'required',
        ]);

       $content = $request->content;
       $image_name = '';
       $dom = new \DomDocument();
       $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $imageFile = $dom->getElementsByTagName('img');
 
        if(!empty($imageFile) || $imageFile!=''){
 
           foreach($imageFile as $item => $image){
               
               $data = $image->getAttribute('src');
               
               $data = substr($data, strpos($data, ",") + 1);  
               //list($type, $data) = explode(';', $data);
               //list(, $data)      = explode(',', $data);

               $imgeData = base64_decode($data);
               $image_name= '/upload/' . time().$item.'.png';
               $path = public_path() . $image_name;
               file_put_contents($path, $imgeData);
               
               $image->removeAttribute('src');
               $image->setAttribute('src', $image_name);
            }
        }

        $content = $dom->saveHTML();

        $request = array(
                    'content'   => $content,
                    'judul'     => $request['judul'],
                    'slug'      => $request['slug'],
                    'img'       => str_replace('/upload/','',$image_name)
                        );

        $data = $this->tb_page->store($request);

        if($data)
        {
            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('pages')->withStatus(__('Data berhasil ditambahkan.'));
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //menampilkan detail data dengan menemukan/berdasarkan id user
        $pages = $this->tb_page->select_one($id);
        return view('pages.detail', compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //menampilkan detail data dengan menemukan/berdasarkan id user untuk diedit
        $pages = $this->tb_page->select_one($id);
        return view('pages.edit', compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation parameters
        $request->validate([
            'judul'     => 'required',
            'slug'     => 'required',
            'content'   => 'required',
        ]);

       $content = $request->content;
       $image_name = '';
       $dom = new \DomDocument();
       $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
       $imageFile = $dom->getElementsByTagName('img');
 
           foreach($imageFile as $item => $image){
               
               $data = $image->getAttribute('src');
               
               $data = substr($data, strpos($data, ",") + 1);  
               $src  = substr($data, strrpos($data, '/') + 1);
               //list($type, $data) = explode(';', $data);
               //list(, $data)      = explode(',', $data);

               if($src == $request->images){
                $image_name = '/upload/'.$src;
               }else{

                   $data = substr($data, strpos($data, ",") + 1);  
                   //list($type, $data) = explode(';', $data);
                   //list(, $data)      = explode(',', $data);

                   $imgeData = base64_decode($data);
                   //echo '<br/>'.$data;
                   $image_name= '/upload/' . time().$item.'.png';
                   $path = public_path() . $image_name;
                   file_put_contents($path, $imgeData);
                }
               
               $image->removeAttribute('src');
               $image->setAttribute('src', $image_name);
            }

        $content = $dom->saveHTML();

        $request = array(
                    'content'   => $content,
                    'judul'     => $request['judul'],
                    'slug'      => $request['slug'],
                    'img'       => str_replace('/upload/','',$image_name)
                        );

        $update = $this->tb_page->modify($request, $id);

        if($update)
        {
            //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('pages')
            ->with('success', 'Data Berhasil Diupdate');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        $delete = $this->tb_page->remove($id);
        if($delete){
            return redirect()->route('pages')
            ->with('success', 'Data Berhasil Dihapus');
        }
        
    }
}

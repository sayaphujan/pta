<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ArticleController extends Controller
{
    protected $tb_user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->tb_article = new Article();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            
            $data = $this->tb_article->select_all_ajax();
            return Datatables::of($data)

                        ->addIndexColumn()

                        ->addColumn('action', function($row){

                               $btn = '<a href="articles/show/'.$row->id.'" class="edit btn btn-info btn-sm">Detail</a>&nbsp;&nbsp;&nbsp;<a href="articles/edit/'.$row->id.'" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;&nbsp;&nbsp;<a href="articles/destroy/'.$row->id.'" class="edit btn btn-danger btn-sm">Delete</a>';    
                                return $btn;
                        })
                        ->addColumn('content', function($row){

                               $content = strip_tags($row->content);    
                                return $content;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
        }

        return view('articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
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
               $path = public_path().$image_name;
               file_put_contents($path, $imgeData);
               
               $image->removeAttribute('src');
               $image->setAttribute('src', $image_name);
            }
        }

        $content = $dom->saveHTML();

        $today = date('D', strtotime(date('Y-m-d')));

        switch ($today){
            case 'Sun':
                $today = 'Minggu';
                break;

            case 'Mon':
                $today = 'Senin';
                break;

            case 'Tue':
                $today = 'Selasa';
                break;

            case 'Wed':
                $today = 'Rabu';
                break;

            case 'Thu':
                $today = 'Kamis';
                break;

            case 'Fri':
                $today = 'Jum\'at';
                break;

            case 'Sat':
                $today = 'Sabtu';
                break;

            default:
                $today = '';
        }

        $request = array(
                    'content'   => $content,
                    'judul'     => $request['judul'],
                    'slug'      => $request['slug'],
                    'img'       => str_replace('/upload/','',$image_name),
                    'day_created' => $today,
                    'viewer'    => '0',
                    'posting_by'=> Auth::user()->name,
                    'category_id' => '0'
                        );
        //print_r($request);
        $data = $this->tb_article->store($request);

        if($data)
        {
            //jika data berhasil ditambahkan, akan kembali ke halaman utama
            return redirect()->route('articles')->withStatus(__('Data berhasil ditambahkan.'));
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
        $pages = $this->tb_article->select_one($id);
        return view('articles.detail', compact('pages'));
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
        $articles = $this->tb_article->select_one($id);
        return view('articles.edit', compact('articles'));
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
               $src  = substr($data, strrpos($data, '/') + 1);
               //echo $src;
               //echo '<br>'.$request->images;

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
                   
                //echo '<br/>'.$image_name;

                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }

        $content = $dom->saveHTML();

        $today = date('D', strtotime(date('Y-m-d')));

        switch ($today){
            case 'Sun':
                $today = 'Minggu';
                break;

            case 'Mon':
                $today = 'Senin';
                break;

            case 'Tue':
                $today = 'Selasa';
                break;

            case 'Wed':
                $today = 'Rabu';
                break;

            case 'Thu':
                $today = 'Kamis';
                break;

            case 'Fri':
                $today = 'Jum\'at';
                break;

            case 'Sat':
                $today = 'Sabtu';
                break;

            default:
                $today = '';
        }

        $request = array(
                    'content'   => $content,
                    'judul'     => $request['judul'],
                    'slug'      => $request['slug'],
                    'img'       => str_replace('/upload/','',$image_name),
                    'day_created' => $today,
                    'viewer'    => '0',
                    'posting_by'=> Auth::user()->name,
                    'category_id' => '0'
                        );

        $update = $this->tb_article->modify($request, $id);

        if($update)
        {
            //jika data berhasil diupdate, akan kembali ke halaman utama
            return redirect()->route('articles')->with('success', 'Data Berhasil Diupdate');
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
        $delete = $this->tb_article->remove($id);
        if($delete){
            return redirect()->route('articles')
            ->with('success', 'Data Berhasil Dihapus');
        }
        
    }
}

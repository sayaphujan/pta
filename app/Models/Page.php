<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DataTables;

class Page extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'slug',
        'content',
        'img',
    ];

    public function select_all(){
        $data = Page::select('*');
            return $data;
    }

    public function select_one($id){
        $data = Page::find($id);
            return $data;
    }

    public function select_page($slug){
        $data = Page::find($slug);
            return $data;
    }

    public function store($request){

        /*$request = $request->toArray();

        if(empty($request['img'])){
            $img = '';
        }else{
            $img = $request['img'];
        }
        $udata = array(
                    'judul'      => $request['judul'],
                    'slug'       => $request['slug'],
                    'content'    => $request['content'],
                    'img'        => $img,
                    );

        //print_r($data);*/
        $page = Page::create($request);

        return $page;
        
    }

    public function modify($request, $id){
        /*$request = $request->toArray();

        if(empty($request['img'])){
            $img = '';
        }else{
            $img = $request['img'];
        }
        $udata = array(
                    'judul'      => $request['judul'],
                    'slug'       => $request['slug'],
                    'content'    => $request['content'],
                    'img'        => $img,
                    );*/

        $page = Page::find($id)->update($request);

        return $page;
    }

    public function remove($id){
        $data = Page::find($id)->delete();
        return $data;
    }

    public function select_all_ajax(){
        $data = Page::select(array('pages.id','pages.judul','pages.slug','pages.content','pages.img'));  

        return $data;
    }
}

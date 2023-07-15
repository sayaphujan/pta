<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DataTables;

class Article extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'judul',
        'content',
        'slug',
        'img',
        'day_created',
        'viewer',
        'posting_by',
        'category_id'
    ];

    public function select_all(){
        $data = Article::select('*')->get();
            return $data->toArray();
    }

    public function select_all_slide(){
        $data = Article::select('*')->orderBy('id','desc')->take(5)->get();
        $data = $data->toArray();


        $article = array();

        foreach($data as $data){
            $content = $data['content'];
            $content = preg_replace("/<img[^>]+\>/i", "", $content); 

            // strip tags to avoid breaking any html
            $string = strip_tags($content);
            if (strlen($string) > 500) {

                // truncate string
                $stringCut = substr($string, 0, 800);
                $endPoint = strrpos($stringCut, ' ');
                $url = url('/main/artikel/'.$data['id']);

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '... <a href="'.$url.'">Read More</a>';
            }

            $data['img'] = (!empty($data['img'])) ? $data['img'] : 'kab.png';
            $img = asset('/upload/'.$data['img']);

            $articles[] = array(
                            'id' => $data['id'],
                            'judul' => $data['judul'],
                            'images' => $img,
                            'content' => $string
                            );

        }
           return $articles;
    }

    public function select_one_article($id){
        $data = Article::find($id);
        
        $article = array();

            $data['img'] = (!empty($data['img'])) ? $data['img'] : 'kab.png';
            $img = asset('/upload/'.$data['img']);

            $articles[] = array(
                            'id' => $data['id'],
                            'judul' => $data['judul'],
                            'images' => $img,
                            'content' => $data['content'],
                            'day_created' => $data['day_created'],
                            'created_at' => $data['created_at'],
                            'viewer' => $data['viewer'],
                            'posting_by' => $data['posting_by'],
                            );

           return $articles[0];
    }

    public function select_one($id){
        $data = Article::find($id);
            return $data;
    }

    public function select_page($slug){
        $data = Article::find($slug);
            return $data;
    }

    public function store($request){

        /*$request = $request->toArray();

        if(empty($request['img'])){
            $img = '';
        }else{
            $img = $request['img'];
        }
        
        //$request['slug'] = str_replace(' ','-',strtolower($request['judul']));
        $udata = array(
                    'judul'      => $request['judul'],
                    'slug'       => $request['slug'],
                    'content'    => $request['content'],
                    'img'        => $img,
                    );

        //print_r($data);*/
        $page = Article::create($request);

        return $page;
        
    }

    public function modify($request, $id){
        /*$request = $request->toArray();

        if(empty($request['img'])){
            $img = '';
        }else{
            $img = $request['img'];
        }
        //$request['slug'] = str_replace(' ','-',strtolower($request['judul']));
        $udata = array(
                    'judul'      => $request['judul'],
                    'slug'       => $request['slug'],
                    'content'    => $request['content'],
                    'img'        => $img,
                    );*/

        $page = Article::find($id)->update($request);

        return $page;
        
        //print_r($udata);
    }

    public function remove($id){
        $data = Article::find($id)->delete();
        return $data;
    }

    public function select_all_ajax(){
        $data = Article::select(array('articles.id','articles.judul','articles.slug','articles.content','articles.img'));  

        return $data;
    }
}

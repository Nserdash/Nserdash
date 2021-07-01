<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Music;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\NewsCommentsModel;
use App\Models\LikesModel;
use DB;


class MusicController extends Controller
{
    public function allData() {

        $music = DB::select('CALL music_procedure(?)',[Auth::id()]);
        $cat = new Categories;
        $comment = DB::table('news_comments_models')->join('music', 'music.id', '=', 'news_comments_models.post_id')->join('users', 'users.id', '=', 'news_comments_models.user_id')->get(['news_comments_models.created_at as commenttime','news_comments_models.post_id', 'users.name','news_comments_models.comment','users.id as idusercomment', 'news_comments_models.id as idcomment']);
        return view('music', ['data' => $music, 'datacat' => $cat->all(), 'datacomment' => $comment]);
 
     }

    public function category($cat, $name) {

        $categories = new Categories;

        $wherecategory = DB::table('music')
                     ->select('*')
                     ->where('cat_id', '=', $cat)
                     ->get();

        return view('music', ['cat' => $wherecategory, 'datacat' => $categories->all()]);

    }

    public function publicate(Request $req) {

        $admin = new Music();
        $admin->name = $req->input('name');
        $admin->cat_id = $req->input('cat');
        $admin->user_id = $req->input('user');
        if($req->isMethod('post') && $req->file('img') || $req->file('url') ) {

            $admin->url = $req->file('url')->getClientOriginalName();
            $file = $req->file('url');
            $upload_folder = public_path().'/audio';
            $filename = $file->getClientOriginalName(); 
            $file->move($upload_folder, $filename);
    
            $admin->img = $req->file('img')->getClientOriginalName();
            $file = $req->file('img');
            $upload_folder = 'public/images';
            $filename = $file->getClientOriginalName(); 

            Storage::putFileAs($upload_folder, $file, $filename);
        }

        $admin->save();
        return redirect()->route('music');
        

    } 


}

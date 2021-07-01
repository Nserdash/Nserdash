<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\User;
use App\Models\Music;
use App\Models\NewsCommentsModel;
use DB;

class NewsController extends Controller
{   

    public function submit(Request $req) {

        
        $admin = new News();
        $admin->user_id = $req->input('user_id');
        $admin->text = $req->input('text');
        
        if($req->isMethod('post') && $req->file('img')) {

            $admin->img = $req->file('img')->getClientOriginalName();            
            $file = $req->file('img');
            $upload_folder = 'public/images';
            $filename = $file->getClientOriginalName(); 

            Storage::putFileAs($upload_folder, $file, $filename);
        }

        $admin->save();
        
        return redirect()->route('news.all');
    }

    public function allData() {

        $user = new User;
        $comment = DB::table('news_comments_models')->join('news', 'news.id', '=', 'news_comments_models.post_id')->join('users', 'users.id', '=', 'news_comments_models.user_id')->get(['news_comments_models.created_at as commenttime','news_comments_models.post_id', 'users.name','news_comments_models.comment','users.id as idusercomment', 'news_comments_models.id as idcomment']);
        $result = DB::select('CALL news_procedure(?)',[Auth::id()]);
         return view('welcome', ['data' => $result, 'datacomment' => $comment, 'datamusic' => $user->all()]);

    }


    public function destroy($id) {

        DB::delete('delete from news_comments_models where post_id = ?',[$id]);
        $admin = News::findOrFail($id);
        $admin->delete();
        return back();
        
    }

    public function destroycomment($id) {

        $admin = NewsCommentsModel::findOrFail($id);
        $admin->delete();
        return back();
        
    }

}

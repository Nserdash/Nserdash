<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\NewsCommentsModel;
use DB;

class CommentsController extends Controller
{
    public function comsubmit(Request $req) {

        $admin = new NewsCommentsModel();
        $admin->user_id = $req->input('idusr');
        $admin->post_id = $req->input('post_id');
        $admin->comment = $req->input('comment');
        
        $admin->save();

        return redirect()->back();
    }

}

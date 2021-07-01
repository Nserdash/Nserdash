<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LikesModel;
use DB;

class LikesController extends Controller
{
    public function Like($idnews, $userid) {

        DB::statement('CALL likes_procedure(:u, :p);',
        array(
            'u' => $userid,
            'p' => $idnews,            
        )
    );    
        return redirect()->back();
    }

}

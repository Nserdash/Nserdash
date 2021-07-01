<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    function allData() {
        
        $admin = new User;
        return view('users', ['datauser' => $admin->all()] );

    }

    function profile($id, $name) {
        
        $profile = new User;

        $whereprofile = DB::table('users')
                     ->select('*')
                     ->where('id', '=', $id)
                     ->get();

        return view('profile', ['dataprofile' => $whereprofile] );

    }

    public function red(Request $req) {      
          
        $user = User::find($req->input('id'));       
        $user->sex = $req->input('sex');
        $user->orientation = $req->input('orientation');
        $user->politic = $req->input('politic');
        $user->experiment = $req->input('experiment');

        $user->save();

        return redirect()->back();

    }

    public function desc(Request $req) {      
          
        $user = User::find($req->input('id'));       
        $user->description = $req->input('desc');
        $user->link = $req->input('link');

        $user->save();

        return redirect()->back();

    }

    public function ava(Request $req) {      
          
        $user = User::find(Auth::id());       
        $user->img = $req->file('img')->getClientOriginalName();
        $file = $req->file('img');
        $upload_folder = 'public/images';
        $filename = $file->getClientOriginalName(); 

        Storage::putFileAs($upload_folder, $file, $filename);

        $user->save();

        return redirect()->back();

    }


}

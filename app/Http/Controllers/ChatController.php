<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoomMembers;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function allRooms() {

        $admin = new User;                
        $chats = DB::select('CALL chats_view_procedure(?)',[Auth::id()]);
        return view('chat', ['datauser' => $admin->all(), 'datarooms' => $chats] );
    }

    public function Room($id,$name,$room_id,$img) {        
        $chats = DB::table('room_messages')->join('users','users.id','=','room_messages.user_id')->where('room_id', '=', $room_id)->orderBy('room_messages.id')->get();
        return view('room', ['id' => $id, 'id2' => Auth::id() , 'name' => $name, 'img' => $img, 'dataroom' => $chats ] );
    }

    public function RoomStart(Request $req) {        

        DB::statement('CALL check_or_create_room_procedure(:p, :u, :t);',
        array(
            'u' => $req->input('user_id'),
            'p' => $req->input('user_to_id'),            
            't' => $req->input('message'),            
        )
        );    

        return redirect()->back();
    }

}

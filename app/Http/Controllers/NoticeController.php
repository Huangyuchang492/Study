<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Topic;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller {

    public function index(){
        $user = Auth::user();
        $topic = Topic::all();
        $notices =$user->notices;
        return view('notice.index',compact('topic','notices'));
    }
}


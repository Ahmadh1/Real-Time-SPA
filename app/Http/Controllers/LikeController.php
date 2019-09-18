<?php

namespace App\Http\Controllers;
use Auth;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct() {
        return $this->middleware('jwt');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function like(Reply $reply)  {
        $reply->like()->create([
            'user_id'   =>  3
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unLike(Reply $reply) {
        $reply->like()->where('user_id', '3')->first()->delete();
    }
}


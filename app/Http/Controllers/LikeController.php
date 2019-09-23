<?php

namespace App\Http\Controllers;
use Auth;
use App\Like;
use App\Reply;
use App\Events\LikeEvent;
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
            'user_id'   =>  Auth::id()
        ]);
        broadcast(new LikeEvent($reply->id, 1))->toOthers();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function unLike(Reply $reply) {
        $reply->like()->where('user_id', Auth::id())->first()->delete();
        broadcast(new LikeEvent($reply->id, 0))->toOthers();
    }
}


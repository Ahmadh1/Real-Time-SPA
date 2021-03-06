<?php

namespace App\Http\Controllers;
use App\Reply;
use App\Question;
use Notification;
use Illuminate\Http\Request;
use App\Events\DeleteReplyEvent;
use App\Http\Resources\ReplyResource as rr;
use App\Notifications\NewReplyNotification;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller {
    public function __construct() {
        return $this->middleware('jwt', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question) {
        return rr::collection($question->replies);
    } // end index


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request) {
        $reply = $question->replies()->create($request->all());
        $user = $question->user;
        if ($reply->user_id !==$question->user_id) {
            $user->notify(new NewReplyNotification($reply));    
        }
        return response(['reply' => new rr($reply)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply) {
        return new rr($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Request $request, Reply $reply) {
        $reply->update($request->all());
        return response('Updated', Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply) {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response(NULL, Response::HTTP_NO_CONTENT);
    }
}

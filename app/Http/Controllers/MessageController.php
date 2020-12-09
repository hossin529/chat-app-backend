<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeMessageRequest;
use App\Http\Resources\MessageResource;
use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeMessageRequest $request)
    {
		$message = new Message();
		$message->body = $request['body'];
		$message->read = false;
		$message->user_id = auth()->id();
		$message->conversation_id = (int)$request['conversation_id'];
		$message->save();

		$conversation = $message->conversation;

		$user = User::findOrFail($conversation->user_id == auth()->id() ? $conversation->seconde_user_id: $conversation->user_id);
		$user->pushNotification(auth()->user()->name.' send you a message',$message->body,$message);
		return new MessageResource($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}

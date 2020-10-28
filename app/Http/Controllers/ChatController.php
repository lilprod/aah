<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Events\MessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = auth()->user()->role_id;

        $users = User::orderBy('name')->where('id', '!=', Auth::user()->id)
                        ->where('role_id', '!=', $role)
                        ->get();
 
        return view('chats.index', compact('users'));
    }


    public function fetchAllMessages()
    {
        return Message::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new MessageEvent($message->load('user')))->toOthers();

        return ['status' => 'success'];
    }
}

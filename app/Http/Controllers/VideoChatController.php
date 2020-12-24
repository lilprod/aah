<?php

namespace App\Http\Controllers;

//use Pusher\Pusher;
use Illuminate\Support\Facades\Auth;
use PhpJunior\LaravelVideoChat\Facades\Chat;
use PhpJunior\LaravelVideoChat\Models\File\File;
use Illuminate\Http\Request;
use App\Events\StartVideoChat;

class VideoChatController extends Controller
{
     /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function callUser(Request $request)
    {
        $data['userToCall'] = $request->user_to_call;
        $data['signalData'] = $request->signal_data;
        $data['from'] = Auth::id();
        $data['type'] = 'incomingCall';

        broadcast(new StartVideoChat($data))->toOthers();
    }
    public function acceptCall(Request $request)
    {
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';
        broadcast(new StartVideoChat($data))->toOthers();
    }
    
    public function index(Request $request) 
    {

        $user = $request->user();

        $others = \App\User::where('id', '!=', $user->id)->pluck('name', 'id');

        return view('video_chat.index')->with([

            'user' => collect($request->user()->only(['id', 'name'])),

            'others' => $others
        ]);
    }
    
    public function auth(Request $request) 
    {

        $user = $request->user();

        $socket_id = $request->socket_id;

        $channel_name = $request->channel_name;

        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'encrypted' => true
            ]
        );

        return response(
            $pusher->presence_auth($channel_name, $socket_id, $user->id)
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function index()
    {
        $groups = Chat::getAllGroupConversations();
        $threads = Chat::getAllConversations();

        return view('video_chat.chat')->with([
            'threads' => $threads,
            'groups'  => $groups
        ]);
    }*/

    public function chat($id)
    {
        $conversation = Chat::getConversationMessageById($id);

        return view('chat')->with([
            'conversation' => $conversation
        ]);
    }

    public function groupChat($id)
    {
        $conversation = Chat::getGroupConversationMessageById($id);

        return view('group_chat')->with([
            'conversation' => $conversation
        ]);
    }

    public function send(Request $request)
    {
        Chat::sendConversationMessage($request->input('conversationId'), $request->input('text'));
    }

    public function groupSend(Request $request)
    {
        Chat::sendGroupConversationMessage($request->input('groupConversationId'), $request->input('text'));
    }

    public function sendFilesInConversation(Request $request)
    {
        Chat::sendFilesInConversation($request->input('conversationId') , $request->file('files'));
    }

    public function sendFilesInGroupConversation(Request $request)
    {
        Chat::sendFilesInGroupConversation($request->input('groupConversationId') , $request->file('files'));
    }
}

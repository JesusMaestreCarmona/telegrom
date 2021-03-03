<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receivedMessages()
    {
        $messages = Auth::user()->receivedMessages;
        $messagesToNotify = $messages->where('notified', false);
        Auth::user()->receivedMessages()->whereNotified(false)->update(["notified" => true]);
        $contacts = Auth::user()->contacts;
        $contactRequests = Auth::user()->contactRequests;
        return view('home', ['messages' => $messages, 'users' => $contacts, 'messagesToNotify' => $messagesToNotify, 'contactRequests' => $contactRequests]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function writtenMessages()
    {
        $messages = Auth::user()->writtenMessages;
        $contacts = Auth::user()->contacts;
        $contactRequests = Auth::user()->contactRequests;
        return view('home', ['messages'=>$messages, 'users'=>$contacts, 'contactRequests' => $contactRequests]);
    }

}

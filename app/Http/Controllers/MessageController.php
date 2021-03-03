<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        Message::create([
            'subject' => $request['subject'],
            'body' => $request['body'],
            'writer' => Auth::id(),
            'recipient' => $request['recipient']
        ]);
        return back()->with(['status' => 'Mensaje enviado con éxito', 'type' => 'primary']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        if (!$message->read && $message->getWriter->id != Auth::id()) $message->read = true;
        $message->save();
        $contactRequests = Auth::user()->contactRequests;
        return view('message', ['message'=>$message, 'contactRequests' => $contactRequests]);
    }

}

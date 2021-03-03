<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $added = Auth::user()->contacts()->where('contact', $user->id)->exists();
        $receivedRequest = Auth::user()->contactRequests()->where('user', $user->id)->exists();
        $sentRequest = $user->contactRequests()->where('user', Auth::id())->exists();
        $contactRequests = Auth::user()->contactRequests;
        return view('user', ['user' => $user, 'added' => $added, 'sentRequest' => $sentRequest, 'receivedRequest' => $receivedRequest, 'contactRequests' => $contactRequests]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $genders = Gender::all();
        return view('editUser', ['genders' => $genders]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|min:5|max:255',
            'phone_number' => 'required|string|min:5|max:255',
            'image' => 'image'
        ]);

        $user = User::findOrFail(Auth::id());
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->gender_id = $request->gender;

        if(is_uploaded_file($request->image)){
            $nombreFoto = time() . '_' . $request->file('image')->getClientOriginalName();
            $user->img = $nombreFoto;
            $request->file('image')->storeAs('public/img', $nombreFoto);
        }

        $user->save();

        return back()->with(['status' => 'Datos actualizados con éxito', 'type' => 'primary']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->receivedMessages()->delete();
        $user->writtenMessages()->delete();
        User::destroy($id);
        return back()->with(['status' => 'Contacto borrado con éxito', 'type' => 'primary']);
    }

    public function findByEmail(Request $request) {
        $user = User::where('email', '=', $request->email)->first();
        if ($user != null) {
            return redirect('/user/'.$user->id);
        }
        else {
            return back()->with(['status' => 'Este email no corresponde a ningún usuario', 'type' => 'warning']);
        }
    }

    public function confirmedContacts() {
        $contactRequests = Auth::user()->contactRequests;
        return view('userList', ['users' => Auth::user()->contacts, 'contactRequests' => $contactRequests]);
    }

    public function contactRequests() {
        $contactRequests = Auth::user()->contactRequests;
        return view('userList', ['users' => $contactRequests, 'contactRequests' => $contactRequests]);
    }

    public function requestContact(Request $request) {
        Auth::user()->contacts()->attach($request->id);
        return back()->with(['status' => 'Petición enviada con éxito', 'type' => 'primary']);
    }

    public function deleteRequest(Request $request) {
        User::findOrFail($request->id)->contacts()->detach(Auth::id());
        return back()->with(['status' => 'Petición denegada con éxito', 'type' => 'primary']);
    }

    public function addContact(Request $request) {
        Auth::user()->contacts()->attach($request->id, ['confirmed' => true]);
        Auth::user()->contactRequests()->where('user', $request->id)->update(["confirmed" => true]);
        return back()->with(['status' => 'Contacto añadido con éxito', 'type' => 'primary']);
    }

    public function deleteContact(Request $request) {
        Auth::user()->contacts()->detach($request->id);
        User::findOrFail($request->id)->contacts()->detach(Auth::id());
        return back()->with(['status' => 'Contacto borrado con éxito', 'type' => 'primary']);
    }

    public function adminView() {
        $filteredUsers = User::all()->filter(function ($user) {
            return ($user->receivedReports()->count() >= 3 && !$user->blocked);
        });

        return view('userList', ['users' => $filteredUsers]);
    }

    public function reportUser(Request $request) {
        Auth::user()->sentReports()->attach($request->id);
        return back()->with(['status' => 'Usuario reportado con éxito', 'type' => 'primary']);
    }

    public function blockUser(Request $request) {
        $time = time() + (7 * 24 * 60 * 60);
        $date = date('Y-m-d h:i:s', $time);
        User::findOrFail($request->id)->update(['blocked' => $date]);
        return back()->with(['status' => 'Usuario bloqueado con éxito', 'type' => 'primary']);
    }

}

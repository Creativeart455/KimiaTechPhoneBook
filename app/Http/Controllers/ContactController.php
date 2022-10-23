<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Http\Request;

class ContactController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $contacts = Contact::all();

        return view( 'home', compact( 'contacts' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view( 'createContact' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request ) {
        $contact             = new Contact();
        $contact->first_name = $request->firstName;
        $contact->last_name  = $request->lastName;
        $contact->save();
        Contact::where( 'first_name', $request->firstName )->get()->first()->phones()->save( new Phone( [ 'phoneNumber' => $request->phone ] ) );
        Contact::where( 'first_name', $request->firstName )->get()->first()->emails()->save( new Email( [ 'email' => $request->email ] ) );
        Contact::where( 'first_name', $request->firstName )->get()->first()->addresses()->save( new Address( [ 'addressString' => $request->address ] ) );
        $message = 'Contact successfully added to the database!';
//        return view('home',compact("message"));
//        return response()->json(['success' => 'success'], 200);
        return redirect()->route( 'contact.index' );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        return view( 'showContact' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        return "view('editContact')";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id ) {
        $result = Contact::where( 'id', $id )->get()->first()->delete();
        if ( $result ) {
            return redirect()->route( 'contact.index' );
        } else {
            return 'oops!';

        }
    }
}

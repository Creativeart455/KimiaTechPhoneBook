<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Contact;
use App\Models\Email;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $contacts = Contact::with( [ 'phones', 'addresses', 'emails' ] )->get()->all();

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
        $validate = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ],[
            'firstName.required' => 'Name is must.',
        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }
        $contact             = new Contact();
        $contact->first_name = $request->firstName;
        $contact->last_name  = $request->lastName;
        $contact->save();
        foreach ( $request->phone as $phoneItem ) {
            if(isset($phoneItem)){
                Contact::where( 'first_name', $request->firstName )->get()->first()->phones()->save( new Phone( [ 'phoneNumber' => $phoneItem ] ) );
            }
        }
        foreach ( $request->email as $emailItem ) {
            if(isset($emailItem))
            Contact::where( 'first_name', $request->firstName )->get()->first()->emails()->save( new Email( [ 'email' => $emailItem ] ) );
        }
        foreach ( $request->address as $addressItem ) {
            if(isset($addressItem))
            Contact::where( 'first_name', $request->firstName )->get()->first()->addresses()->save( new Address( [ 'addressString' => $addressItem ] ) );
        }


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
        $contact = Contact::where( 'id', $id )->get()->first();

        return view( 'showContact', compact( 'contact' ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit( $id ) {
        $contact = Contact::where( 'id', $id )->with( [ 'phones', 'addresses', 'emails' ] )->get()->first();

        return view( 'createContact', compact( 'contact' ) );
//        return view('editContact',compact('contact'));

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
        $validate = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ],[
            'firstName.required' => 'Name is must.',
        ]);
        if($validate->fails()){
            return back()->withErrors($validate->errors())->withInput();
        }
        $contact = Contact::find( $id );
        $contactPreviousPhonesModels = $contact->phones->where( 'contact_id', $id )->all();
        foreach ( $contactPreviousPhonesModels as $key => $phoneModel ) {
            $phoneModel->phoneNumber = $request->get( 'phone' )[ $key ];
            $phoneModel->save();

        }
        $previousCount = count( $contactPreviousPhonesModels );
        $incomingCount = count( $request->get( 'phone' ) );
        $diff          = $incomingCount - $previousCount;
        if ( $diff > 0 ) {
            for ( $i = $previousCount; $i < $incomingCount ; $i++ ) {
                $goingIn = $request->get( 'phone' )[ $i ];
                if(isset($goingIn))
                {
                    $contact->phones()->save( new Phone( [ 'phoneNumber' => $goingIn ] ) );
                }
            }
        }

        $contactPreviousEmailModels = $contact->emails->where( 'contact_id', $id )->all();
        foreach ( $contactPreviousEmailModels as $key => $dataModel ) {

            $dataModel->email = $request->get( 'email' )[ $key ];
            $dataModel->save();
        }
        $previousCount2 = count( $contactPreviousEmailModels );
        $incomingCount2 = count( $request->get( 'email' ) );
        $diff2          = $incomingCount2 - $previousCount2;
        if ( $diff2 > 0 ) {
            for ( $i = $previousCount2; $i < $incomingCount2 ; $i++ ) {
                $goingIn2 = $request->get( 'email' )[ $i ];
                if(isset($goingIn2))
                {
                    $contact->emails()->save( new Email( [ 'email' =>  $goingIn2 ] ) );
                }
            }
        }


        $contactPreviousAddressModels = $contact->addresses->where( 'contact_id', $id )->all();
        foreach ( $contactPreviousAddressModels as $key => $dataModel ) {
            $dataModel->addressString = $request->get( 'address' )[ $key ];
            $dataModel->save();
        }
        $previousCount3 = count( $contactPreviousAddressModels );
        $incomingCount3 = count( $request->get( 'address' ) );
        $diff3          = $incomingCount3 - $previousCount3;
        if ( $diff3 > 0 ) {
            for ( $i = $previousCount3; $i < $incomingCount3 ; $i++ ) {
                $goingIn3 = $request->get( 'address' )[ $i ];
                if(isset($goingIn3))
                {
                    $contact->addresses()->save( new Email( [ 'email' =>  $goingIn3 ] ) );
                }

            }
        }
//        $contactPreviousPhonesModel->phoneNumber = $request->get('phone');
//        $phoneNumberIdArray = array();
//        foreach ($contactPreviousPhonesModels as $previousPhone) {
//            $phoneNumberIdArray[] = $previousPhone->id;
//        }
        // Getting values from the blade template form
        $contact->first_name = $request->get( 'firstName' );
        $contact->last_name  = $request->get( 'lastName' );
        $contact->save();
//        if ($contact->phones === null) {
//            $contact->phone()->save(new Phone($request->get('phone'))); // trigger created event
//            // $contact->phone()->create($input);// trigger created event
//        } else {
//            $contact->phones->get()->first()->update($request->get('phone')); // trigger updated event
//            // $contact->phone()->update($input); // will NOT trigger updated event
//        }
//        Contact::where( 'first_name', $request->firstName )->get()->first()->phones()->save( new Phone( [ 'phoneNumber' => $request->phone ] ) );
//        Contact::where( 'first_name', $request->firstName )->get()->first()->emails()->save( new Email( [ 'email' => $request->email ] ) );
//        Contact::where( 'first_name', $request->firstName )->get()->first()->addresses()->save( new Address( [ 'addressString' => $request->address ] ) );
        $message = 'Contact successfully added to the database!';


        return redirect()->route( 'contact.index' );
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

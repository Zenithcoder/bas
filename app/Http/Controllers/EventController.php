<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    public function index()
    {
       
    	return view('front');
    }


    public function store(Request $request)
    {
       $this->validate($request,[
            'name'=>'required',
            'phone'=> 'required',
            'email'=>'required|email'
            ]);
            
            Property::create($request->all());

      Mail::send('mail.prop',
        array(
            'name' => $request->get('name'),
            'lname' => $request->get('lname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'facility' => $request->get('facility'),
            'service' => $request->get('service')
        ), function($message)
    {
        $message->from('donot-reply@mitaneon.com');
        $message->to(['foluajiboye@yahoo.com','folu@mitaneon.com','info@mitaneon.com'], 'Admin')->subject('Mitaneon Facility Management Booking');
    });

  return Redirect()->route('home.property')->with('message', 'Thanks for booking with us!');
        
    }
}

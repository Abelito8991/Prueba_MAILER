<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\Mailer;
use App\Models\Mail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Inertia\Inertia;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->isAdmin()){
            $mails = Mail::all();
        }else{
            $mails = Mail::where('from', auth()->user()->email)->get();
        }
        return Inertia::render('User', ['mails'=>$mails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Auth/CreateEmail');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'to'    => ['email', 'required'],
            'topic' => ['max:100', 'required', 'string'],
            'body'   => ['required', 'string']
        ]);


        $email = Mail::create([
            'from'  => $request->user()->email,
            'to'    => $request->to,
            'topic' => $request->topic,
            'body'  => $request->body,
            'status'=> 'Enviando'
        ]);

        dispatch(new SendEmail($email));

        return to_route('userDashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

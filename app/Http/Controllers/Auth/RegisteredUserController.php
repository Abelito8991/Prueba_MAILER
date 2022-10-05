<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'phoneNumber'   => ['numeric', 'max:10', 'nullable'],
            'cedula'        => ['string', 'max:11'],
            'bdate'         => ['required', 'date', 'before:-18years'],
            'zipcode'       => ['required', 'numeric'],
            'country'       => ['string'],
            'state'         => ['string'],
            'city'          => ['string', 'nullable'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'User',
            'phoneNumber'   => $request->phoneNumber,
            'cedula'    => $request->cedula,
            'bdate' => $request->bdate,
            'zipcode'   => $request->zipcode,
            'country'   => $request->country,
            'state' => $request->state,
            'city'  => $request->city,
        ]);

        return redirect(RouteServiceProvider::HOME);
    }
}

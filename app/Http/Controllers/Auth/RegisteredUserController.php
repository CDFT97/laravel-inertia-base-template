<?php

namespace App\Http\Controllers\Auth;

use App\Repositories\CountryRepository;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    protected $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }
    
    public function create(): Response
    {
        $countries = $this->countryRepository->all();
        return Inertia::render('Auth/Register', compact('countries'));
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'country_id' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
        ]);
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'country_id' => $request->country_id,
            'password' => Hash::make($request->password),
            'rol' => 0
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

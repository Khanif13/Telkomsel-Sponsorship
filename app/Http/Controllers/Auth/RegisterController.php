<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => [
                'required',
                'string',
                'min:10',
                'max:15',
                function ($attribute, $value, $fail) {
                    if (preg_match('/^(?:0|\+?62)(\d{3})/', $value, $matches)) {
                        $prefix = $matches[1];
                        $validPrefixes = ['811', '812', '813', '821', '822', '823', '851', '852', '853'];
                        if (! in_array($prefix, $validPrefixes)) {
                            $fail("{$prefix} bukan prefix nomor Telkomsel yang valid.");
                        }
                    } else {
                        $fail('Format nomor telepon tidak valid.');
                    }
                },
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $baseUsername = explode('@', $data['email'])[0];
        $username = $baseUsername;
        $counter = 1;

        while (\App\Models\User::where('username', $username)->exists()) {
            $username = $baseUsername.$counter;
            $counter++;
        }

        return User::create([
            'name' => $data['name'],
            'username' => $username,
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
            'role' => 'user',
        ]);
    }
}

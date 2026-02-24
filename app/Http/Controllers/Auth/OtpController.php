<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class OtpController extends Controller
{
    public function showPhoneForm()
    {
        return view('auth.otp-phone');
    }

    public function generate(Request $request)
    {
        $request->validate([
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
                            $fail("{$prefix} wasn't a Telkomsel number.");
                        }
                    } else {
                        $fail('The phone number format is invalid.');
                    }
                },
            ],
        ]);

        $otp = rand(100000, 999999);

        Cache::put('otp_'.$request->phone_number, $otp, now()->addMinutes(5));

        session(['otp_phone' => $request->phone_number]);

        return redirect()->route('otp.verify')->with('simulated_otp', $otp);
    }

    public function showVerifyForm()
    {
        if (! session('otp_phone')) {
            return redirect()->route('otp.login');
        }

        return view('auth.otp-verify');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $phone = session('otp_phone');
        $cachedOtp = Cache::get('otp_'.$phone);

        if ($cachedOtp && $cachedOtp == $request->otp) {

            $user = User::firstOrCreate(
                ['phone_number' => $phone],
                [
                    'name' => 'Applicant '.$phone,
                    'password' => bcrypt(Str::random(16)),
                    'role' => 'user',
                ]
            );

            Auth::login($user);

            $request->session()->regenerate();

            Cache::forget('otp_'.$phone);
            session()->forget('otp_phone');

            return redirect()->route('home');
        }

        if ($cachedOtp) {
            session()->flash('simulated_otp', $cachedOtp);
        }

        return back()->withErrors(['otp' => 'The OTP code is invalid or has expired.']);
    }
}

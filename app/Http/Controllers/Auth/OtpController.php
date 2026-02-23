<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OtpController extends Controller
{
    public function showPhoneForm()
    {
        return view('auth.otp-phone');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|min:10|max:15',
        ]);

        // 1. Generate 6 digit angka acak
        $otp = rand(100000, 999999);

        // 2. Simpan di sistem Cache Laravel dengan batas waktu 5 Menit
        Cache::put('otp_'.$request->phone_number, $otp, now()->addMinutes(5));

        // 3. Simpan nomor HP di session agar halaman verifikasi tahu nomor siapa
        session(['otp_phone' => $request->phone_number]);

        // 4. SIMULASI: Redirect ke halaman verifikasi dengan pesan berisi OTP
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

        // Jika OTP benar
        if ($cachedOtp && $cachedOtp == $request->otp) {

            $user = User::firstOrCreate(
                ['phone_number' => $phone],
                [
                    'name' => 'Applicant '.$phone,
                    'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                    'role' => 'user',
                ]
            );

            Auth::login($user);

            // FIX: Regenerate session agar login benar-benar tersimpan dan tidak terlempar saat klik Settings
            $request->session()->regenerate();

            Cache::forget('otp_'.$phone);
            session()->forget('otp_phone');

            return redirect()->route('home');
        }

        // FIX: Jika salah ketik, flash/tampilkan kembali OTP-nya ke layar agar tidak hilang (Khusus untuk prototype)
        if ($cachedOtp) {
            session()->flash('simulated_otp', $cachedOtp);
        }

        return back()->withErrors(['otp' => 'The OTP code is invalid or has expired.']);
    }
}

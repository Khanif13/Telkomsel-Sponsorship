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

        // 5. Cek apakah OTP cocok
        if ($cachedOtp && $cachedOtp == $request->otp) {

            // Jika cocok, cari user. Jika belum ada di DB, OTOMATIS buatkan akun baru!
            $user = User::firstOrCreate(
                ['phone_number' => $phone],
                [
                    'name' => 'Pemohon '.$phone, // Nama dummy untuk pendaftar baru
                    'password' => bcrypt(Str::random(16)), // Password acak tidak terpakai
                    'role' => 'user',
                ]
            );

            // Masuk (Login)
            Auth::login($user);

            // Bersihkan jejak OTP demi keamanan
            Cache::forget('otp_'.$phone);
            session()->forget('otp_phone');

            return redirect()->route('home');
        }

        return back()->withErrors(['otp' => 'Kode OTP salah atau sudah kedaluwarsa!']);
    }
}

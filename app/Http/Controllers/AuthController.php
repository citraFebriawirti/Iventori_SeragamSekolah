<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function register()
    {
        $data['user'] = DB::table('users')->get();
        return view('pages.halaman_admin.auth.register', $data);
    }


    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'nama_users' => 'required',
            'email' => 'required|email|unique:Users,email',
            'password' => 'required',
            'gambar_users' => 'required'
        ])->validate();

        if ($request->file('gambar_users')) {
            $file = $request->file('gambar_users');
            $nama_file = $file->getClientOriginalName();
            $tujuan_upload = 'images/gambar_users/';
            $file->move($tujuan_upload, $nama_file);
        }

        $createData = User::create([
            'id_users' => User::GenerateID(),
            'nama_users' => $request->nama_users,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gambar_users' => $tujuan_upload . $nama_file
        ]);

        if ($createData) {
            return redirect()->route('login')->with('success', 'Selamat Anda Berhasil!!');
        }


        return redirect()->route('register')->with('error', 'Anda Tidak Bisa Login');
    }

    public function login()
    {

        return view('pages.halaman_admin.auth.login');
    }
    public function loginProcces(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        if (Auth::attempt(['email' => $validasi['email'], 'password' => $validasi['password']])) {

            $request->session()->regenerate();

            // membuat session
            Session(['id_users' => auth()->user()->id_users]);
            Session(['email' => auth()->user()->email]);
            Session(['password' => auth()->user()->password]);

            return redirect()->intended('/dashboard')->with('success', 'Selamat Datang ' . auth()->user()->nama_users);
        }
        return  redirect()->intended('/login')->with('error', 'Data anda tidak ada pada sistem kami ');
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil Logout !!');
    }
}

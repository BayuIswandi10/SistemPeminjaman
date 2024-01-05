<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        Session::flash('username', $request->Username);

        $request->validate([
            'Username' => 'required',
            'Password' => 'required'
        ], [
            'Username.required' => 'Username wajib diisi.',
            'Password.required' => 'Password wajib diisi.'
        ]);

        echo 'alert(' . $request->Username . ');';
        echo 'alert(' . $request->Password . ');';
        // $penggunas = pengguna::where('username', $request->Username)->where('password',$request->Password)->where('status', '1')->first();
        // echo $penggunas->Nama;
        $info = [
            'username' => $request->get('Username'),
            'password' => $request->get('Password'),
        ];

        $pengguna = Pengguna::where('username', $info['username'])->first();

        if ($pengguna) {
            // Autentikasi berhasil
            Auth::guard('pengguna')->login($pengguna);

            //Menyimpan informasi login
            $request->session()->put('logged_in', $pengguna);

            return redirect(route('pengguna.index'))->with('success', 'Login Berhasil!');
        } else {
            // Autentikasi gagal
            return redirect(route('logins.index'))->with('error', 'Username atau Password Salah!');
        }
    }

    public function logout()
    {
        Auth::guard('pengguna')->logout();
        return redirect(route('logins.index'))->with('success', 'Berhasil Logout');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

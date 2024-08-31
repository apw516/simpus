<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function Index()
    {
        return view('Auth.login');
    }
    public function Register()
    {
        return view('Auth.register');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            if (auth()->user()->status == 1) {
            $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }else{
                return back()->with('loginError', 'Login gagal,akun belum diaktivasi !');
            }
        }
        return back()->with('loginError', 'Login gagal !');
    }
    public function store(Request $request)
    {
        $validateData = $request ->
         validate([
            'nama' => 'required|max:255',
            'username' => ['required','min:3','max:255','unique:user'],
            'kode_unit' =>'required',
            'hak_akses' =>'required',
            'password' => 'required|min:5|max:255|same:password2'
        ]);
        $validateData['password'] = Hash::make($validateData['password']);
        $validateData['tanggal_entry'] = $this->get_now();
        User::create($validateData);
        // $request->session()->flash('success','Registration successful, Please Login');
        return redirect('/')->with('success','Registration successful, Please Login');
    }
    public function cari_unit(Request $request)
    {
        $result = DB::table('mt_unit')->where('nama_unit', 'LIKE', '%' . $request['term'] . '%')->where('status', '=', '1')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_unit,
                    'kode' => $row->kode_unit,
                );
            echo json_encode($arr_result);
        }
    }
    public function get_now()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        return $now;
    }
    public function get_date()
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $now = $date;
        return $now;
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

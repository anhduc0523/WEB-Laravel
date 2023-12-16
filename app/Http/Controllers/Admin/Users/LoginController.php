<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    public function index(){
        return view('admin\users\login',[
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        if(Auth::attempt([
            'email'=> $request->input('email'),
            'password'=> $request->input('password')
        ], $request->input('remember'))){
            Session::flash('success','Đăng nhập thành công');
            return redirect()->route('admin');
        }

        Session::flash('error','Email hoặc Password không chính xác');
        return redirect()->back();
    }
}

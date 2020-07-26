<?php

namespace App\Http\Controllers\ControllerUser\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Slide;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function loginus(){
        $slide1 = Slide::orderBy("id","ASC")->where("status",2)->get();
        return view('user.auth.login',compact('slide1'));
    }
    /*
     * kiểm tra thông tin người dùng đăng nhập
     */
    public function postLogin(LoginRequest $request)
    {
        $user = $request->except('_token');
        $dataUser = User::where('email', $request->email)->first();
        if (!$dataUser) {
            return redirect()->back()->with('danger', 'Tên tài khoản hoặc mật khẩu không chính xác');
        }
        if ($dataUser->level == 2 ||  $dataUser->level == 3) {
            return redirect()->route('user.login')->with('danger', 'Thông tin đăng nhập không chính xác');
        }
        // trạng thái người dùng
        if ($dataUser->status == User::STATUS_LOCKED) {
            return redirect()->back()->with('danger', 'Tài khoản của bạn đã bị khóa vui lòng liên hệ quản trị viên.');
        }

        if (Auth::attempt($user)) {
            return redirect()->route('user.home');
        } else {
            return redirect()->back()->with('danger', 'Tên tài khoản hoặc mật khẩu không chính xác');
        }
    }

    /*
     * logout
     */
    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('user.home');
    }
}

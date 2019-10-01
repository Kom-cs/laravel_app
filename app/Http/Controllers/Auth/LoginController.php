<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    protected $maxAttempts = 3; //パスワード入力回数 throttleLoginトレイトで呼び出すRateLimiterで定義
    protected $decayMinutes = 1;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo'; //既ログイン時のリダイレクト先を代入するための変数。

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); //middlewareからメソッドを除外　guest=ログインしてたらhome.blade.phpに飛ばす()
    }

    public function loggedOut(Request $request) //5.6.27以降ならloggedOut()が使える
    {
        return redirect('/login'); //get the URI path from the controller
    }

    /**
     * Log the user out of the application.
     * 
     * @oaram \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//     public function logout(Request $request)
//     {
//         $this->guard()->logout();
//         $request->session()->invalidate(); //セッションをクリアしてIDを再度生成する
//         return redirect('/login');
//     }
}
<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    use RegistersUsers; //trait

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/todo'; //ユーザー登録完了後todoにリダイレクト。register()→login()

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest'); //ログインしてたらhomeにリダイレクト（redirectIfAuthenticated.php）
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     * フロント→バック→DBでvalidationを一致させることでユーザーと適切な連携が出来るようになる。
     */
    protected function validator(array $data) //$data = sended data as a request
    {
        return Validator::make($data, [ //Validatorクラス内のmake()を利用してルール定義。
            'name' => 'required|string|max:255', //ルールは左から順にvalidationされる
            'email' => 'required|string|email|max:255|unique:users', //usersテーブル内でまだ利用されていないアドレスしか使えない
            'password' => 'required|string|min:6|confirmed', // validationAttributesクラスで処理定義。フォーム上のフィールド名_confirmationでルールと連動した比較対象を指定。
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) //create()でrequestデータを登録後にインスタンスとして返す。 save()はboolean型の値を返す。
    {
        return User::create([ //App/Userのcreate()で配列をDBに保存した後にインスタンス化
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), //パスワードをハッシュ化（暗号化）して取得。bcrypt→60文字にハッシュ化 Argon2→ハッシュ化の際のメモリ使用量、回数、使用CPUスレッド数などを設定
        ]); //$fillable
    }
}

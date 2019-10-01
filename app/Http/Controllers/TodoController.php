<?php

namespace App\Http\Controllers; //異なる名前空間内でなら同じ名前のクラスの定義が可能。

use Illuminate\Http\Request; //use ＝ クラスの呼び出し + クラスを呼び出すパスの簡略化
use App\Todo;
use Auth;

class TodoController extends Controller
{
    private $todo; // $this = TodoController

    public function __construct(Todo $instanceClass) //Todo＝モデルを継承したクラス。
    {
        $this->middleware('auth'); //authをmiddlewareに登録。。。非ログイン時にログインページに飛ばす(Authenticate.php)
        $this->todo = $instanceClass; // $this->todo = $todo
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response     //index()で返しているものを説明。
     */
    public function index()
    {
        $todos = $this->todo->getByUserId(Auth::id()); //Authクラス内のメソッドによる認証ID取得 facadeで簡単にクラスを呼び出せる
        return view('todo.index', compact('todos')); //view(ディレクトリ, 使うデータ)
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //新規作成form表示
    {
        return view('todo.create'); //  view/todo/create.blade.php表示
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request // パラメータ＝引数として受け取るもの
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //データはRequestのClosureに自動で渡す。
    {
        $input = $request->all(); //inputタグで送った内容
        $input['user_id'] = Auth::id(); //id取得してuser_idに代入
        $this->todo->fill($input)->save(); //save()でbooleanを返す。attributes＝属性。$input = [_token, title, user_id]
        return redirect()->to('todo'); //redirect()のデフォルトメソッドがGET,URI＝todo
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //todoページでidに紐づいたデータを表示
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //editフォーム表示 $idがURLパラメータになる。
    {
        $todo = $this->todo->find($id); //idを検索。URLのパラメータとして適用。
        return view('todo.edit', compact('todo')); //(view/todo/edit.blade.php, $todo)todo=>Todo
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //idで指定したリソースデータを更新。
    {
        $input = $request->all(); //inputタグで送信するために定義した内容
        $this->todo->find($id)->fill($input)->save(); //$fillableで定義した内容を保存
        return redirect()->to('todo'); //todoページに戻る...redirect()のデフォルトメソッドがGET
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //idで指定したリソースデータを消去する際の処理を定義
    {
        $this->todo->find($id)->delete(); //idに紐づいたデータの消去を実行する部分
        return redirect()->to('todo'); //todoに戻る...redirect()のデフォルトメソッドがGET
    }
}

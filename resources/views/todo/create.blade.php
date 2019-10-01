@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{!! Form::open(['route' => 'todo.store']) !!} <!-- NAMEのtodo.storeを呼び出す。フォームのメソッド=POST。ここでtokenを自動生成する -->
  <div class="form-group">
    {!! Form::input('text','title', null, ['class' => 'form-control', 'placeholder' => 'Todo内容']) !!}
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}
@endsection
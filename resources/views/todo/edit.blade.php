@extends ('layouts.app')
@section('content')

<h2 class="mb=3">ToDo編集</h2>
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!}
  <div class="form-group">
    {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control' ]) !!} <!-- required＝必須項目 -->
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection
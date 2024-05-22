@extends('layouts.app')
@section('content')

<div class="container" style="max-width: 800px">

    @if ($errors->any())
        <div class="alert alert-warning">
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
    @endif

  <form action="" method="POST">
    {{ csrf_field() }}
    <div class="mb-2">
        <label for="">Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="mb-2">
        <label for="">Body</label>
        <textarea name="body" class="form-control"></textarea>
    </div>

    <div class="mb-2">
        <label for="">Category</label>
        <select name="category_id"  class="form-select">
            <option value="1">News</option>
            <option value="2">Tech</option>
        </select>
    </div>
    <button class="btn btn-primary">Add Article</button>
  </form>
</div>

@endsection

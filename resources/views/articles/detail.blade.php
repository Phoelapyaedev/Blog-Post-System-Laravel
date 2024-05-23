@extends('layouts.app')
@section('content')

<div class="container" style="max-width:800px" >
    @if (session("success"))
    <div class="alert alert-info">
        {{session('success')}}
    </div>

    @endif
  <div class="card mb-2 border-primary">
    <div class="card-body">
        <h2>{{$article->title}}</h2>
        <div>
            <b class="text-success">
                {{$article->user->name}}
            </b>
            <small class="text-muted">
                <b>Category::</b>
                        <span class="text-success">
                            {{$article->category->name}}
                        </span>
                {{$article->created_at}}
            </small>
        </div>
        <div class="mb-2" style="font-size: 1.3em">
        {{$article->body}}</div>
        @can('delete-article',$article)
        <a href="{{url("/articles/delete/$article->id")}}" class="btn btn-outline-danger">
            Delete
        </a>
        <a href="{{url("/articles/edit/$article->id")}}" class="btn btn-outline-warning">
            Edit
        </a>
        @endcan
    </div>

  </div>

  <ul class="list-group mt-4">
    <li class="list-group-item active">
        Comments({{count($article->comments)}})
    </li>

    @foreach ($article->comments as $comment)
        <li class="list-group-item">
           @can('delete-comment',$comment)
           <a href="{{url("/comments/delete/$comment->id")}}" class="btn-close float-end"></a>
           @endcan
            <b class="text-success">
                {{$comment->user->name}}
            </b>
            {{$comment->content}}
        </li>
    @endforeach
  </ul>
  <form action="{{url("/comments/add")}}" method="post">
  @csrf
  <input type="hidden" name="article_id" value="{{$article->id}}">
  <textarea name="content" class="form-control my-2" ></textarea>
  <button class="btn btn-secondary">Add Comment</button>

 </form>

</div>

@endsection

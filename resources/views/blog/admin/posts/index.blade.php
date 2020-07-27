@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="btn btn-primary" href="{{ route('blog.admin.posts.index') }}">
                    <span class="">Добавть пост</span>
                </a>
                {{--  <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">
                    <span class="">Добавть пост</span>
                </a>  --}}
            </nav>

            <div class="card">
                <div class="card-body">
                    <h1>здесь будут посты</h1>
                </div>
            </div>
            
            {{--  @if ($paginator->total() > $paginator->count())
            {{ $paginator->links() }}
            @endif  --}}
            
        </div>
    </div>
</div>
@endsection  
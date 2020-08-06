@extends('layouts.app')


@section('content')
    {{-- @if (session(success))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    @endif --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                     <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">
                        <span class="">Добавть пост</span>
                    </a> 
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Автор</th>
                                    <th>Категория</th>
                                    <th>Заголовок</th>
                                    <th>Дата публикации</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paginator as $post)
                                    @php
                                        /**@var \App\Models\Blogpost $post*/
                                    @endphp
                                    <tr @if (!$post->is_published) style="background-color:#ccc;"@endif>
                                        <td>{{ $post->id }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->blogCategory->title }}</td>
                                        {{--  <td>{{ $post->user_id }}</td>
                                        <td>{{ $post->category_id }}</td>  --}}
                                        <td>
                                            <a href="{{ route('blog.admin.posts.edit', $post->id) }}">{{ $post->title }}</a>
                                        </td>
                                        {{--  <td>{{ $post->slug }}</td>  --}}
                                        <td>{{ $post->is_published ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($paginator->total() > $paginator->count())
                    {{ $paginator->links() }}
                @endif 
            </div>
        </div>
    </div>
@endsection  
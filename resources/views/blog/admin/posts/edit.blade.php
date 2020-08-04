@extends('layouts.app')

@section('content')

    <div class="container">

    {{--  @php /**@var \App\Models\BlogPost $item*/ @endphp  --}}

@include('blog.admin.posts.includes.result_messages')

@if ($item->exists)
<form action="{{ route('blog.admin.posts.update', $item->id) }}" method="POST">
    @method('PATCH')
@else
<form action="{{ route('blog.admin.posts.store') }}" method="POST">  
@endif
@csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{--  <h1>тест</h1>  --}}
                @include('blog.admin.posts.includes.item_edit_main_col')
            </div>
            <div class="col-md-3">
                {{--  <h1>тест</h1>  --}}
                @include('blog.admin.posts.includes.item_edit_add_col')
            </div>
        </div>
    </div>
</form>
<hr>
@if ($item->exists)
    <form action="{{ route('blog.admin.posts.destroy', $item->id) }}" method="POST">
        @method('DELETE')
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-blocK">
                    <div class="card-body ml-auto">
                        <button type="submit" class="btn btn-link btn-danger">Удалить</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </form>
@endif

@endsection
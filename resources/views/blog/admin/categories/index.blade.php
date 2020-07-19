@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a type="button" class="btn btn-primary" href="{{ route('blog.admin.categories.create') }}">
                    <span class="">Добавть категорию</span>
                </a>
            </nav>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Категория</th>
                                <th scope="col">Родитель</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paginator as $item)
                            @php
                            /**@var \App\Models\BlogCategory $item*/
                            @endphp
                            <tr>
                                <th scope="row">{{ $item->id }}</th>
                                <td>
                                    <a href="{{ route('blog.admin.categories.edit', $item->id) }}">
                                        {{ $item->title }}
                                    </a>
                                </td>
                                <td
                                    @if (in_array($item->parent_id, [0, 1]))
                                    style = "color:red"
                                    @endif>
                                    {{ $item->parent_id }}{{-- $item->parentCategory->title --}}
                                </td>
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
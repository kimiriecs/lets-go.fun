@extends('layouts.app')

@section('content')
	<div class="conteiner">
		<div class="row justify-content-center">
			<div class="col-md-12">
				<table>
  
				  @foreach ($posts as $post)
				    <tr>
				      <td>{{ $post->id }}</td>
				      <td>{{ $post->title }}</td>
				      <td>{{ $post->created_at }}</td>
				    </tr>
				  @endforeach
				  
				</table>	
			</div>
		</div>
	</div>
@endsection




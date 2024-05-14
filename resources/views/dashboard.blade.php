@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <h1>pagina di admin</h1>


    <ul class="list-group">
        @foreach ($restaurants as $restaurant)
        <li class="list-group-item">{{ $restaurant->restaurant_name }} >select</li>
        @endforeach
    </ul>
</div>
@endsection
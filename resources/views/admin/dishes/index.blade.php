@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1>Lista dei piatti</h1>

    <ul class="list-group">
        @foreach ($dishes as $dish)
        <li class="list-group-item">{{ $dish->dish_name }} >select</li>
        @endforeach
    </ul>


    <a href="{{route('admin.dishes.create')}}" class="btn btn-primary mt-5">Add new dish</a>
    <a href="{{route('admin.dishes.create')}}" class="btn btn-primary mt-5">Add new dish</a>
</div>


@endsection
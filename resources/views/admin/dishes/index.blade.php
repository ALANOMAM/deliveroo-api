@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1>Lista dei piatti</h1>


    <a href="{{route('admin.dishes.create')}}" class="btn btn-primary mt-5">Add new dish</a>
    <a href="{{route('admin.dishes.create')}}" class="btn btn-primary mt-5">Add new dish</a>
</div>


@endsection
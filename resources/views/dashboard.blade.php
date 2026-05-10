@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-2">
        Welcome to your Dashboard
    </h2>

    <p class="text-gray-600">
        Hello <strong>{{ Auth::user()->name }}</strong>, you are logged in!
    </p>
</div>
@endsection
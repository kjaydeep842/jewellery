@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-xl font-semibold mb-2">Welcome, {{ Auth::user()->name }} 👑</h2>
    <p class="text-gray-600">You are logged in as an admin.</p>
</div>
@endsection

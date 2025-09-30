@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Profile</h1>

    <div class="card p-3">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Cell No 1:</strong> {{ $user->cell_no1 ?? '-' }}</p>
        <p><strong>Cell No 2:</strong> {{ $user->cell_no2 ?? '-' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
        <p><strong>Role:</strong> {{ $user->role->name ?? '-' }}</p>
    </div>
</div>
@endsection

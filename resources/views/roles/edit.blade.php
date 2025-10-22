@extends('layouts.app')

@section('title','Edit Role')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Role</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('roles.update',$role) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Role Name</label>
                <input type="text" name="name" value="{{ $role->name }}" 
                       class="form-control @error('name') is-invalid @enderror" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection

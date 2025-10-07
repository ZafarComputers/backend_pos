@extends('layouts.app')

@section('content')
    <h1>Edit Coa Main</h1>
    <form action="{{ route('coa_mains.update', $coaMain) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $coaMain->title }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="1" {{ $coaMain->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$coaMain->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
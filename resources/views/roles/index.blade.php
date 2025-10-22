@extends('layouts.app')

@section('title','Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Roles</h2>
    <!-- Create Button -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
        + Create Role
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Role Name</th>
            <th>Created At</th>
            <th width="200px">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->created_at->format('d M Y') }}</td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-sm btn-warning" 
                            data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $role->id }}">
                        Edit
                    </button>

                    <!-- Delete Button -->
                    <button type="button" class="btn btn-sm btn-danger" 
                            data-bs-toggle="modal" data-bs-target="#deleteRoleModal{{ $role->id }}">
                        Delete
                    </button>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <form action="{{ route('roles.update',$role) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" name="name" value="{{ $role->name }}" 
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deleteRoleModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $role->name }}</strong>?</p>
                  </div>
                  <div class="modal-footer">
                    <form action="{{ route('roles.destroy',$role) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        @empty
            <tr>
                <td colspan="4" class="text-center">No roles found</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Create Modal -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create New Role</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Role Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection




{{-- @extends('layouts.app')

@section('title','Roles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Roles</h2>
    <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Create Role</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Role Name</th>
            <th>Created At</th>
            <th width="180px">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('roles.edit',$role) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('roles.destroy',$role) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this role?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No roles found</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection --}}

@extends('layouts.app')

@section('title', 'Roles')

@section('content')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        showConfirmButton: true,
        timer: 3000
    });
</script>
@endif

<div class="row justify-content-center mt-4">
    <div class="col-md-12">
        {{-- Add New Role Button --}}
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add New Role
            </a>
        </div>

        @if ($roles->isEmpty())
            <div class="alert alert-info text-center">
                No roles found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Role Name</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->status == 1 ? "Active" : "Inactive" }}</td>
                                <td>{{ \Carbon\Carbon::parse($role->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    {{-- <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

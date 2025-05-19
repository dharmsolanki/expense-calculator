@extends('layouts.app')

@section('title', 'Users')
@section('content')
@include('users._search_form_users')
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
                <a href="{{ route('user.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Add New User
                </a>
            </div>

            @if ($users->isEmpty())
                <div class="alert alert-info text-center">
                    No roles found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>email</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->role->name ?? 'No Role' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $user->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($user->trashed())
                                            <form action="{{ route('user.restore', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to restore this user?');">
                                                @csrf
                                                <button class="btn btn-success btn-sm">Restore</button>
                                            </form>
                                        @else
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endif
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

@extends('layouts.app')

@section('title', 'Add Role')

@section('content')
<div class="container">
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

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error') }}",
                showConfirmButton: true
            });
        </script>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header text-white" style="background-color: #4b237b;">
                    <h4 class="mb-0">Add New Role</h4>
                </div>
                <div class="card-body">
                    <form action="{{ isset($role) ? route('roles.edit', $role->id) : route('roles.create')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $role->name ?? '') }}" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="1" {{ old('status', $role->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $role->status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>                        

                        <button type="submit" class="btn text-white w-100" style="background-color: #4b237b;">Add Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

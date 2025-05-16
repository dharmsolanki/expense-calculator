@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="container">
    {{-- Success alert (SweetAlert) --}}
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

    {{-- Error alert (SweetAlert) --}}
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
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-white" style="background-color:#4b237b;">
                    <h4 class="mb-0">Change Password</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('changePassword') }}" method="POST">
                        @csrf

                        {{-- Current Password --}}
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password"
                                   name="current_password"
                                   id="current_password"
                                   class="form-control"
                                   required>
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password"
                                   name="new_password"
                                   id="new_password"
                                   class="form-control"
                                   required>
                            @error('new_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Confirm New Password --}}
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password"
                                   name="new_password_confirmation"
                                   id="new_password_confirmation"
                                   class="form-control"
                                   required>
                            @error('new_password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit"
                                class="btn text-white w-100"
                                style="background-color:#4b237b;">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

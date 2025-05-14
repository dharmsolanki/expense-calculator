@extends('layouts.app')

@section('title', 'Dashboard')

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
    <h2>Dashboard Overview</h2>
    <div class="row">
        @php
        $userId = Auth::id();
        @endphp
        @if ($userId == \App\Models\User::ADMIN_USER_ID)
            
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Users</h5>
                    <p class="card-text">{{count($users)}}</p>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Total Expense</h5>
                    <p class="card-text">&#8377;{{$total_expense}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

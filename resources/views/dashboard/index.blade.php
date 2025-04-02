@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard Overview</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Users</h5>
                    <p class="card-text">Total Users: 120</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Orders</h5>
                    <p class="card-text">Total Orders: 45</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-dollar-sign"></i> Revenue</h5>
                    <p class="card-text">Total Revenue: $5000</p>
                </div>
            </div>
        </div>
    </div>
@endsection

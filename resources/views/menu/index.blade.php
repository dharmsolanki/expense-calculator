@extends('layouts.app')

@section('title', 'Menus')

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

<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #4b237b;">
            <h5 class="mb-0">Menu List</h5>
            <a href="{{ route('menu.create') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus-circle"></i> Create Menu
            </a>
        </div>

        <div class="card-body p-0">
            @if ($menus->isEmpty())
                <div class="alert alert-info text-center m-4">
                    No Menu found.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Menu Title</th>
                                <th>URL</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Allowed Roles</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $menu->name }}</td>
                                    <td><code>{{ $menu->url }}</code></td>
                                    <td><i class="{{ $menu->icon_class }}"></i></td>
                                    <td>
                                        <span class="badge {{ $menu->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $menu->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $allowedRoleIds = json_decode($menu->roles_allowed, true) ?? [];
                                            $allowedRoles = App\Models\Role::whereIn('id', $allowedRoleIds)->pluck('name')->toArray();
                                        @endphp
                                        @if (!empty($allowedRoles))
                                            @foreach ($allowedRoles as $role)
                                                <span class="badge bg-info text-dark me-1">{{ $role }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">None</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($menu->created_at)->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

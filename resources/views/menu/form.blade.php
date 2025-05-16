@extends('layouts.app')

@section('title', 'Create Menu')

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
                        <h4 class="mb-0">{{ isset($menu) ? 'Update Menu' : 'Add New Menu' }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ isset($menu) ? route('menu.edit', $menu->id) : route('menu.create') }}"
                            method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Menu Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name', $menu->name ?? '') }}" required>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">Route Name</label>
                                <input type="text" name="url" id="url" class="form-control"
                                    value="{{ old('url', $menu->url ?? '') }}" required>
                                @error('url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="url" class="form-label">Icon</label>
                                <input type="text" name="icon_class" id="icon_class" class="form-control"
                                    value="{{ old('url', $menu->icon_class ?? '') }}" required>
                                @error('icon_class')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Parent Menu (Optional)</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">-- None --</option>
                                    {{-- @foreach ($allMenus as $parent)
                                    <option value="{{ $parent->id }}" 
                                        {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach --}}
                                </select>
                                @error('parent_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1"
                                        {{ old('status', $menu->status ?? '') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0"
                                        {{ old('status', $menu->status ?? '') == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Allowed Roles</label>
                                <div>
                                    @php
                                        // Decode roles_allowed JSON or fallback to empty array
                                        $allowedRoles = isset($menu) ? json_decode($menu->roles_allowed ?? '[]', true) : [];
                                    @endphp
                            
                                    @foreach ($roles as $role)
                                        <div class="form-check form-check-inline">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                name="roles_allowed[]"
                                                id="role_{{ $role->id }}"
                                                value="{{ $role->id }}"
                                                {{ in_array($role->id, $allowedRoles) ? 'checked' : '' }}
                                            >
                                            <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>                            
                            

                            <button type="submit" class="btn text-white w-100" style="background-color: #4b237b;">
                                {{ isset($menu) ? 'Update Menu' : 'Add Menu' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<form method="GET" action="{{ route('addUser') }}" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="Search by name">
        </div>

        <div class="col-md-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ request('email') }}" placeholder="Search by email">
        </div>

        <div class="col-md-3">
            <label for="role_id" class="form-label">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                <option value="">All Roles</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">All</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="col-md-2 mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
            <a href="{{ route('addUser') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </div>
</form>

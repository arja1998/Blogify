@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')
<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">User Management</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @error('error')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th width="30%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-info text-dark">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @if($user->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Blocked</span>
                            @endif
                        </td>
                        <td>
                            {{-- Block / Unblock --}}
                            @if($user->id !== auth()->id())
                                <form method="POST"
                                      action="{{ route('admin.users.toggle-status', $user) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm
                                        {{ $user->is_active ? 'btn-danger' : 'btn-success' }}">
                                        {{ $user->is_active ? 'Block' : 'Unblock' }}
                                    </button>
                                </form>
                            @endif

                            {{-- Assign Author --}}
                            @if(! $user->roles->contains('name', 'author'))
                                <form method="POST"
                                      action="{{ route('admin.users.assign-author', $user) }}"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning">
                                        Make Author
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $users->links() }}

    </div>
</div>
@endsection

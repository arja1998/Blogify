@extends('admin.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Categories</h4>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="mb-3">
            @csrf
            <input name="name" class="form-control mb-2" placeholder="Category name">
            <button class="btn btn-primary">Add Category</button>
        </form>

        <table class="table">
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Tags')

@section('content')
<div class="card">
    <div class="card-body">
        <h4>Tags</h4>

        <form method="POST" action="{{ route('admin.tags.store') }}" class="mb-3">
            @csrf
            <input name="name" class="form-control mb-2" placeholder="Tag name">
            <button class="btn btn-primary">Add Tag</button>
        </form>

        <table class="table">
            @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->name }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.tags.destroy', $tag) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection

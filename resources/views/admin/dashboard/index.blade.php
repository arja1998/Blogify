@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">

    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Total Users</h5>
                <h2>{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Total Blogs</h5>
                <h2>{{ $totalBlogs }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Draft Blogs</h5>
                <h2>{{ $draftBlogs }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5>Pending Comments</h5>
                <h2>{{ $pendingComments }}</h2>
            </div>
        </div>
    </div>

</div>



<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Most Viewed Blogs</h5>

        <canvas id="viewsChart" height="120"></canvas>
    </div>
</div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('viewsChart');
    if (!canvas) {
        console.warn('viewsChart canvas not found');
        return;
    }

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topBlogs->pluck('title')) !!},
            datasets: [{
                label: 'Views',
                data: {!! json_encode($topBlogs->pluck('view_count')) !!},
                backgroundColor: '#4B49AC'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

});
</script>



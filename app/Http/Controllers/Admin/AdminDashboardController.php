<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalUsers'    => User::count(),
            'totalBlogs'    => Blog::count(),
            'draftBlogs'    => Blog::where('status', 'draft')->count(),
            'pendingComments' => Comment::where('status', 'pending')->count(),

            'topBlogs' => Blog::orderByDesc('view_count')
            ->take(5)
            ->get(['title', 'view_count']),
        ]);
        
    }
}

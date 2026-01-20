<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * List all users (except admin self-protection handled in view)
     */
    public function index()
    {
        $users = User::with('roles')->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Block / Unblock user
     */
    public function toggleStatus(User $user)
    {
        // Prevent blocking self
        if ($user->id === Auth::id()) {
            return back()->withErrors('You cannot block yourself.');
        }

        $user->update([
            'is_active' => ! $user->is_active,
        ]);

        return back()->with('success', 'User status updated.');
    }

    /**
     * Assign author role
     */
    public function assignAuthor(User $user)
    {
        $authorRole = Role::where('name', 'author')->first();

        if (! $authorRole) {
            return back()->withErrors('Author role not found.');
        }

        // Prevent duplicate role
        if (! $user->roles()->where('name', 'author')->exists()) {
            $user->roles()->attach($authorRole);
        }

        return back()->with('success', 'Author role assigned.');
    }
}

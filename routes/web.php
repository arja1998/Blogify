 <?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Author\AuthorBlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicBlogController;





use Illuminate\Support\Facades\Route; 



 

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


Route::get('/', HomeController::class)->name('home');
Route::get('/blog/{slug}', [PublicBlogController::class, 'show'])->name('blog.show');

Route::middleware(['auth', 'blocked', 'role:author'])
    ->prefix('author')
    ->name('author.')
    ->group(function () {

    Route::resource('blogs', AuthorBlogController::class);
    });


Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.submit');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');
});


    Route::middleware(['auth', 'blocked', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {



    Route::get('dashboard',[AdminDashboardController::class,'index'])->name('dashboard');
     Route::get('/users', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::post('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])
            ->name('users.toggle-status');

        Route::post('/users/{user}/assign-author', [AdminUserController::class, 'assignAuthor'])
            ->name('users.assign-author');

           Route::get('/blogs', [AdminBlogController::class, 'index'])
            ->name('blogs.index');

        Route::post('/blogs/{blog}/publish', [AdminBlogController::class, 'publish'])
            ->name('blogs.publish');

        Route::post('/blogs/{blog}/archive', [AdminBlogController::class, 'archive'])
            ->name('blogs.archive');

        Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])
            ->name('blogs.destroy');

        Route::post('/blogs/{id}/restore', [AdminBlogController::class, 'restore'])
            ->name('blogs.restore');
         Route::get('/comments', [AdminCommentController::class, 'index'])
            ->name('comments.index');

        Route::post('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])
            ->name('comments.approve');

        Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])
            ->name('comments.destroy');

        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/tags', [AdminTagController::class, 'index'])->name('tags.index');
        Route::post('/tags', [AdminTagController::class, 'store'])->name('tags.store');
        Route::put('/tags/{tag}', [AdminTagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])->name('tags.destroy');


});


Route::middleware(['auth', 'blocked'])->group(function () {
    Route::post('/blog/{blog}/comment', [CommentController::class, 'store'])
        ->name('comment.store');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});





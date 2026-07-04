<?php

use App\Http\Controllers\Admin\WebsiteContentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['web'])->group(function () {
    Route::get('/', [HomeController::class , 'index'])->name('public.index');

    Route::prefix('services')->name('public.services.')->group(function () {
        Route::get('/', function () {
            return view('services.index');
        })->name('index');

        Route::get('/event-management', function () {
            return view('services.event-management');
        })->name('event-management');

        Route::get('/media-production', function () {
            return view('services.media-production');
        })->name('media-production');

        Route::get('/sports-marketing', function () {
            return view('services.sports-marketing');
        })->name('sports-marketing');

        Route::get('/custom-printing', function () {
            return view('services.custom-printing');
        })->name('custom-printing');

        Route::get('/campaign-design', function () {
            return view('services.campaign-design');
        })->name('campaign-design');

        Route::get('/influencer-marketing', function () {
            return view('services.influencer-marketing');
        })->name('influencer-marketing');
    });

    Route::get('/portfolio', function () {
        return view('portfolio.index');
    })->name('public.portfolio');

    Route::get('/about', function () {
        return view('about.index');
    })->name('public.about');

    Route::get('/blog', function () {
        $posts = \Botble\Blog\Models\Post::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        $featuredProducts = app(\Botble\Ecommerce\Repositories\Interfaces\ProductInterface::class)->advancedGet([
            'condition' => ['status' => 'published', 'is_featured' => 1],
            'take' => 4,
            'order_by' => ['created_at' => 'desc'],
            'with' => ['categories'],
        ]);
        return view('blog.index', compact('posts', 'featuredProducts'));
    })->name('public.blog');

    Route::get('/custom-orders', function () {
        return view('custom-orders.index');
    })->name('public.custom-orders');

    Route::post('/od-contact-submit', [ContactController::class, 'submitContact'])->name('public.contact.submit');
    Route::post('/od-custom-order-submit', [ContactController::class, 'submitCustomOrder'])->name('public.custom-orders.submit');

    Route::post('/admin-login', function (Illuminate\Http\Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            if ($user->isSuperUser() || $user->hasPermission('dashboard.index')) {
                return redirect('/admin/website-content');
            }
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'You do not have admin access.']);
        }
        return redirect('/login')->withErrors(['email' => 'Invalid email or password.']);
    })->name('public.admin-login');
});

// Admin Logout — redirects to public login
Route::get('/do-logout', function (Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::guard()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->middleware('web')->name('admin.do.logout');

// Admin Website Content Management Routes
Route::middleware(['web', 'auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::prefix('website-content')->name('website-content.')->group(function () {
        Route::get('/', [WebsiteContentController::class, 'index'])->name('index');
        Route::get('/{pageId}/edit', [WebsiteContentController::class, 'edit'])->name('edit');
        Route::put('/{pageId}', [WebsiteContentController::class, 'update'])->name('update');
        Route::post('/blog/posts/store', [WebsiteContentController::class, 'storeBlogPost'])->name('blog.posts.store');
        Route::post('/blog/posts/{postId}/update', [WebsiteContentController::class, 'updateBlogPost'])->name('blog.posts.update');
        Route::delete('/blog/posts/{postId}/delete', [WebsiteContentController::class, 'deleteBlogPost'])->name('blog.posts.delete');
    });
});

// Database Update Route
Route::get('/do-update', function () {
    require base_path('update_team.php');
    require base_path('fix_titles.php');
    require base_path('create_author_role.php');
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return "Database Updated and Server Cache Cleared Successfully! You can now delete this route and the PHP files.";
});
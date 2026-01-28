<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CanteenController;
use App\Http\Controllers\Canteen\MenuController;
use App\Http\Controllers\Student\BrowseController;
use App\Http\Controllers\Student\OrderController;
use App\Http\Controllers\Canteen\CanteenOrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Student\FavoriteController;
use App\Http\Controllers\Student\CanteenReviewController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Student\NotificationController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Canteen\DashboardController as CanteenDashboardController;
use App\Models\Canteen;
use App\Models\Order;
use App\Models\User;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'student') {
        return view('student.dashboard');
    }

    if ($user->role === 'canteen') {
        return redirect()->route('canteen.dashboard');
    }

    // optional: admin or default
     return view('dashboard', [
        'canteensCount'    => Canteen::count(),
        'ordersCount'      => Order::count(),
        'usersCount'       => User::count(),
        'todayOrdersCount' => Order::whereDate('created_at', today())->count(),
    ]);
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
// });

Route::get('/', function () {
    return view('welcome'); // or 'auth.login' if you want direct login
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // admin routes
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/canteens', CanteenController::class)
        ->names('admin.canteens');
    Route::get('admin/orders', [AdminOrderController::class, 'index'])
        ->name('admin.orders.index');
    Route::get('admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');
});

Route::middleware(['auth', 'role:canteen'])->group(function () {
    Route::get('/canteen/dashboard', [CanteenDashboardController::class, 'index'])
        ->name('canteen.dashboard');
    Route::resource('canteen/menu', MenuController::class)
        ->names('canteen.menu');
    Route::get('/canteen/orders', [CanteenOrderController::class, 'index'])
        ->name('canteen.orders.index');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
    Route::post('/canteen/orders/{order}/status', [CanteenOrderController::class, 'updateStatus'])
        ->name('canteen.orders.updateStatus');
    Route::post('/canteen/orders/{order}/payment-status', [
    \App\Http\Controllers\Canteen\CanteenOrderController::class,
    'updatePaymentStatus',
])->name('canteen.orders.updatePaymentStatus');

});

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/canteens', [BrowseController::class, 'index'])->name('student.canteens.index');
    Route::get('/canteens/{canteen}', [BrowseController::class, 'show'])->name('student.canteens.show');
    Route::get('/canteens', [BrowseController::class, 'index'])
    ->name('student.canteens.index');
    Route::get('/canteens/{canteen}', [BrowseController::class, 'show'])
    ->name('student.canteens.show');
    Route::post('/orders/{menu}', [OrderController::class, 'store'])->name('student.orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('student.orders.index');
    Route::post('/student/orders/{order}/cancel', [
    \App\Http\Controllers\Student\OrderController::class,
    'cancel',])->name('student.orders.cancel');
    Route::get('/student/menus', [\App\Http\Controllers\Student\MenuBrowseController::class, 'index'])
    ->name('student.menus.index');
    Route::post('/canteens/{canteen}/favorite', [\App\Http\Controllers\Student\FavoriteController::class, 'store'])
    ->name('student.canteens.favorite');
    Route::delete('/canteens/{canteen}/favorite', [\App\Http\Controllers\Student\FavoriteController::class, 'destroy'])
    ->name('student.canteens.unfavorite');
    Route::get('/student/favorites', function () {
    $canteens = auth()->user()->favouriteCanteens()->paginate(12);
    return view('student.canteens.favorites', compact('canteens'));
    })->name('student.canteens.favorites');
    Route::post('/canteens/{canteen}/reviews', [CanteenReviewController::class, 'store'])
    ->name('student.canteens.reviews.store');
    Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('student.notifications.index');

});

// Route::middleware(['auth', 'role:canteen'])->group(function () {
//     // existing menu routes...

//     Route::get('/canteen/orders', [CanteenOrderController::class, 'index'])
//         ->name('canteen.orders.index');
//     Route::post('/canteen/orders/{order}/status', [CanteenOrderController::class, 'updateStatus'])
//         ->name('canteen.orders.updateStatus');
// });

require __DIR__.'/auth.php';


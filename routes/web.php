<?php

use App\Http\Controllers\Backend\PaymentMethodTypeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\AdminWalletController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\NewsPostController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\HomeIndexController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\PersonalController;
use App\Http\Controllers\Backend\PhotoGalleryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PrivacyController;
use App\Http\Controllers\Backend\VideoGalleryController;
use App\Http\Controllers\Backend\SeoSettingController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\TermsController;
use App\Http\Controllers\Frontend\MassageController;
use App\Http\Controllers\Frontend\WalletController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/storage-link', function () {
//     $targetFolder = storage_path('app/public');
//     $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage';
//     symlink($targetFolder, $linkFolder);
// });

Route::get('/', [IndexController::class, 'Index'])->name('home');
Route::get('/all-post', [IndexController::class, 'allPost'])->name('posts');
Route::get('/user-login', [IndexController::class, 'login'])->name('user_login')->middleware('guest');
Route::get('/user-registration', [IndexController::class, 'registration'])->name('user_registration')->middleware('guest');
Route::get('/chat', [IndexController::class, 'chat'])->name('chat');
Route::get('/contact-us', [IndexController::class, 'contact'])->name('contact_us');
Route::get('/about-us', [IndexController::class, 'about'])->name('about_us');
Route::get('/privacy', [IndexController::class, 'privacy'])->name('privacy');
Route::get('/terms', [IndexController::class, 'terms'])->name('terms');
Route::post('/contact-store', [IndexController::class, 'contactStore'])->name('contact_store');

Route::get('/your-post', [IndexController::class, 'yourPost'])->name('your_post');



Route::get('/sell', [IndexController::class, 'sellPOst'])->name('sell');
Route::get('/buy', [IndexController::class, 'buyPost'])->name('buy');


Route::post('/search', [IndexController::class, 'search'])->name('search');
Route::get('/user-profile/{id}', [IndexController::class, 'UserProfile'])->name('profile');

Route::get('/payment/{id}', [WalletController::class, 'Payment']);

Route::get('/chat', [MassageController::class, 'index'])->name('chat');
Route::post('/money-request', [MassageController::class, 'moneyRequest'])->name('money.request');


Route::middleware('auth')->group(function () {
    Route::get('/my-profile', [ProfileController::class, 'profile'])->name('user_profile');
    Route::get('/update-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/document-update', [ProfileController::class, 'VarifyDocument'])->name('document.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/connect/{user_id}', [IndexController::class, 'connect'])->name('connect');
    Route::get('/disconnect/{user_id}', [IndexController::class, 'DisConnect'])->name('disconnect');

    Route::get('tranjections', [IndexController::class, 'Tranjections'])->name('tranjection');

    Route::get('notifications', [IndexController::class, 'Notifications'])->name('notifications');
    Route::get('unread_all', [IndexController::class, 'UnreadAll'])->name('unread_all');
    Route::get('read-notification/{id}', [IndexController::class, 'ReadNotification'])->name('read_notification');


    Route::get('/add-post', [IndexController::class, 'addPost'])->name('user_post.add');
    Route::post('/post_store', [IndexController::class, 'SellStore'])->name('sell_store');


    // web.php
    Route::post('/post_massage/update_amount', [MassageController::class, 'updateAmount'])->name('post_massage.update_amount');
    Route::get('/remove-post-massage/{id}', [MassageController::class, 'RemovePostMassage'])->name('post_massage.remove');
    Route::get('/relise-post-massage/{id}', [MassageController::class, 'RelizeMassage'])->name('post_massage.relise');
    Route::post('/chat.store', [MassageController::class, 'store'])->name('chat.store');

    Route::get('payment-all', [IndexController::class, 'PaymentIndex'])->name('payment_all');
    Route::post('payment-store', [IndexController::class, 'PaymentStore'])->name('payment_store');


    Route::get('deposit-all', [WalletController::class, 'depositIndex'])->name('deposit_all');
    Route::get('deposit-add', [WalletController::class, 'AddDeposit'])->name('deposit_add');
    Route::get('deposit-add-2/{id}', [WalletController::class, 'addDeposit2'])->name('deposit_add1');
    Route::get('deposit-delete/{id}', [WalletController::class, 'depositDelete'])->name('deposit_delete');
    Route::post('deposit-store/', [WalletController::class, 'depositStore'])->name('deposit_store');

    Route::get('withdrow-all', [WalletController::class, 'withdrowIndex'])->name('withdrow_all');
    Route::get('withdrow-add', [WalletController::class, 'AddWithdrow'])->name('withdrow_add');
    Route::get('withdrow-add-2/{id}', [WalletController::class, 'AddWithdrow2'])->name('withdrow_add_2');
    Route::get('withdrow-delete/{id}', [WalletController::class, 'withdrowDelete'])->name('withdrow_delete');
    Route::post('withdrow-store/', [WalletController::class, 'withdrowStore'])->name('withdrow_store');


    Route::get('/user_post/edit/{id}', [IndexController::class, 'sellEdit'])->name('user_post.edit');
    Route::get('/user_post/block/{id}', [IndexController::class, 'sellBlock'])->name('user_post.block');
    Route::patch('/user_post/update/{id}', [IndexController::class, 'SellUpdate'])->name('user_post.update');
    Route::get('/user_post/delete/{id}', [IndexController::class, 'sellDelete'])->name('user_post.delete');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');

    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');

    Route::get('/change/password', [UserController::class, 'ChangePassword'])->name('change.password');

    Route::post('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
});


// End User Middleware

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');

    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');





    Route::get('/deposit-request', [AdminWalletController::class, 'DepositList'])->name('deposit_request.all');
    Route::get('/deposit-request-accept/{id}', [AdminWalletController::class, 'AcceptDeposit'])->name('deposit_request.accept');
    Route::get('/deposit-request-delete/{id}', [AdminWalletController::class, 'DestroyDeposit'])->name('deposit_request.destroy');

    Route::get('/withdrow-request', [AdminWalletController::class, 'WithdrowList'])->name('withdrow_request.all');
    Route::get('/withdrow-request-accept/{id}', [AdminWalletController::class, 'AcceptWithdrow'])->name('withdrow_request.accept');
    Route::delete('/withdrow-request-delete/{id}', [AdminWalletController::class, 'DestroyWithdrow'])->name('withdrow_request.destroy');
}); // End Admin Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class)->name('admin.login');

Route::get('/admin/logout/page', [AdminController::class, 'AdminLogoutPage'])->name('admin.logout.page');





Route::middleware(['auth', 'role:admin'])->group(function () {

    // Category all Route
    Route::controller(CategoryController::class)->group(function () {

        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });





    Route::controller(AdminController::class)->group(function () {

        Route::get('/all/admin', 'AllAdmin')->name('all.admin');
        Route::get('/add/admin', 'Addadmin')->name('add.admin');
        Route::post('/store/admin', 'Storeadmin')->name('admin.store');
        Route::get('/edit/admin/{id}', 'Editadmin')->name('edit.admin');
        Route::post('/update/admin', 'Updateadmin')->name('admin.update');
        Route::get('/delete/admin/{id}', 'Deleteadmin')->name('delete.admin');
        Route::get('/inactive/admin/user/{id}', 'InactiveAdminUser')->name('inactive.admin.user');

        Route::get('/active/admin/user/{id}', 'ActiveAdminUser')->name('active.admin.user');
    });
    Route::get('all/users', [HomeIndexController::class, 'User'])->name('all.user');
    Route::get('delete/user/{id}', [HomeIndexController::class, 'deleteUser'])->name('delete.user');


    Route::get('admin/massage/', [HomeIndexController::class, 'Massageindex'])->name('massage.index');
    Route::post('admi/massage/store', [HomeIndexController::class, 'Massagestore'])->name('massage.store');


    Route::get('post/all', [PostController::class, 'index'])->name('post.index');
    Route::get('post/{id}}', [PostController::class, 'acccept'])->name('post.acccept');
    Route::get('post-resise/{id}}', [PostController::class, 'Relise'])->name('post.relise');
    Route::get('post/{id}', [PostController::class, 'delete'])->name('post.destroy');

    Route::resource('/banner', BannerController::class);
    Route::resource('/payment_method', PaymentMethodController::class);
    Route::resource('/payment_method_type', PaymentMethodTypeController::class);



    Route::get('/about-us/index', [AboutController::class, 'index'])->name('about_us.index');
    Route::post('/about-us/store', [AboutController::class, 'store'])->name('about_us.store');

    Route::get('/privacy/index', [PrivacyController::class, 'index'])->name('privacy.index');
    Route::post('/privacy/store', [PrivacyController::class, 'store'])->name('privacy.store');

    Route::get('/terms-condition/index', [TermsController::class, 'index'])->name('terms.index');
    Route::post('/terms-condition/store', [TermsController::class, 'store'])->name('terms.store');


    Route::get('/contact-messages', [HomeIndexController::class, 'ContactMassage'])->name('contact_massages');
    Route::get('/personal/index', [PersonalController::class, 'index'])->name('personal.index');
    Route::post('/personal/store', [PersonalController::class, 'store'])->name('personal.store');
}); // End Admin Middleware


Route::fallback(function () {
    return view('frontend.404');
});

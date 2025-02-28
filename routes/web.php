<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Content\BannerController;
use App\Http\Controllers\Admin\Content\CategoryController;
use App\Http\Controllers\Admin\Content\CommentController;
use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Content\ProjectController;
use App\Http\Controllers\Admin\Content\VideoController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Ticket\TicketAdminController;
use App\Http\Controllers\Admin\Ticket\TicketCategoryController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Ticket\TicketPriorityController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Auth\Admin\AuthAdminLoginController;
use App\Http\Controllers\Admin\Content\ServiceController;
use App\Http\Controllers\Admin\Content\CKEditorController;
use App\Http\Controllers\Admin\Content\ImageController;
use App\Http\Controllers\Admin\Content\CompanyStatisticController;
use App\Http\Controllers\Site\SiteCommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\SiteBlogController;
use App\Http\Controllers\Site\SiteProjectController;
use App\Http\Controllers\Site\SiteServiceController;
use App\Http\Controllers\Site\SiteContactController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Auth\User\AuthUserLoginController;
use App\Http\Controllers\Auth\User\AuthUserRegisterController;
use App\Http\Controllers\Site\MyAccount\MyAccountController;
use App\Http\Controllers\Site\MyAccount\MyAccountTicketController as MyAccountTicketController;

// routes/web.php
Route::get('/callback/linkedin', function (\Illuminate\Http\Request $request) {
    $code = $request->query('code');
    if ($code) {
        return "کد دریافت شد: " . $code;
    }
    return "خطا: کدی دریافت نشد!";
});

Route::get('/linkedin', function () {
    $linkedinService = new App\Services\LinkedIn\LinkedInService();
    $result = $linkedinService->createImagePost('تست پست با عکس!', asset('logo.png'));
    dd($result);
});

Route::get('/instagram', function () {
    $instagram = new \App\Services\Instagram\InstagramService();
    $result = $instagram->createPost('https://images.unsplash.com/photo-1607799279861-4dd421887fb3?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8cHJvZ3JhbW1pbmd8ZW58MHx8MHx8fDA%3D','posted by laravel');
    dd($result);
});

Route::prefix('admin')->middleware(['is_admin'])->group(function () {

    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.home');


    Route::prefix('content')->group(function () {

        // //category
        Route::prefix('category')->group(function (){
            Route::get('/', [CategoryController::class, 'index'])->name('admin.content.category.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.content.category.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.content.category.store');
            Route::get('/edit/{postCategory}', [CategoryController::class, 'edit'])->name('admin.content.category.edit');
            Route::put('/update/{postCategory}', [CategoryController::class, 'update'])->name('admin.content.category.update');
            Route::delete('/destroy/{postCategory}', [CategoryController::class, 'destroy'])->name('admin.content.category.destroy');
            Route::get('/status/{postCategory}', [CategoryController::class, 'status'])->name('admin.content.category.status');
        });

        //comment
        Route::prefix('comment')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('admin.content.comment.index');
            Route::get('/show/{comment}', [CommentController::class, 'show'])->name('admin.content.comment.show');
            Route::delete('/destroy/{comment}', [CommentController::class, 'destroy'])->name('admin.content.comment.destroy');
            Route::get('/approved/{comment}', [CommentController::class, 'approved'])->name('admin.content.comment.approved');
            Route::get('/status/{comment}', [CommentController::class, 'status'])->name('admin.content.comment.status');
            Route::post('/answer/{comment}', [CommentController::class, 'answer'])->name('admin.content.comment.answer');
        });

        //faq
        Route::prefix('faq')->group(function () {
            Route::get('/', [FAQController::class, 'index'])->name('admin.content.faq.index');
            Route::get('/create', [FAQController::class, 'create'])->name('admin.content.faq.create');
            Route::post('/store', [FAQController::class, 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{faq}', [FAQController::class, 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{faq}', [FAQController::class, 'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{faq}', [FAQController::class, 'destroy'])->name('admin.content.faq.destroy');
            Route::get('/status/{faq}', [FAQController::class, 'status'])->name('admin.content.faq.status');
        });
        //menu
        Route::prefix('menu')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('admin.content.menu.index');
            Route::get('/create', [MenuController::class, 'create'])->name('admin.content.menu.create');
            Route::post('/store', [MenuController::class, 'store'])->name('admin.content.menu.store');
            Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{menu}', [MenuController::class, 'update'])->name('admin.content.menu.update');
            Route::delete('/destroy/{menu}', [MenuController::class, 'destroy'])->name('admin.content.menu.destroy');
            Route::post('/sort', [MenuController::class, 'sort'])->name('admin.content.menu.sort');
            Route::get('/status/{menu}', [MenuController::class, 'status'])->name('admin.content.menu.status');
        });

        //page
        Route::prefix('page')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('admin.content.page.index');
            Route::get('/create', [PageController::class, 'create'])->name('admin.content.page.create');
            Route::post('/store', [PageController::class, 'store'])->name('admin.content.page.store');
            Route::get('/edit/{page}', [PageController::class, 'edit'])->name('admin.content.page.edit');
            Route::put('/update/{page}', [PageController::class, 'update'])->name('admin.content.page.update');
            Route::delete('/destroy/{page}', [PageController::class, 'destroy'])->name('admin.content.page.destroy');
            Route::get('/status/{page}', [PageController::class, 'status'])->name('admin.content.page.status');
        });

        // //post
        Route::prefix('post')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('admin.content.post.index');
            Route::get('/create', [PostController::class, 'create'])->name('admin.content.post.create');
            Route::post('/store', [PostController::class, 'store'])->name('admin.content.post.store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('admin.content.post.edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('admin.content.post.update');
            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('admin.content.post.destroy');
            Route::get('/status/{post}', [PostController::class, 'status'])->name('admin.content.post.status');
            Route::get('/commentable/{post}', [PostController::class, 'commentable'])->name('admin.content.post.commentable');
        });

        //banner
        Route::prefix('banner')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('admin.content.banner.index');
            Route::get('/create', [BannerController::class, 'create'])->name('admin.content.banner.create');
            Route::post('/store', [BannerController::class, 'store'])->name('admin.content.banner.store');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('admin.content.banner.edit');
            Route::put('/update/{banner}', [BannerController::class, 'update'])->name('admin.content.banner.update');
            Route::delete('/destroy/{banner}', [BannerController::class, 'destroy'])->name('admin.content.banner.destroy');
            Route::get('/status/{banner}', [BannerController::class, 'status'])->name('admin.content.banner.status');
        });

        //project
        Route::prefix('project')->group(function () {
            Route::get('/', [ProjectController::class,'index'])->name('admin.content.project.index');
            Route::get('/create', [ProjectController::class,'create'])->name('admin.content.project.create');
            Route::post('/store', [ProjectController::class,'store'])->name('admin.content.project.store');
            Route::get('/edit/{project}',[ProjectController::class,'edit'])->name('admin.content.project.edit');
            Route::put('/update/{project}', [ProjectController::class,'update'])->name('admin.content.project.update');
            Route::delete('/destroy/{project}', [ProjectController::class,'destroy'])->name('admin.content.project.destroy');
            Route::get('/status/{project}', [ProjectController::class,'status'])->name('admin.content.project.status');
        });

        //project
        Route::prefix('video')->group(function () {
            Route::get('/', [VideoController::class,'index'])->name('admin.content.video.index');
            Route::get('/create', [VideoController::class,'create'])->name('admin.content.video.create');
            Route::post('/store', [VideoController::class,'store'])->name('admin.content.video.store');
            Route::get('/edit/{video}',[VideoController::class,'edit'])->name('admin.content.video.edit');
            Route::put('/update/{video}', [VideoController::class,'update'])->name('admin.content.video.update');
            Route::delete('/destroy/{video}', [VideoController::class,'destroy'])->name('admin.content.video.destroy');
            Route::get('/status/{video}', [VideoController::class,'status'])->name('admin.content.video.status');
        });

        Route::prefix('service')->group(function() {
            Route::get('/', [ServiceController::class, 'index'])->name('admin.content.service.index');
            Route::get('/create', [ServiceController::class, 'create'])->name('admin.content.service.create');
            Route::post('/store', [ServiceController::class, 'store'])->name('admin.content.service.store');
            Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('admin.content.service.edit');
            Route::put('/update/{service}', [ServiceController::class, 'update'])->name('admin.content.service.update');
            Route::delete('/destroy/{service}', [ServiceController::class, 'destroy'])->name('admin.content.service.destroy');
            Route::get('/status/{service}', [ServiceController::class, 'status'])->name('admin.content.service.status');
        });

        Route::prefix('image')->controller(ImageController::class)->group(function() {
            Route::get('/', 'index')->name('admin.content.image.index');
            Route::get('/create', 'create')->name('admin.content.image.create');
            Route::post('/store', 'store')->name('admin.content.image.store');
            Route::get('/edit/{image}',  'edit')->name('admin.content.image.edit');
            Route::put('/update/{image}',  'update')->name('admin.content.image.update');
            Route::delete('/destroy/{image}', 'destroy')->name('admin.content.image.destroy');
        });

        Route::post('ckeditor/upload', [CKEditorController::class, 'upload'])->name('admin.content.ckeditor.upload');

        Route::prefix('company-statistic')->controller(CompanyStatisticController::class)->group(function() {
            Route::get('/', 'index')->name('admin.content.company-statistic.index');
            Route::get('/create', 'create')->name('admin.content.company-statistic.create');
            Route::post('/store', 'store')->name('admin.content.company-statistic.store');
            Route::get('/edit/{companyStatistic}', 'edit')->name('admin.content.company-statistic.edit');
            Route::put('/update/{companyStatistic}', 'update')->name('admin.content.company-statistic.update');
            Route::delete('/destroy/{companyStatistic}', 'destroy')->name('admin.content.company-statistic.destroy');
        });

    });

    Route::prefix('user')->namespace('User')->group(function () {

        //admin-user
        Route::prefix('admin-user')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.admin-user.index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.admin-user.create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.admin-user.store');
            Route::get('/edit/{admin}', [AdminUserController::class, 'edit'])->name('admin.user.admin-user.edit');
            Route::put('/update/{admin}', [AdminUserController::class, 'update'])->name('admin.user.admin-user.update');
            Route::delete('/destroy/{admin}', [AdminUserController::class, 'destroy'])->name('admin.user.admin-user.destroy');
            Route::get('/status/{user}', [AdminUserController::class, 'status'])->name('admin.user.admin-user.status');
            Route::get('/activation/{user}', [AdminUserController::class, 'activation'])->name('admin.user.admin-user.activation');
        });

        //customer
        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('admin.user.customer.index');
            Route::get('/create', [CustomerController::class, 'create'])->name('admin.user.customer.create');
            Route::post('/store', [CustomerController::class, 'store'])->name('admin.user.customer.store');
            Route::get('/edit/{user}', [CustomerController::class, 'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{user}', [CustomerController::class, 'update'])->name('admin.user.customer.update');
            Route::delete('/destroy/{user}', [CustomerController::class, 'destroy'])->name('admin.user.customer.destroy');
            Route::get('/status/{user}', [CustomerController::class, 'status'])->name('admin.user.customer.status');
            Route::get('/activation/{user}', [CustomerController::class, 'activation'])->name('admin.user.customer.activation');
        });


    });

    Route::prefix('notify')->namespace('Notify')->group(function () {

        //sms
        Route::prefix('sms')->group(function () {
            Route::get('/', [SMSController::class, 'index'])->name('admin.notify.sms.index');
            Route::get('/create', [SMSController::class, 'create'])->name('admin.notify.sms.create');
            Route::post('/store', [SMSController::class, 'store'])->name('admin.notify.sms.store');
            Route::get('/edit/{sms}', [SMSController::class, 'edit'])->name('admin.notify.sms.edit');
            Route::put('/update/{sms}', [SMSController::class, 'update'])->name('admin.notify.sms.update');
            Route::delete('/destroy/{sms}', [SMSController::class, 'destroy'])->name('admin.notify.sms.destroy');
            Route::get('/status/{sms}', [SMSController::class, 'status'])->name('admin.notify.sms.status');
        });
    });

    Route::prefix('ticket')->namespace('Ticket')->group(function () {

        //category
        Route::prefix('category')->group(function () {
            Route::get('/', [TicketCategoryController::class, 'index'])->name('admin.ticket.category.index');
            Route::get('/create', [TicketCategoryController::class, 'create'])->name('admin.ticket.category.create');
            Route::post('/store', [TicketCategoryController::class, 'store'])->name('admin.ticket.category.store');
            Route::get('/edit/{ticketCategory}', [TicketCategoryController::class, 'edit'])->name('admin.ticket.category.edit');
            Route::put('/update/{ticketCategory}', [TicketCategoryController::class, 'update'])->name('admin.ticket.category.update');
            Route::delete('/destroy/{ticketCategory}', [TicketCategoryController::class, 'destroy'])->name('admin.ticket.category.destroy');
            Route::get('/status/{ticketCategory}', [TicketCategoryController::class, 'status'])->name('admin.ticket.category.status');
        });

        //priority
        Route::prefix('priority')->group(function () {
            Route::get('/', [TicketPriorityController::class, 'index'])->name('admin.ticket.priority.index');
            Route::get('/create', [TicketPriorityController::class, 'create'])->name('admin.ticket.priority.create');
            Route::post('/store', [TicketPriorityController::class, 'store'])->name('admin.ticket.priority.store');
            Route::get('/edit/{ticketPriority}', [TicketPriorityController::class, 'edit'])->name('admin.ticket.priority.edit');
            Route::put('/update/{ticketPriority}', [TicketPriorityController::class, 'update'])->name('admin.ticket.priority.update');
            Route::delete('/destroy/{ticketPriority}', [TicketPriorityController::class, 'destroy'])->name('admin.ticket.priority.destroy');
            Route::get('/status/{ticketPriority}', [TicketPriorityController::class, 'status'])->name('admin.ticket.priority.status');
        });

        //admin
        Route::prefix('admin')->group(function () {
            Route::get('/', [TicketAdminController::class, 'index'])->name('admin.ticket.admin.index');
            Route::get('/set/{admin}', [TicketAdminController::class, 'set'])->name('admin.ticket.admin.set');
        });

        //main
        Route::get('/', [TicketController::class, 'index'])->name('admin.ticket.index');
        Route::get('/new-tickets', [TicketController::class, 'newTickets'])->name('admin.ticket.newTickets');
        Route::get('/open-tickets', [TicketController::class, 'openTickets'])->name('admin.ticket.openTickets');
        Route::get('/close-tickets', [TicketController::class, 'closeTickets'])->name('admin.ticket.closeTickets');
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('admin.ticket.show');
        Route::post('/answer/{ticket}', [TicketController::class, 'answer'])->name('admin.ticket.answer');
        Route::get('/change/{ticket}', [TicketController::class, 'change'])->name('admin.ticket.change');
    });

    Route::prefix('setting')->namespace('Setting')->group(function () {

        Route::get('/', [SettingController::class, 'index'])->name('admin.setting.index');
        Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('admin.setting.edit');
        Route::put('/update/{setting}', [SettingController::class, 'update'])->name('admin.setting.update');
        Route::delete('/destroy/{setting}', [SettingController::class, 'destroy'])->name('admin.setting.destroy');
    });

    // contact routes
    Route::prefix('contact')->controller(ContactController::class)->group(function() {
        Route::get('/', 'index')->name('admin.contact.index');
        Route::get('/show/{contact}', 'show')->name('admin.contact.show');
    });

});




Route::prefix('auth')->name('auth.')->group(function () {
   //admin
    Route::prefix('admin')->group(function () {
        Route::get('/login', [AuthAdminLoginController::class, 'login'])->name('admin.login')->middleware('guest');
        Route::post('/check-login', [AuthAdminLoginController::class, 'checkLogin'])->name('admin.check_login')->middleware('guest');
        Route::get('/logout', [AuthAdminLoginController::class, 'logout'])->name('admin.logout')->middleware('auth');
    });

    Route::name('user.')->group(function() {
        Route::post('/login', [AuthUserLoginController::class, 'doLogin'])->name('login-form');
        Route::get('/register', [AuthUserRegisterController::class, 'register'])->name('register-form');
        Route::post('/register', [AuthUserRegisterController::class, 'doRegister'])->name('register');
        Route::get('/logout', [AuthUserLoginController::class, 'logout'])->name('logout');
    });
});
Route::get('/login', [AuthUserLoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->prefix('account')->name('account.')->group(function() {
    Route::get('/', [MyAccountController::class, 'index'])->name('dashboard');
    Route::get('/profile', [MyAccountController::class, 'edit'])->name('profile');
    Route::put('/profile', [MyAccountController::class, 'update'])->name('profile.update');

    Route::resource('tickets', MyAccountTicketController::class);
    Route::post('tickets/{ticket}/reply', [MyAccountTicketController::class, 'reply'])->name('tickets.reply');
    Route::put('tickets/{ticket}/close', [MyAccountTicketController::class, 'close'])->name('tickets.close');
});

Route::prefix('/')->group(function() {

    // Contact Routes
    Route::controller(SiteContactController::class)->prefix('contact')->name('contact.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/contact', 'store')->name('store');
    });


    // Blog Routes
    Route::controller(SiteBlogController::class)->prefix('blog')->name('blog.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/category/{slug}', 'index')->name('category');
        Route::get('/{slug}', 'show')->name('show');
    });

    // Project Routes
    Route::controller(SiteProjectController::class)->prefix('projects')->name('project.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
    });

    // Service Routes
    Route::controller(SiteServiceController::class)->prefix('services')->name('service.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
    });


    // Comment Routes
    Route::controller(SiteCommentController::class)->prefix('comment')->name('comment.')->group(function() {
        Route::post('/store', 'store')->name('store');
    });

    // Home Routes
    Route::controller(HomeController::class)->group(function() {
        Route::get('/', 'index')->name('home');
        Route::get('/faq', 'faq')->name('faq');
        Route::get('/{slug}', 'showPage')->name('page');
    });


});






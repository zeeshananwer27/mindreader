<?php

use App\Http\Controllers\BookController as FrontBookController;
use App\Http\Controllers\CommunicationsController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\User\AiController;
use App\Http\Controllers\User\Auth\AuthorizationController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\Auth\SocialAuthController;
use App\Http\Controllers\User\AuthorProfileController;
use App\Http\Controllers\User\BookContentController;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\SocialAccountController;
use App\Http\Controllers\User\SocialPostController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//book module

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


$globalMiddleware = [
    'firewall.xss',
    'firewall.agent',
    'firewall.php',
    'firewall.bot',
    'firewall.geo',
    'firewall.ip',
    'firewall.lfi',
    'firewall.referrer',
    'firewall.session',
    'firewall.sqli',
    'firewall.swear',
    'firewall.url',
    'sanitizer',
    'https',
    "dos.security",
    'maintenance.mode'
];

try {
    DB::connection()->getPdo();
    if (DB::connection()->getDatabaseName()) array_push($globalMiddleware, "throttle:refresh");
} catch (\Throwable $th) {
    //throw $th;
}

Route::middleware($globalMiddleware)->group(function () {

    #guest user route
    Route::middleware(['guest:web'])->name('auth.')->group(function () {

        #Login route
        Route::controller(LoginController::class)->group(function () {

            Route::get('/login', 'login')->name('login');
            Route::post('/authenticate', 'authenticate')->name('authenticate');
        });


        #Register route
        Route::controller(RegisterController::class)->group(function () {

            Route::get('/register/{referral_code?}', 'create')->name('register');
            Route::post('/register/store', 'store')->name('register.store');

        });

        #otp autorization route
        Route::controller(AuthorizationController::class)->group(function () {

            Route::get('/otp-verification', 'otpVerification')->name('otp.verification');
            Route::get('/email-verification', 'otpVerification')->name('email.verification')->withoutMiddleware(['guest:web']);
            Route::post('/otp-verify', 'otpVerify')->name('otp.verify')->withoutMiddleware('guest:web');
            Route::get('/otp-resend', 'otpResend')->name('otp.resend')->withoutMiddleware('guest:web');
        });

        #password route
        Route::controller(NewPasswordController::class)->name('password.')->group(function () {

            Route::get('forgot-password', 'create')->name('request');
            Route::post('password/email', 'store')->name('email');
            Route::get('password/verify', 'verify')->name('verify');
            Route::post('password/verify/code', 'verifyCode')->name('verify.code');
            Route::get('password/reset', 'resetPassword')->name('reset');
            Route::post('password/update', 'updatePassword')->name('update')->middleware('demo');

        });


        #SOCIAL LOGIN CONTROLLER
        Route::controller(SocialAuthController::class)->name('social.')->group(function () {

            Route::get('login/{medium}', 'redirectToOauth')->name('login');
            Route::get('login/{medium}/callback', 'handleOauthCallback')->name('login.callback');
        });


    });

    #user route
    Route::middleware(['auth:web', 'user.verified', 'kyc'])->prefix('user')->name('user.')->group(function () {

        #logout route
        Route::controller(LoginController::class)->group(function () {
            Route::get('/logout', 'logout')->name('logout')->withoutMiddleware(['kyc', 'user.verified']);
        });

        #home & profile route
        Route::controller(HomeController::class)->group(function () {

            Route::any('dashboard', 'home')->name('home');
            Route::get('profile', 'profile')->name('profile');
            Route::post('profile/update', 'profileUpdate')->name('profile.update');
            Route::post('/update', 'passwordUpdate')->name('password.update');
            Route::post('/affiliate/update', 'affiliateUpdate')->name('affiliate.update');
            Route::post('/webhook/update', 'webhookUpdate')->name('webhook.update');
            Route::get('/notifications', 'notification')->name('notifications');
            Route::post('/read-notification', 'readNotification')->name('read.notification');
        });

        #payment route
        Route::controller(DepositController::class)->prefix('/deposit')->name('deposit.')->group(function () {
            Route::get('/request', 'depositCreate')->name('create');
            Route::post('/process', 'process')->name('process');
            Route::any('/manual/confirm', 'manualPay')->name('manual');
        });

        #basic user route
        Route::controller(UserController::class)->group(function () {

            Route::get('purchase/{slug}', 'planPurchase')->name('plan.purchase');

            # withdraw route
            Route::prefix("/withdraw")->name('withdraw.')->group(function () {
                Route::get('/request', 'withdrawCreate')->name('create');
                Route::post('/request/process', 'withdrawProcess')->name('request.process');
                Route::get('/preview/{trx}', 'withdrawPreview')->name('preview');
                Route::post('/request/submit', 'withdrawRequest')->name('request.submit');
            });

            Route::get('/plans', 'plan')->name('plan');

            #kyc route
            Route::prefix("/kyc")->name('kyc.')->withoutMiddleware(['kyc'])->group(function () {
                Route::get('form', 'kycForm')->name('form');
                Route::post('apply', 'kycApplication')->name('apply');
            });

        });

        #ai conent route
        Route::controller(AiController::class)->prefix("/ai-content")->name('ai.content.')->group(function () {

            Route::get('/list', 'list')->name('list');
            Route::post('/update', 'update')->name('update');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/status', 'updateStatus')->name('update.status');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
            Route::post('/generate', 'generate')->name('generate');

        });

        # support route
        Route::controller(TicketController::class)->name('ticket.')->prefix('ticket/')->group(function () {
            Route::any('/list', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/reply/{ticket_number}', 'show')->name('show');
            Route::post('/reply/store', 'reply')->name('reply');
            Route::post('/file/download', 'download')->name('file.download');
            Route::get('/destroy/{id}', 'destroy')->name('destroy');
        });

        #report route
        Route::controller(ReportController::class)->group(function () {

            Route::prefix("/template/reports")->name('template.report.')->group(function () {
                Route::get('/', 'templateReport')->name('list');
            });
            Route::prefix("/withdraw/reports")->name('withdraw.report.')->group(function () {
                Route::get('/', 'withdrawReport')->name('list');
                Route::get('/details/{id}', 'withdrawDetails')->name('details');
            });
            Route::prefix("/deposit/reports")->name('deposit.report.')->group(function () {
                Route::get('/', 'depositReport')->name('list');
                Route::get('/details/{id}', 'depositDetails')->name('details');
            });
            Route::prefix("/subscription/reports")->name('subscription.report.')->group(function () {
                Route::get('/', 'subscriptionReport')->name('list');
            });


            Route::prefix("/affiliate")->name('affiliate.')->group(function () {
                Route::get('/user/reports', 'affiliateUsers')->name('user.list');
                Route::get('/reports', 'affiliateReport')->name('report.list');
            });
            Route::prefix("/kyc/reports")->name('kyc.report.')->withoutMiddleware(['kyc'])->group(function () {
                Route::get('/', 'kycReport')->name('list');
                Route::get('/details/{id}', 'kycDetails')->name('details');
            });
            Route::prefix("/credit/reports")->name('credit.report.')->group(function () {
                Route::get('/', 'creditReport')->name('list');
            });
            Route::prefix("/transaction/reports")->name('transaction.report.')->group(function () {
                Route::get('/', 'transactionReport')->name('list');
            });

            Route::prefix("/webhook/reports")->name('webhook.report.')->group(function () {
                Route::get('/', 'webhookReport')->name('list');
            });

        });

        #social account and post route
        Route::name('social.')->prefix('social/')->group(function () {


            #Account manager
            Route::controller(SocialAccountController::class)->name('account.')->prefix('account/')->group(function () {

                Route::any('/list', 'list')->name('list');
                Route::get('/platform/list', 'platform')->name('platform');
                Route::get('/create/{platform}', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::post('/reconnect', 'reconnect')->name('reconnect');
                Route::get('/edit/{uid}', 'edit')->name('edit');
                Route::post('/update', 'update')->name('update');
                Route::post('/update/status', 'updateStatus')->name('update.status');
                Route::post('/bulk/action', 'bulk')->name('bulk');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/show/{uid}', 'show')->name('show');

            });


            #Post manager
            Route::controller(SocialPostController::class)->name('post.')->prefix('post/')->group(function () {

                Route::any('/list', 'list')->name('list');
                Route::any('/analytics/dashboard', 'analytics')->name('analytics');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::get('/show/{uid}', 'show')->name('show');

            });

        });

        //books module
        Route::name('book.')->prefix('book/')->group(function () {

            # Default Dashboard
            Route::get('/dashboard', [BookController::class, 'dashboard'])->name('dashboard'); // Display dashboard page
            Route::get('/books-gallery', [BookController::class, 'showGallery'])->name('gallery'); // Display gallery view page

            # Book Manager
            Route::controller(BookController::class)->name('manager.')->prefix('manager/')->group(function () {
                Route::any('/list', 'list')->name('list'); // List all books
                Route::get('/create', 'create')->name('create'); // Display book creation form
                Route::get('/recreate/{id}', 'recreate')->name('recreate');
                Route::post('/recreate/{id}/store', 'recreateSave')->name('recreate.store'); // Store new book
                Route::get('/recreate-external', 'recreateExternal')->name('recreate.external');
                Route::post('/recreate-external/store', 'recreateExternalSave')->name('recreate.external.store'); // Store new book
                Route::post('/store', 'store')->name('store'); // Store new book
                Route::post('/update', 'update')->name('update'); // Update book details
                Route::get('/destroy/{id}', 'destroy')->name('destroy'); // Delete a book
                Route::get('/show/{id}', 'show')->name('show'); // Display book details

                # Book Content
                Route::post('/synopsis/generate', 'generateSynopsis')->name('synopsis.generate'); // Generate book synopsis
                Route::post('/outline/generate', 'generateOutline')->name('outline.generate'); // Generate book outline
                Route::post('/chapter/generate', 'generateChapter')->name('chapter.generate'); // Generate chapter content
                Route::post('/image/generate', 'generateImage')->name('image.generate'); // Generate AI-based images
                Route::post('/audiobook/generate', 'generateAudiobook')->name('audiobook.generate'); // Generate audiobook

                # Book Media
                Route::get('/media/list/{book_id}', 'listMedia')->name('media.list'); // List media for a book
                Route::post('/media/store', 'storeMedia')->name('media.store'); // Store new media
                Route::get('/media/destroy/{id}', 'destroyMedia')->name('media.destroy'); // Delete media

                # Chapter Topics
                Route::get('/topic/list/{chapter_id}', 'listTopics')->name('topic.list'); // List topics for a chapter
                Route::post('/topic/store', 'storeTopic')->name('topic.store'); // Store a new topic
                Route::get('/topic/edit/{id}', 'editTopic')->name('topic.edit'); // Edit a topic
                Route::post('/topic/update/{id}', 'updateTopic')->name('topic.update'); // Update a topic
                Route::get('/topic/destroy/{id}', 'destroyTopic')->name('topic.destroy'); // Delete a topic
            });

            Route::name('edit.')->group(function () {
                Route::get('/{id}/details', [BookContentController::class, 'details'])->name('details'); // Edit detail of existing book
                Route::get('/{id}/synopsis', [BookContentController::class, 'synopsis'])->name('synopsis'); // Edit  synopsis of existing book
                Route::get('/{id}/outlines', [BookContentController::class, 'outlines'])->name('outlines'); // Edit  outlines of existing book
                Route::get('/{id}/cover', [BookContentController::class, 'cover'])->name('cover'); // Edit  cover of existing book
                Route::get('/{id}/chapters/{chapter}', [BookContentController::class, 'chapters'])->name('chapters'); // Edit  chapter of existing book
                Route::get('/{id}/audio', [BookContentController::class, 'audio'])->name('audio'); // Edit  audio of existing book
            });

            # Author Profile Manager
            Route::controller(AuthorProfileController::class)->name('author.')->prefix('author/')->group(function () {
                Route::any('/list', 'list')->name('list'); // List all author profiles
                Route::get('/create', 'create')->name('create'); // Create a new author profile
                Route::post('/store', 'store')->name('store'); // Store a new author profile
                Route::get('/edit/{id}', 'edit')->name('edit'); // Edit an existing author profile
                Route::get('/view/{id}', 'show')->name('show'); // Edit an existing author profile
                Route::put('/update/{id}', 'update')->name('update'); // Update an author profile
                Route::delete('/destroy/{id}', 'destroy')->name('destroy'); // Delete an author profile
            });
        });


    });

    Route::prefix('book/')->name('book.')->group(function () {
        Route::get('/{uid}/landing', [FrontBookController::class, 'landing'])->name('landing');
        Route::get('/{uid}/view', [FrontBookController::class, 'view'])->name('view');
        Route::get('/{uid}/preview', [FrontBookController::class, 'preview'])->name('preview');
    });

    Route::controller(FrontendController::class)->group(function () {

        Route::get('/', 'home')->name('home');
        Route::get('/plans', 'plan')->name('plan');
        Route::get('/blogs', 'blog')->name('blog');
        Route::get('/blogs/{slug}', 'blogDetails')->name('blog.details');
        Route::get('/pages/{slug}', 'page')->name('page');
        Route::get('/integrations/{slug}/{uid}', 'integration')->name('integration');
        Route::get('/services/{slug}/{uid}', 'service')->name('service');
    });

    #Coummunication route
    Route::controller(CommunicationsController::class)->group(function () {

        Route::any('/subscribe', 'subscribe')->name('subscribe');
        Route::get('/contact', 'contact')->name('contact');
        Route::post('/contact/store', 'store')->name('contact.store');
        Route::get('/feedback', 'feedback')->name('feedback');
        Route::post('/feedback/store', 'feedbackStore')->name('feedback.store');

    });

    #CORE CONTROLER
    Route::controller(CoreController::class)
        ->withoutMiddleware(['throttle:refresh', 'dos.security'])
        ->group(function () {

            Route::get('/cron/run', 'cron')->name('cron.run');
            Route::get('/language/change/{code?}', 'languageChange')->name('language.change');
            Route::get('/currency/change/{code?}', 'currencyChange')->name('currency.change');
            Route::get('/optimize-clear', "clear")->name('optimize.clear');

            /** cookie settings */
            Route::get('/set-cookie', 'setCookie');
            Route::get('/accept-cookie', 'acceptCookie')->name("accept.cookie");
            Route::get('/reject-cookie', 'rejectCookie')->name("reject.cookie");
            Route::get('/download-cookie-data', 'downloadCookieData');
            Route::get('subcategories/{category_id}/{html?}', 'getSubcategories')->name('get.subcategories');
            Route::post('get-template', 'getTemplate')->name('get.template');
            Route::post('get-template-categories', 'getTemplateCategories')->name('get.template.category');
            Route::get('template-config', 'templateConfig')->name('template.config');

            /** social account connect callback */
            Route::get('{guard}/account-connect/{medium}/{type?}', 'redirectAccount')->name('account.connect');

            Route::get('account/{medium}/callback', 'handleAccountCallback')->name('account.callback');

        });

});

Route::get('/error/{message?}', function (?string $message = null) {
    abort(403, $message ?? unauthorized_message());
})->name('error')->middleware(['sanitizer', 'https', 'firewall.all']);

Route::get('queue-work', function () {
    return Illuminate\Support\Facades\Artisan::call('queue:work', ['--stop-when-empty' => true]);
})->name('queue.work')->middleware(['sanitizer', 'https', 'firewall.all']);


/** security and captcha */
Route::controller(CoreController::class)->middleware(["sanitizer", 'https', 'firewall.all'])->group(function () {
    Route::get('/security-captcha', "security")->name('dos.security');
    Route::post('/security-captcha/verify', "securityVerify")->name('dos.security.verify');
    Route::get('/default/image/{size}', 'defaultImageCreate')->name('default.image')->withoutMiddleware(['firewall.agent']);
    Route::get('/default-captcha/{randCode}', 'defaultCaptcha')->name('captcha.genarate');
    Route::any('/webhook', 'postWebhook')->name('webhook');
});

Route::get('/maintenance-mode', [CoreController::class, 'maintenanceMode'])->name('maintenance.mode')->middleware(['sanitizer', 'firewall.all']);


Route::get('/access-denied', [CoreController::class, 'accessDenied'])->name('access.denied')->middleware(['sanitizer', 'firewall.all']);










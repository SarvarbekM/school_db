<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
//
//Route::get('/', function () {
//    return redirect('/login');
//})->middleware('guest');

Route::get('login', [\App\Http\Controllers\AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('signIn', [\App\Http\Controllers\AuthController::class, 'signIn'])->name('signIn');
Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


Route::prefix('dashboard')->middleware('auth')->name('dashboard.')->group(function () {
    Route::redirect('/', '/dashboard/profile');

    Route::get('profile', [\App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    Route::post('edit_profile', [\App\Http\Controllers\AuthController::class, 'edit_profile'])->name('edit_profile');
    Route::get('about', [\App\Http\Controllers\AuthController::class, 'about'])->name('about');


    Route::prefix('school')->name('school.')->group(function () {
        Route::redirect('/', '/school/index');

        Route::get('index', [\App\Http\Controllers\SchoolController::class, 'index'])->name('index');
        Route::get('arcade', [\App\Http\Controllers\SchoolController::class, 'arcade'])->name('arcade');
        Route::post('remove', [\App\Http\Controllers\SchoolController::class, 'remove'])->name('remove');
        Route::post('add_edit', [\App\Http\Controllers\SchoolController::class, 'add_edit'])->name('add_edit');
        Route::post('add_class', [\App\Http\Controllers\SchoolController::class, 'add_class'])->name('add_class');
        Route::post('remove_class', [\App\Http\Controllers\SchoolController::class, 'remove_class'])->name('remove_class');
    });

    Route::prefix('class')->name('class.')->group(function () {
        Route::redirect('/', '/class/index');

        Route::get('index', [\App\Http\Controllers\ClassController::class, 'index'])->name('index');
        Route::get('arcade', [\App\Http\Controllers\ClassController::class, 'arcade'])->name('arcade');
        Route::post('remove', [\App\Http\Controllers\ClassController::class, 'remove'])->name('remove');
        Route::post('add_edit', [\App\Http\Controllers\ClassController::class, 'add_edit'])->name('add_edit');
        Route::post('add_lesson', [\App\Http\Controllers\ClassController::class, 'add_lesson'])->name('add_lesson');
        Route::post('remove_lesson', [\App\Http\Controllers\ClassController::class, 'remove_lesson'])->name('remove_lesson');
    });

    Route::prefix('lesson')->name('lesson.')->group(function () {
        Route::redirect('/', '/lesson/index');

        Route::get('index', [\App\Http\Controllers\LessonController::class, 'index'])->name('index');
        Route::post('remove', [\App\Http\Controllers\LessonController::class, 'remove'])->name('remove');
        Route::post('add_edit', [\App\Http\Controllers\LessonController::class, 'add_edit'])->name('add_edit');
    });

    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::redirect('/', '/teacher/index');

        Route::get('index', [\App\Http\Controllers\TeacherController::class, 'index'])->name('index');
        Route::post('remove', [\App\Http\Controllers\TeacherController::class, 'remove'])->name('remove');
        Route::post('add_edit', [\App\Http\Controllers\TeacherController::class, 'add_edit'])->name('add_edit');
    });

    Route::prefix('user')->middleware('admin')->name('user.')->group(function () {
        Route::redirect('/', '/user/index');

        Route::get('index', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
        Route::get('arcade', [\App\Http\Controllers\UserController::class, 'arcade'])->name('arcade');
        Route::post('remove', [\App\Http\Controllers\UserController::class, 'remove'])->name('remove');
        Route::post('add_edit', [\App\Http\Controllers\UserController::class, 'add_edit'])->name('add_edit');
    });


    Route::get('/v1', function () {
        return view('pages/dashboard-v1');
    });
});


//
//Route::get('/', function () {
//	return redirect('/dashboard/v2');
//});

Route::get('/dashboard/v2', function () {
    return view('pages/dashboard-v2');
});
Route::get('/dashboard/v3', function () {
    return view('pages/dashboard-v3');
});
Route::get('/email/inbox', function () {
    return view('pages/email-inbox');
});
Route::get('/email/compose', function () {
    return view('pages/email-compose');
});
Route::get('/email/detail', function () {
    return view('pages/email-detail');
});
Route::get('/widget', function () {
    return view('pages/widget');
});
Route::get('/ui/general', function () {
    return view('pages/ui-general');
});
Route::get('/ui/typography', function () {
    return view('pages/ui-typography');
});
Route::get('/ui/tabs-accordions', function () {
    return view('pages/ui-tabs-accordions');
});
Route::get('/ui/unlimited-nav-tabs', function () {
    return view('pages/ui-unlimited-nav-tabs');
});
Route::get('/ui/modal-notification', function () {
    return view('pages/ui-modal-notification');
});
Route::get('/ui/widget-boxes', function () {
    return view('pages/ui-widget-boxes');
});
Route::get('/ui/media-object', function () {
    return view('pages/ui-media-object');
});
Route::get('/ui/buttons', function () {
    return view('pages/ui-buttons');
});
Route::get('/ui/icons', function () {
    return view('pages/ui-icons');
});
Route::get('/ui/simple-line-icons', function () {
    return view('pages/ui-simple-line-icons');
});
Route::get('/ui/ionicons', function () {
    return view('pages/ui-ionicons');
});
Route::get('/ui/tree-view', function () {
    return view('pages/ui-tree-view');
});
Route::get('/ui/language-bar-icon', function () {
    return view('pages/ui-language-bar-icon');
});
Route::get('/ui/social-buttons', function () {
    return view('pages/ui-social-buttons');
});
Route::get('/ui/intro-js', function () {
    return view('pages/ui-intro-js');
});
Route::get('/bootstrap-4', function () {
    return view('pages/bootstrap-4');
});
Route::get('/form/elements', function () {
    return view('pages/form-elements');
});
Route::get('/form/plugins', function () {
    return view('pages/form-plugins');
});
Route::get('/form/slider-switcher', function () {
    return view('pages/form-slider-switcher');
});
Route::get('/form/validation', function () {
    return view('pages/form-validation');
});
Route::get('/form/wizards', function () {
    return view('pages/form-wizards');
});
Route::get('/form/wizards-validation', function () {
    return view('pages/form-wizards-validation');
});
Route::get('/form/wysiwyg', function () {
    return view('pages/form-wysiwyg');
});
Route::get('/form/x-editable', function () {
    return view('pages/form-x-editable');
});
Route::get('/form/multiple-file-upload', function () {
    return view('pages/form-multiple-file-upload');
});
Route::get('/form/summernote', function () {
    return view('pages/form-summernote');
});
Route::get('/form/dropzone', function () {
    return view('pages/form-dropzone');
});
Route::get('/table/basic', function () {
    return view('pages/table-basic');
});
Route::get('/table/manage/default', function () {
    return view('pages/table-manage-default');
});
Route::get('/table/manage/autofill', function () {
    return view('pages/table-manage-autofill');
});
Route::get('/table/manage/buttons', function () {
    return view('pages/table-manage-buttons');
});
Route::get('/table/manage/colreorder', function () {
    return view('pages/table-manage-colreorder');
});
Route::get('/table/manage/fixed-column', function () {
    return view('pages/table-manage-fixed-column');
});
Route::get('/table/manage/fixed-header', function () {
    return view('pages/table-manage-fixed-header');
});
Route::get('/table/manage/keytable', function () {
    return view('pages/table-manage-keytable');
});
Route::get('/table/manage/responsive', function () {
    return view('pages/table-manage-responsive');
});
Route::get('/table/manage/rowreorder', function () {
    return view('pages/table-manage-rowreorder');
});
Route::get('/table/manage/scroller', function () {
    return view('pages/table-manage-scroller');
});
Route::get('/table/manage/select', function () {
    return view('pages/table-manage-select');
});
Route::get('/table/manage/combine', function () {
    return view('pages/table-manage-combine');
});
Route::get('/email-template/system', function () {
    return view('pages/email-template-system');
});
Route::get('/email-template/newsletter', function () {
    return view('pages/email-template-newsletter');
});
Route::get('/chart/flot', function () {
    return view('pages/chart-flot');
});
Route::get('/chart/morris', function () {
    return view('pages/chart-morris');
});
Route::get('/chart/js', function () {
    return view('pages/chart-js');
});
Route::get('/chart/d3', function () {
    return view('pages/chart-d3');
});
Route::get('/chart/apex', function () {
    return view('pages/chart-apex');
});
Route::get('/calendar', function () {
    return view('pages/calendar');
});
Route::get('/map/vector', function () {
    return view('pages/map-vector');
});
Route::get('/map/google', function () {
    return view('pages/map-google');
});
Route::get('/gallery/v1', function () {
    return view('pages/gallery-v1');
});
Route::get('/gallery/v2', function () {
    return view('pages/gallery-v2');
});
Route::get('/page-option/page-blank', function () {
    return view('pages/page-blank');
});
Route::get('/page-option/page-with-footer', function () {
    return view('pages/page-with-footer');
});
Route::get('/page-option/page-without-sidebar', function () {
    return view('pages/page-without-sidebar');
});
Route::get('/page-option/page-with-right-sidebar', function () {
    return view('pages/page-with-right-sidebar');
});
Route::get('/page-option/page-with-minified-sidebar', function () {
    return view('pages/page-with-minified-sidebar');
});
Route::get('/page-option/page-with-two-sidebar', function () {
    return view('pages/page-with-two-sidebar');
});
Route::get('/page-option/page-full-height', function () {
    return view('pages/page-full-height');
});
Route::get('/page-option/page-with-wide-sidebar', function () {
    return view('pages/page-with-wide-sidebar');
});
Route::get('/page-option/page-with-light-sidebar', function () {
    return view('pages/page-with-light-sidebar');
});
Route::get('/page-option/page-with-mega-menu', function () {
    return view('pages/page-with-mega-menu');
});
Route::get('/page-option/page-with-top-menu', function () {
    return view('pages/page-with-top-menu');
});
Route::get('/page-option/page-with-boxed-layout', function () {
    return view('pages/page-with-boxed-layout');
});
Route::get('/page-option/page-with-mixed-menu', function () {
    return view('pages/page-with-mixed-menu');
});
Route::get('/page-option/boxed-layout-with-mixed-menu', function () {
    return view('pages/page-boxed-layout-with-mixed-menu');
});
Route::get('/page-option/page-with-transparent-sidebar', function () {
    return view('pages/page-with-transparent-sidebar');
});
Route::get('/page-option/page-with-search-sidebar', function () {
    return view('pages/page-with-search-sidebar');
});
Route::get('/extra/timeline', function () {
    return view('pages/extra-timeline');
});
Route::get('/extra/coming-soon', function () {
    return view('pages/extra-coming-soon');
});
Route::get('/extra/search-result', function () {
    return view('pages/extra-search-result');
});
Route::get('/extra/invoice', function () {
    return view('pages/extra-invoice');
});
Route::get('/extra/error-page', function () {
    return view('pages/extra-error-page');
});
Route::get('/extra/profile', function () {
    return view('pages/extra-profile');
});
Route::get('/extra/scrum-board', function () {
    return view('pages/extra-scrum-board');
});
Route::get('/extra/cookie-acceptance-banner', function () {
    return view('pages/extra-cookie-acceptance-banner');
});
Route::get('/login/v1', function () {
    return view('pages/login-v1');
});
Route::get('/login/v2', function () {
    return view('pages/login-v2');
});
Route::get('/login/v3', function () {
    return view('pages/login-v3');
});
Route::get('/register/v3', function () {
    return view('pages/register-v3');
});
Route::get('/helper/css', function () {
    return view('pages/helper-css');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\TicketController;

Route::group(['middleware' => ['check_maintenance']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::get('/permission-denied', [ErrorController::class, 'permissionDenied'])->name('permission.denied');
Route::get('/under-maintenance', [ErrorController::class, 'underMaintenance'])->name('under.maintenance');

Route::group(['prefix' => 'administrator'], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/secure/login', [LoginController::class, 'secure_login'])->name('admin_secure_login');

    Route::group(['middleware' => ['auth:admin', 'check_permission']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/change-password', [DashboardController::class, 'changePassword'])->name('admin.change.passsword');
        Route::post('/update-password',[DashboardController::class, 'updatePassword'])->name('admin.update.passsword'); 
        Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile'); 
        Route::post('/update-profile', [DashboardController::class, 'updateProfile'])->name('admin.profile.update'); 
        
        Route::group(['prefix'=>'admins'], function(){  
            Route::get('/', [AdminController::class, 'index'])->name('admin.admins.index');      
            Route::get('/create', [AdminController::class, 'create'])->name('admin.admins.create');
            Route::post('/store', [AdminController::class, 'store'])->name('admin.admins.store');
            Route::get('/edit/{userId}', [AdminController::class, 'edit'])->name('admin.admins.edit');
            Route::post('/update/{userId}', [AdminController::class, 'update'])->name('admin.admins.update');
            Route::get('/delete/{userId}', [AdminController::class, 'delete'])->name('admin.admins.delete');
        }); 

        Route::group(['prefix'=>'users'], function(){  
            Route::get('/', [UserController::class, 'index'])->name('admin.users.index');       
            Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
            Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
            Route::get('/edit/{userId}', [UserController::class, 'edit'])->name('admin.users.edit');
            Route::post('/update/{userId}', [UserController::class, 'update'])->name('admin.users.update');
            Route::get('/delete/{userId}', [UserController::class, 'delete'])->name('admin.users.delete');
        }); 

        Route::group(['prefix'=>'projects'], function(){            
            Route::get('/', [ProjectController::class, 'index'])->name('admin.project.index');
            Route::get('/create', [ProjectController::class, 'create'])->name('admin.project.create');            
            Route::post('/store', [ProjectController::class, 'store'])->name('admin.project.store');            
            Route::get('/edit/{slug}', [ProjectController::class, 'edit'])->name('admin.project.edit');
            Route::post('/update/{slug}', [ProjectController::class, 'update'])->name('admin.project.update');
            Route::get('/delete/{id}', [ProjectController::class, 'delete'])->name('admin.project.delete');
        }); 
        
        Route::group(['prefix'=>'technologies'], function(){            
            Route::get('/', [TechnologyController::class, 'index'])->name('admin.technology.index');
            Route::get('/create', [TechnologyController::class, 'create'])->name('admin.technology.create');            
            Route::post('/store', [TechnologyController::class, 'store'])->name('admin.technology.store');            
            Route::get('/edit/{slug}', [TechnologyController::class, 'edit'])->name('admin.technology.edit');
            Route::post('/update/{slug}', [TechnologyController::class, 'update'])->name('admin.technology.update');
            Route::get('/delete/{id}', [TechnologyController::class, 'delete'])->name('admin.technology.delete');
        }); 

        Route::group(['prefix'=>'blogs'], function(){            
            Route::get('/', [BlogController::class, 'index'])->name('admin.blog.index');
            Route::get('/create', [BlogController::class, 'create'])->name('admin.blog.create');            
            Route::post('/store', [BlogController::class, 'store'])->name('admin.blog.store');            
            Route::get('/edit/{slug}', [BlogController::class, 'edit'])->name('admin.blog.edit');
            Route::post('/update/{slug}', [BlogController::class, 'update'])->name('admin.blog.update');
            Route::get('/delete/{id}', [BlogController::class, 'delete'])->name('admin.blog.delete');
        });
        
        Route::group(['prefix'=>'blogcategory'], function(){
            Route::get('/category', [BlogController::class, 'category'])->name('admin.blogcategory.index');
            Route::get('/createcategory', [BlogController::class, 'createcategory'])->name('admin.blogcategory.create');            
            Route::post('/storecategory', [BlogController::class, 'storecategory'])->name('admin.blogcategory.store');            
            Route::get('/editcategory/{slug}', [BlogController::class, 'editcategory'])->name('admin.blogcategory.edit');
            Route::post('/updatecategory/{slug}', [BlogController::class, 'updatecategory'])->name('admin.blogcategory.update');
            Route::get('/deletecategory/{id}', [BlogController::class, 'deletecategory'])->name('admin.blogcategory.delete');
        });
        
        Route::group(['prefix'=>'blogtag'], function(){
            Route::get('/tag', [BlogController::class, 'tag'])->name('admin.blogtag.index');
            Route::get('/createtag', [BlogController::class, 'createtag'])->name('admin.blogtag.create');            
            Route::post('/storetag', [BlogController::class, 'storetag'])->name('admin.blogtag.store');            
            Route::get('/edittag/{slug}', [BlogController::class, 'edittag'])->name('admin.blogtag.edit');
            Route::post('/updatetag/{slug}', [BlogController::class, 'updatetag'])->name('admin.blogtag.update');
            Route::get('/deletetag/{id}', [BlogController::class, 'deletetag'])->name('admin.blogtag.delete');
        });

        Route::group(['prefix'=>'cms'], function(){            
            Route::get('/home-edit', [CmsController::class, 'edit'])->name('admin.home.edit');  
            Route::post('/home-update', [CmsController::class, 'update'])->name('admin.home.update');
        });
        
        Route::group(['prefix'=>'content'], function(){            
            Route::get('/', [PageController::class, 'index'])->name('admin.content.index');
            Route::get('/create', [PageController::class, 'create'])->name('admin.content.create');            
            Route::post('/store', [PageController::class, 'store'])->name('admin.content.store');            
            Route::get('/edit/{slug}', [PageController::class, 'edit'])->name('admin.content.edit');
            Route::post('/update/{slug}', [PageController::class, 'update'])->name('admin.content.update');
            Route::get('/delete/{id}', [PageController::class, 'delete'])->name('admin.content.delete');
        }); 

        Route::group(['prefix'=>'social'], function(){            
            Route::get('/', [SocialController::class, 'index'])->name('admin.social.index');
            Route::get('/create', [SocialController::class, 'create'])->name('admin.social.create');            
            Route::post('/store', [SocialController::class, 'store'])->name('admin.social.store');            
            Route::get('/edit/{slug}', [SocialController::class, 'edit'])->name('admin.social.edit');
            Route::post('/update/{slug}', [SocialController::class, 'update'])->name('admin.social.update');
            Route::get('/delete/{id}', [SocialController::class, 'delete'])->name('admin.social.delete');
        });
        
        Route::group(['prefix'=>'roles'], function(){            
            Route::get('/', [RoleController::class, 'index'])->name('admin.roles.index');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.roles.create');            
            Route::post('/store', [RoleController::class, 'store'])->name('admin.roles.store');            
            Route::get('/edit/{slug}', [RoleController::class, 'edit'])->name('admin.roles.edit');
            Route::post('/update/{slug}', [RoleController::class, 'update'])->name('admin.roles.update');
            Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('admin.roles.delete');
        });

        Route::group(['prefix'=>'permissions'], function(){            
            Route::get('/', [PermissionController::class, 'index'])->name('admin.permissions.index');
            Route::get('/create', [PermissionController::class, 'create'])->name('admin.permissions.create');            
            Route::post('/store', [PermissionController::class, 'store'])->name('admin.permissions.store'); 
        });

        Route::group(['prefix'=>'maintenance'], function(){            
            Route::get('/', [MaintenanceController::class, 'index'])->name('admin.maintenance.index');
            Route::get('/create', [MaintenanceController::class, 'create'])->name('admin.maintenance.create');            
            Route::post('/store', [MaintenanceController::class, 'store'])->name('admin.maintenance.store');            
            Route::get('/edit/{slug}', [MaintenanceController::class, 'edit'])->name('admin.maintenance.edit');
            Route::post('/update/{slug}', [MaintenanceController::class, 'update'])->name('admin.maintenance.update');
            Route::get('/delete/{id}', [MaintenanceController::class, 'delete'])->name('admin.maintenance.delete');
        });

        Route::group(['prefix'=>'settings'], function(){ 
            Route::get('/general', [SettingController::class, 'index'])->name('admin.settings.index');
            Route::post('/general-update', [SettingController::class, 'update'])->name('admin.settings.update');
            Route::get('/email', [SettingController::class, 'email'])->name('admin.email.index');
            Route::post('/email-update', [SettingController::class, 'update_email'])->name('admin.email.update');         
            Route::get('/personal', [SettingController::class, 'personal'])->name('admin.personal.index');
            Route::post('/personal-update', [SettingController::class, 'update_personal'])->name('admin.personal.update');
            Route::get('/seo', [SettingController::class, 'seo'])->name('admin.seo.index');
            Route::post('/seo-update', [SettingController::class, 'update_seo'])->name('admin.seo.update');
            Route::get('/contact', [SettingController::class, 'contact'])->name('admin.contact.index');
        }); 

        Route::group(['prefix'=>'templates'], function(){            
            Route::get('/{id}', [TemplateController::class, 'index'])->name('admin.templates.index');
            Route::post('/update/{slug}', [TemplateController::class, 'update'])->name('admin.templates.update');
        });

        Route::group(['prefix'=>'countries'], function(){            
            Route::get('/', [CountryController::class, 'index'])->name('admin.country.index');
            Route::get('/create', [CountryController::class, 'create'])->name('admin.country.create');            
            Route::post('/store', [CountryController::class, 'store'])->name('admin.country.store');            
            Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('admin.country.edit');
            Route::post('/update/{id}', [CountryController::class, 'update'])->name('admin.country.update');
            Route::get('/delete/{id}', [CountryController::class, 'delete'])->name('admin.country.delete');
        });

        Route::group(['prefix'=>'backup'], function(){            
            Route::get('/', [BackupController::class, 'index'])->name('admin.backup.index');
            Route::get('/store', [BackupController::class, 'store'])->name('admin.backup.store');
            Route::get('/download/{id}', [BackupController::class, 'download'])->name('admin.backup.download');
        });

        Route::group(['prefix'=>'tickets'], function(){            
            Route::get('/', [TicketController::class, 'index'])->name('admin.ticket.index');
            Route::get('/create', [TicketController::class, 'create'])->name('admin.ticket.create');            
            Route::post('/store', [TicketController::class, 'store'])->name('admin.ticket.store');            
            Route::get('/edit/{id}', [TicketController::class, 'edit'])->name('admin.ticket.edit');
            Route::post('/update/{id}', [TicketController::class, 'update'])->name('admin.ticket.update');
            Route::get('/delete/{id}', [TicketController::class, 'delete'])->name('admin.ticket.delete');          
            Route::get('/reply/{id}', [TicketController::class, 'reply'])->name('admin.ticket.reply');
            Route::post('/reply/store/{id}', [TicketController::class, 'replyStore'])->name('admin.ticket.reply.store');
        });
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});


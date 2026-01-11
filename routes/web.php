<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LanguageController;
use App\Livewire\Privacy;
use App\Livewire\Terms;
use Illuminate\Support\Facades\Route;

/*
*
* Auth Routes
*
* --------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('index');

// Language Switch
Route::get('language/{language}', [LanguageController::class, 'switch'])->name('language.switch');

Route::group(['namespace' => 'App\Http\Controllers\Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('index');
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {
    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');
    Route::post("update-status", ['as' => "updateStatus", 'uses' => "BackendBaseController@update_status"]);

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['can:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("{$module_name}", "{$controller_name}@index")->name("{$module_name}");
        Route::post("{$module_name}", "{$controller_name}@store")->name("{$module_name}.store");
    });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/markAllAsRead", ['as' => "{$module_name}.markAllAsRead", 'uses' => "{$controller_name}@markAllAsRead"]);
    Route::delete("{$module_name}/deleteAll", ['as' => "{$module_name}.deleteAll", 'uses' => "{$controller_name}@deleteAll"]);
    Route::get("{$module_name}/{id}", ['as' => "{$module_name}.show", 'uses' => "{$controller_name}@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("{$module_name}", ['as' => "{$module_name}.index", 'uses' => "{$controller_name}@index"]);
    Route::get("{$module_name}/create", ['as' => "{$module_name}.create", 'uses' => "{$controller_name}@create"]);
    Route::get("{$module_name}/download/{file_name}", ['as' => "{$module_name}.download", 'uses' => "{$controller_name}@download"]);
    Route::get("{$module_name}/delete/{file_name}", ['as' => "{$module_name}.delete", 'uses' => "{$controller_name}@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("{$module_name}", "{$controller_name}");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("{$module_name}/{id}/resend-email-confirmation", ['as' => "{$module_name}.emailConfirmationResend", 'uses' => "{$controller_name}@emailConfirmationResend"]);
    Route::delete("{$module_name}/user-provider-destroy", ['as' => "{$module_name}.userProviderDestroy", 'uses' => "{$controller_name}@userProviderDestroy"]);
    Route::get("{$module_name}/{id}/change-password", ['as' => "{$module_name}.changePassword", 'uses' => "{$controller_name}@changePassword"]);
    Route::patch("{$module_name}/{id}/change-password", ['as' => "{$module_name}.changePasswordUpdate", 'uses' => "{$controller_name}@changePasswordUpdate"]);
    Route::get("{$module_name}/trashed", ['as' => "{$module_name}.trashed", 'uses' => "{$controller_name}@trashed"]);
    Route::patch("{$module_name}/{id}/trashed", ['as' => "{$module_name}.restore", 'uses' => "{$controller_name}@restore"]);
    Route::get("{$module_name}/index_data", ['as' => "{$module_name}.index_data", 'uses' => "{$controller_name}@index_data"]);
    Route::get("{$module_name}/index_list", ['as' => "{$module_name}.index_list", 'uses' => "{$controller_name}@index_list"]);
    Route::patch("{$module_name}/{id}/block", ['as' => "{$module_name}.block", 'uses' => "{$controller_name}@block", 'middleware' => ['can:block_users']]);
    Route::patch("{$module_name}/{id}/unblock", ['as' => "{$module_name}.unblock", 'uses' => "{$controller_name}@unblock", 'middleware' => ['can:block_users']]);
    Route::resource("{$module_name}", "{$controller_name}");
});

/**
 * File Manager Routes.
 */
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'can:view_backend']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::group([
    'namespace'  => 'App\Http\Controllers\Backend',
    'prefix'     => 'admin',
    'as'         => 'backend.',
    'middleware' => ['auth', 'can:view_backend']
], function () {

    Route::prefix('reports')->as('reports.')->group(function () {

        // ===== Sales =====
        Route::get('/index', 'ReportsController@index')->name('index');
        Route::get('/sales', 'ReportsController@sales')->name('sales');
        Route::get('/transactions', 'ReportsController@transactions')->name('transactions');
        Route::get('/customer-sales', 'ReportsController@customerSales')->name('customerSales');
        Route::get('/product-sales', 'ReportsController@productSales')->name('productSales');
        Route::get('/schedule-sales', 'ReportsController@scheduleSales')->name('scheduleSales');
        Route::get('/area-sales', 'ReportsController@areaSales')->name('areaSales');
        Route::get('/product-performance', 'ReportsController@productPerformance')->name('productPerformance');
        Route::get('/reconciliation', 'ReportsController@reconciliation')->name('reconciliation');

        // ===== Payments =====
        Route::get('/payments-received', 'ReportsController@paymentsReceived')->name('paymentsReceived');
        Route::get('/failed-payments', 'ReportsController@failedPayments')->name('failedPayments');
        Route::get('/monthly-billing', 'ReportsController@monthlyBilling')->name('monthlyBilling');
        Route::get('/driver-cash', 'ReportsController@driverCash')->name('driverCash');
        Route::get('/revenue-per-customer', 'ReportsController@revenuePerCustomer')->name('revenuePerCustomer');
        Route::get('/downloads', 'ReportsController@downloads')->name('downloads');

        // ===== Inventory =====
        Route::get('/inventory', 'ReportsController@inventory')->name('inventory');
        Route::get('/future-inventory', 'ReportsController@futureInventory')->name('futureInventory');
        Route::get('/dispatch', 'ReportsController@dispatch')->name('dispatch');

        // ===== Customer =====
        Route::get('/containers', 'ReportsController@containers')->name('containers');
        Route::get('/customers-by-drivers', 'ReportsController@customersByDrivers')->name('customersByDrivers');

        // ===== Delivery =====
        Route::get('/delivery-sales', 'ReportsController@deliverySales')->name('deliverySales');
        Route::get('/delivery-summary', 'ReportsController@deliverySummary')->name('deliverySummary');
        Route::get('/orders-by-driver', 'ReportsController@ordersByDriver')->name('ordersByDriver');
        Route::get('/rejected-orders', 'ReportsController@rejectedOrders')->name('rejectedOrders');
        Route::get('/area-delivery-summary', 'ReportsController@areaDeliverySummary')->name('areaDeliverySummary');
        Route::get('/area-delivery-detail', 'ReportsController@areaDeliveryDetail')->name('areaDeliveryDetail');
    });
});

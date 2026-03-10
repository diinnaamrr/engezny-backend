<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminModule\Http\Controllers\Web\New\Admin\ActivityLogController;
use Modules\AdminModule\Http\Controllers\Web\New\Admin\DashboardController;
use Modules\AdminModule\Http\Controllers\Web\New\Admin\ReportController;
use Modules\AdminModule\Http\Controllers\Web\New\Admin\SettingController;
use Modules\AdminModule\Http\Controllers\Web\New\Admin\SharedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\HotelController;
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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
        Route::get('fleet-map/{type}', 'fleetMap')->name('fleet-map');
        Route::get('fleet-map-driver-details/{id}', 'fleetMapDriverDetails')->name('fleet-map-driver-details');
        Route::get('fleet-map-view-using-ajax', 'fleetMapViewUsingAjax')->name('fleet-map-view-using-ajax');
        Route::get('fleet-map-view-single-driver/{id}', 'fleetMapViewSingleDriver')->name('fleet-map-view-single-driver');
        Route::get('heat-map', 'heatMap')->name('heat-map');
        Route::get('heat-map-overview-data', 'heatMapOverview')->name('heat-map-overview-data');
        Route::get('heat-map-compare', 'heatMapCompare')->name('heat-map-compare');
        Route::get('recent-trip-activity', 'recentTripActivity')->name('recent-trip-activity');
        Route::get('leader-board-driver', 'leaderBoardDriver')->name('leader-board-driver');
        Route::get('leader-board-customer', 'leaderBoardCustomer')->name('leader-board-customer');
        Route::get('earning-statistics', 'adminEarningStatistics')->name('earning-statistics');
        Route::get('zone-wise-statistics', 'zoneWiseStatistics')->name('zone-wise-statistics');
        Route::get('chatting', 'chatting')->name('chatting');
        Route::get('driver-conversation/{channelId}', 'getDriverConversation')->name('driver-conversation');
        Route::post('send-message-to-driver', 'sendMessageToDriver')->name('send-message-to-driver');
        Route::get('search-drivers', 'searchDriversList')->name('search-drivers');
        Route::get('search-saved-topic-answers', 'searchSavedTopicAnswer')->name('search-saved-topic-answers');
    });
    Route::controller(ActivityLogController::class)->group(function () {
        Route::get('log', 'log')->name('log');
    });
    Route::controller(SettingController::class)->group(function () {
        Route::get('settings', 'index')->name('settings');
        Route::post('update-profile/{id}', 'update')->name('update-profile');
    });
    Route::controller(SharedController::class)->group(function () {
        Route::get('seen-notification', 'seenNotification')->name('seen-notification');
        Route::get('get-notifications', 'getNotifications')->name('get-notifications');
    });

    Route::group(['prefix' => 'tours', 'as' => 'tours.'], function () {
        Route::get('/', [TourController::class, 'index'])->name('index');
        Route::get('create', [TourController::class, 'create'])->name('create');
        Route::post('store', [TourController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TourController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [TourController::class, 'update'])->name('update');
        Route::get('show/{id}', [TourController::class, 'show'])->name('show');
        Route::delete('delete/{id}', [TourController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'hotels', 'as' => 'hotels.'], function () {
        Route::get('/', [HotelController::class, 'index'])->name('index');
        Route::get('create', [HotelController::class, 'create'])->name('create');
        Route::post('store', [HotelController::class, 'store'])->name('store');
        Route::get('edit/{id}', [HotelController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [HotelController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [HotelController::class, 'destroy'])->name('delete');
    });
});
Route::controller(SharedController::class)->group(function () {
    Route::get('lang/{locale}', 'lang')->name('lang');
});


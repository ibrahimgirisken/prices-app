<?php
use App\Http\Controllers\PricesController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\CurrenciesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EarningRatiesController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\OwnersController;
use App\Http\Controllers\XmlProductsController;
use Illuminate\Support\Facades\Route;

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

    Route::get('/', function () {return view('frontend.index');});
    Route::get('/prices' , [PricesController::class, 'getAllPrices'])->name('prices');
    Route::get('/update-prices' , [PricesController::class, 'sendPriceTweakRequest'])->name('update-prices');

    Route::get('/cargo-edit' , [CargoController::class, 'getCargoEdit'])->name('cargo-edit');
    Route::post('/cargo-edit' , [CargoController::class, 'postCargoEdit'])->name('cargo-edit');

    Route::get('/commission-edit' , [ComissionController::class, 'getComissionEdit'])->name('commission-edit');
    Route::post('/commission-edit' , [ComissionController::class, 'postComissionEdit'])->name('commission-edit');

    Route::get('/department-edit' , [DepartmentController::class, 'getDepartmentEdit'])->name('department-edit');
    Route::post('/department-edit' , [DepartmentController::class, 'postDepartmentEdit'])->name('department-edit');

    Route::get('/currency-edit' , [CurrenciesController::class, 'getCurrencyEdit'])->name('currency-edit');
    Route::post('/currency-edit' , [CurrenciesController::class, 'postCurrencyEdit'])->name('currency-edit');

    Route::get('/department-earning-edit' , [EarningRatiesController::class, 'getEarningRatiesEdit'])->name('department-earning-edit');
    Route::post('/department-earning-edit' , [EarningRatiesController::class, 'postEarningRatiesEdit'])->name('department-earning-edit');

    Route::get('/features-edit' , [FeaturesController::class, 'getFeaturesEdit'])->name('feature-edit');
    Route::post('/features-edit' , [FeaturesController::class, 'postFeaturesEdit'])->name('feature-edit');

    Route::get('/product-feature-edit' , [FeaturesController::class, 'getProductGroupByIdEdit'])->name('product-feature-edit');
    Route::post('/product-feature-edit' , [FeaturesController::class, 'postProductGroupByIdEdit'])->name('product-feature-edit');

    Route::get('/owner-edit' , [OwnersController::class, 'getOwnerEdit'])->name('owner-edit');
    Route::post('/owner-edit' , [OwnersController::class, 'postOwnerEdit'])->name('owner-edit');

    Route::get('/xml-edit' , [XmlProductsController::class, 'getXmlEdit'])->name('xml-edit');
    Route::post('/xml-edit' , [XmlProductsController::class, 'postXmlEdit'])->name('xml-edit');

    Route::get('/xml-update' , [XmlProductsController::class, 'xmlProductUpdate'])->name('xml-update');


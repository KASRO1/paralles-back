<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromoCodeController;

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

Route::get("/auth/{code}", [PromoCodeController::class, "auth"]);
Route::get("/check/{promo}", [PromoCodeController::class, "checkPromo"]);
Route::middleware("CheckAdmin")->group(function () {
    Route::get("/", [PromoCodeController::class, "indexAdmin"])->name("admin.promocode");
    Route::post("/admin/promocode/create", [PromoCodeController::class, "create"])->name("admin.promocode.create");
    Route::get("/admin/promocode/delete/{promocode}", [PromoCodeController::class, "delete"])->name("admin.promocode.delete");
});

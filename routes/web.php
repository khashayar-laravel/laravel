<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LogRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;


Route::get("/",[HomeController::class,"index"])->name("home")->middleware(LogRequest::class);
Route::get("/job/search",[JobController::class,"search"])->name("job.search");
Route::resource("job",JobController::class)->middleware("auth")->only(["update","destroy","edit","create"]);
Route::resource("job",JobController::class)->except(["update","destroy","edit","create"]);

//Authentication
Route::middleware("guest")->group(function(){
    Route::get("/register",[RegisterController::class,"register"])->name("register");
    Route::post("/register",[RegisterController::class,"store"])->name("register.store");
    Route::get("/login",[LoginController::class,"login"])->name("login");
    Route::post("/login",[LoginController::class,"authenticate"])->name("login.authenticate");
});

Route::post("/logout",[LoginController::class,"logout"])->name("logout");
Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard")->middleware("auth");
Route::put("/profile",[ProfileController::class,"update"])->name("profile.update")->middleware("auth");

Route::middleware("auth")->group(function(){
    Route::get("/bookmarks",[BookmarkController::class,'index'])->name("bookmarks.index")->middleware("auth");
    Route::post("/bookmarks/{job}",[BookmarkController::class,'store'])->name("bookmarks.store")->middleware("auth");
    Route::delete("/bookmarks/{job}",[BookmarkController::class,'destroy'])->name("bookmarks.destroy")->middleware("auth");
});

Route::post("/job/{job}/applicant",[ApplicantController::class,'store'])->name("applicant.store")->middleware("auth");
Route::delete("/applicants/{applicant}",[ApplicantController::class,'destroy'])->name("applicant.destroy")->middleware("auth");








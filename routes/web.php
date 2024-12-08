<?php

use Illuminate\Support\Facades\Route;


Route::get("/rand_password234234234234234dfsdfdsfsdf", function () {

    return env('_94LIST_RANDOM_PASSWORD');
});


Route::get("/{any}", fn() => view("App"))
     ->middleware("NeedInstall")
     ->where("any", ".*");

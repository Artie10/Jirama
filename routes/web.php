<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function(){
return view('tableauxDeBord');
});

Route::fallback(function(){
    return 'Une erreur est survenue';
});

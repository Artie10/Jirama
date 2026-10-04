<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//Route::get('/{titre}/{trav}/{att}',function($titre,$trav,$att){
    //$titre='Bonjour MR';
    //$trav=18;
    //$att='Vous avez';

//return view('tableauxDeBord',[
  //  'titre'=>$titre,
    //'trav'=>$trav,
    //'att'=>$att
//]);
//});





// Tableau de bord
Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

// Suivi
Route::get('/suivi', function () {
    return view('welcome');
})->name('suivi');

// Nouvelle demande
Route::get('/nouvelle-demande', function () {
    return view('welcome');
})->name('demande.create');

// Espace technicien
Route::get('/technicien', function () {
    return view('welcome');
})->name('technicien');

// Devis et dossiers
Route::get('/devis', function () {
    return view('welcome');
})->name('devis');

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();



})->name('logout');
Route::view('/','tableauxDeBordClient');


Route::fallback(function(){
    return 'Une erreur est survenue';
});

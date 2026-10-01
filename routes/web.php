<?php

use Illuminate\Support\Facades\Route;

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

Route::view('/','LoginClient');

Route::fallback(function(){
    return 'Une erreur est survenue';
});

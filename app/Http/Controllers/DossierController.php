<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\dossier;
class DossierController extends Controller
{
    //Ajout du dossier
    public function store(Request $request){
        $request->validate([

            'residence_img'=>'required|image|mimes:jpg,png,jpeg,webp|max:5000',
            'Dmd_img'=>'required|image|mimes:jpg,png,jpeg,webp|max:5000',
            'autorisation_img'=>'required|file|mimes:pdf,docx|max:6000',
             ]);

        $residence_img = null;
        if($request->hasFile('residence_img')){
            $residence_img=$request->file('residence_img')->store('residence','public');
        }

        $Dmd_img = null;
        if($request->hasFile('Dmd_img')){
            $Dmd_img=$request->file('Dmd_img')->store('Demande','public');
        }

        $autorisation_img=null;
        if($request->hasFile('autorisation_img')){
            $autorisation_img=$request->file('autorisation_img')->store('autorisation','public');
        }

        dossier::create([
            'autorisation_img'=>$autorisation_img,
            'Dmd_img'=>$Dmd_img,
            'residence_img'=>$residence_img,
        ]);
    }

}

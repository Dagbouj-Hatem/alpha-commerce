<?php

namespace App\Http\Controllers;

use \App\Produits; 

use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    // save produit 
  	 public function save_produit(Request $request)
	{	
			 // partie validation 
         $validatedData = $request->validate([
        'ref' => 'required', 
        'designation' => 'required', 
        'prix' => 'required|integer|min:0', 
        'fournisseur' => 'required', 
        'qte' => 'required|integer|min:0', 
        'remise' => 'required|integer|min:0', 
         ],[
        'ref.required' => 'la référence est obligatoire.', 
        'designation.required' => 'la désignation est obligatoire.', 
        'prix.required' => 'le prix est obligatoire.', 
        'prix.integer' => 'le prix min. zéro .', 
        'prix.min' => 'le prix est entier.', 
        'fournisseur.email' => 'le fournisseur est obligatoire.', 
        'qte.required' => 'la quantité est obligatoire.', 
        'qte.integer' => 'la quantité est un entier.', 
        'qte.min' => 'la quantité min. zéro.', 
        'remise.required' => 'la remise est obligatoire.', 
        'remise.min' => 'la remise min. zéro .', 
        'remise.integer' => 'la remise est entier.', 
        ]); 
        $produit =  new Produits();
   		 // add attribute 
        $produit->ref = $request->input('ref');  
        $produit->designation = $request->input('designation');  
        $produit->prix = $request->input('prix');  
        $produit->fournisseur =  $request->input('fournisseur');  
        $produit->qte =  $request->input('qte');  
        $produit->remise =  $request->input('remise');  
        $produit->save();   
        return redirect()->route('liste_produits');
	}


	 // delete produit by id 
    public function delete_produit ($id ){ 

     \App\Produits::where(['id' =>  $id ])->first()->delete();
      // return  list products
      return redirect()->route('liste_produits');
    }


   // update produit by id 
    public function update_produit($id ){ 

    $produit =  \App\Produits::where(['id' =>  $id ])->first();
      // return  list products
      return view('update_produits',compact('produit'));
    } 

      // update produit by id 
    public function update_produit_save($id , Request $request ){ 


    		 // partie validation 
         $validatedData = $request->validate([
        'ref' => 'required', 
        'designation' => 'required', 
        'prix' => 'required|integer|min:0', 
        'fournisseur' => 'required', 
        'qte' => 'required|integer|min:0', 
        'remise' => 'required|integer|min:0', 
         ],[
        'ref.required' => 'la référence est obligatoire.', 
        'designation.required' => 'la désignation est obligatoire.', 
        'prix.required' => 'le prix est obligatoire.', 
        'prix.integer' => 'le prix min. zéro .', 
        'prix.min' => 'le prix est entier.', 
        'fournisseur.email' => 'le fournisseur est obligatoire.', 
        'qte.required' => 'la quantité est obligatoire.', 
        'qte.integer' => 'la quantité est un entier.', 
        'qte.min' => 'la quantité min. zéro.', 
        'remise.required' => 'la remise est obligatoire.', 
        'remise.min' => 'la remise min. zéro .', 
        'remise.integer' => 'la remise est entier.', 
        ]); 

     $produit =   \App\Produits::where(['id' =>  $id ])->first();
     // add attribute 
        $produit->ref = $request->input('ref');  
        $produit->designation = $request->input('designation');  
        $produit->prix = $request->input('prix');  
        $produit->fournisseur =  $request->input('fournisseur');  
        $produit->qte =  $request->input('qte');  
        $produit->remise =  $request->input('remise');  
        $produit->save();   
        return redirect()->route('liste_produits');
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    // add users
    public function save_user(Request $request)
	{
			 // partie validation 
         $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|max:8|unique:users',
            'password' => 'required|max:12|min:6|confirmed',
            'type_account'=>'required',
        ],[
            'name.required' => 'le nom est obligatoire .',
            'email.max' => 'l\'identifiant doit etre inférieur à 8 caractère.',
            'email.unique' => 'choisir un autre identifiant. ',
            'password.min' => 'mot de passe doit etre entre 8 et 12 charéctère.',
            'password.max' => 'mot de passe doit etre entre 8 et 12 charéctère.', 
        ]); 
         User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'type_account' => $request->input('type_account'),
        ]);

         return back()->with('success', 'Utilisateur ajoutée avec succès.');
	}


	// delete user by  id  
	public function delete_user ($id ){ 

     \App\User::where(['id' =>  $id ])->first()->delete();
      // return  list products
      return redirect()->route('liste_users');
    }


    // get  update form 
    public function update_user($id)
    {
    	$user = \App\User::where(['id' =>  $id ])->first(); 
    	return view('update_user',compact('user'));
    }

    // user save update
       // get  update form 
    public function update_user_save($id , Request $request)
    {

    	// check validate
    	$validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|max:8', 
            'type_account'=>'required',
        ],[
            'name.required' => 'le nom est obligatoire .',
            'email.max' => 'l\'identifiant doit etre inférieur à 8 caractère.', 
        ]); 
    	// select user
    	$user = \App\User::where(['id' =>  $id ])->first(); 
    	// update fileds 
    	$user->name=  $request->input('name');
        $user->email = $request->input('email');
        // if pass specifed 
        if ($request->exists('password')) 
        { 
       		$user->password = bcrypt($request->input('password'));
       	}


        $user->type_account = $request->input('type_account');


        //persist
        $user->save();

    	//return statement 
    	return  redirect()->route('liste_users');
    } 
}

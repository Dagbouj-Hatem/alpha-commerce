<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \App\Produits; 
use \App\User; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return view('home');
    }
    public function liste_produits()
    {
        $produits = \App\Produits::all();
        return view('liste_produits', compact('produits'));
    }   
     public function add_produit()
    {
        return view('add_produit');
    }
    public function liste_users()
    {
        $users= \App\User::all();
        return view('liste_users',compact('users'));
    }
    public function add_user()
    {
        return view('add_user');
    }
    public function liste_ventes()
    {
        $produits = \App\Produits::all();
        return view('liste_ventes', compact('produits'));
    }      
    public function add_vente()
    {
        $produits = \App\Produits::all();
        return view('add_vente', compact('produits'));
    }    
    public function abouts()
    {
        return view('abouts');
    }
}

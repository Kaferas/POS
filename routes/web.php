<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\{
                        CommandeController,
                        ProduitController,
                        FournisseurController,
                        UtilisateurController ,
                        CompagnieController   ,
                        TransactionController
                    };

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
Route::get('/', function () {
    return view("welcome");
});

Route::resource("/commande",CommandeController::class);

Route::resource("/produits",ProduitController::class); 

Route::resource("/fournisseurs",FournisseurController::class);

Route::resource("/utilisateur",UtilisateurController::class);

Route::resource("/compagnie",CompagnieController::class);

Route::resource("/transaction",TransactionController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

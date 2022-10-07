
<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\{
    ApprovisionnerController,
    CommandeController,
    ProduitController,
    FournisseurController,
    UtilisateurController,
    CompagnieController,
    Fournisseur_Client,
    TransactionController,
    StockController,
    DepenseController,
    DashboardController,
    ReportController,
};
use App\Http\Controllers\Auth\LoginController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

// Route::get("/commande",function(){
//     return view("order.index");
// });
// Route::get("/utilisateur",function(){
//     return view("utilisateur.index");
// });
// Route::get("/produit",function(){
//     return view("produit.index");
// });
// Route::get("/report",function(){
//     return view("report.index");
// });

Route::middleware(['auth'])->group(function () {

    Route::get("/", [DashboardController::class, "index"]);

    Route::get("/storeClient", [CommandeController::class, "storeClient"])->name("storeClient");

    Route::resource("/commande", CommandeController::class);

    Route::resource("/produits", ProduitController::class);

    Route::resource("/fournisseurs", FournisseurController::class);

    Route::resource("/utilisateur", UtilisateurController::class);

    Route::resource("/compagnie", CompagnieController::class);

    Route::resource("/transaction", TransactionController::class);

    Route::get("/stocks", [StockController::class, "show"]);

    Route::get("/receipt/{id}", function () {
        return "Well Done";
    })->name("receipt");

    Route::get("reports/option", [ReportController::class, "option"])->name("optionReport");

    Route::get("/fournisseur_client", [Fournisseur_Client::class, "index"]);

    Route::get("/depenses", [DepenseController::class, "index"])->name("depenses");

    Route::get("/reports", [ReportController::class, "index"])->name("reports");

    Route::get("/approvision", [ApprovisionnerController::class, "index"])->name("approvision");

    Route::get("/logout", [LoginController::class, "logout"])->name('logout');

    Route::get("/report", [ReportController::class, "index"])->name("report");
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

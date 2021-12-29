<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;
use \App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Matrix\Decomposition\QR;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Order extends Component
{
    public $products = [];
    public $product_code;
    public $message = "";
    public $productInCart;
    public $discount = 0;
    public $codeFacture = 0;
    public $generatedQr;
    public $pay_money, $balance = 0;
    protected $listeners = [
        "dde",
    ];

    // public $somme = 0;
    public function updateDiscount($id)
    {
        $uptodate = Cart::find($id);
        $up = ["discount" => intval($this->discount)];
        // dd($up);
        $uptodate->update($up);
        // $this->somme = Cart::sum("product_price");
    }

    public function dde()
    {
        $this->dispatchBrowserEvent("downloadModal");
        sleep(2);
        $this->dispatchBrowserEvent("downloadismiss");
        Cart::truncate();
    }

    public function hydrated()
    {
        $this->generatedQr = Cart::distinct()->select('codefacture');
        dd($this->generatedQr);
    }

    public function mount()
    {
        $this->products = Produit::all();
        $this->productInCart = Cart::orderBy("id", "desc")->get();
        $numeroFacture = Cart::get("codeFacture")->toArray();
        do {
            $this->codeFacture = rand(10000000, 99999999);
        } while (in_array($this->codeFacture, $numeroFacture));
    }

    public function insertCart()
    {
        $this->dispatchBrowserEvent("sendCodeFacture", $this->codeFacture);
        // dd($this->codeFacture);
        $countin_product = Produit::where("product_code", $this->product_code)->first();

        if (!$countin_product) {
            return $this->message = "Product not Found";
        }
        $product_in_cart = Cart::where("product_code", $this->product_code)->count();
        // dd($product_in_cart);
        if ($product_in_cart > 0) {
            return $this->message = "Product " . $countin_product->nom_produit . " Already exists in Cart increase the quantity";
        }
        $add_to_cart = new Cart;
        $add_to_cart->product_id = $countin_product->id;
        $add_to_cart->product_code = $countin_product->product_code;
        $add_to_cart->product_qnty = 1;
        $add_to_cart->product_price = $countin_product->prix_vente;
        $add_to_cart->discount = 0;
        $add_to_cart->user_id = auth()->user()->id;
        $add_to_cart->codeFacture = $this->codeFacture;
        $add_to_cart->save();
        $this->product_code = "";
        $this->productInCart = Cart::orderBy("created_at", "asc")->get();
        // $route = route("receipt", $this->codeFacture);
        // $this->generatedQr = QrCode::size(20)->generate($route);
        // dd($route);
        return $this->message = "Product Added successfully";
    }

    public function IncrementQty($cartid)
    {
        $this->message = "";
        $this->product_code = "";
        $carts = Cart::find($cartid);
        $exced_id = $carts->product_id;
        $exced = Produit::find($exced_id);
        if ($carts->product_qnty < $exced->quantite) {
            $carts->increment("product_qnty", 1);
        } else {
            return $this->message = "Product " . $exced->nom_produit . " attempts the limit";
        }
        $updatePrice = $carts->product_qnty * $carts->product->prix_vente;
        $carts->update(["product_price" => $updatePrice]);
        $this->mount();
    }

    public function DecrementQty($cartid)
    {
        $this->message = "";
        $this->product_code = "";
        $carts = Cart::find($cartid);
        if ($carts->product_qnty == 1) {
            return $this->message = "Product can't be less than 1";
        }
        $carts->decrement("product_qnty", 1);
        $updatePrice = $carts->product_qnty * $carts->product->prix_vente;
        $carts->update(["product_price" => $updatePrice]);
        $this->mount();
    }

    public function removeCart($cartid)
    {
        $erase = Cart::find($cartid);
        if ($erase) {
            $erase->delete();
            $this->message = "Product " . $erase->product->nom_produit . " Removed Successfully";
            $this->productInCart = $this->productInCart->except($cartid);
            $this->message = "";
        }
    }
    public function render()
    {
        if ($this->pay_money != "") {
            $totalAmount = $this->pay_money - $this->productInCart->sum("product_price");
            $this->balance = $totalAmount;
        }

        return view('livewire.order');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Clients;
use Livewire\Component;
use \App\Models\Produit;
class Order extends Component
{
    public $products = [];
    public $product_code;
    public $message = "";
    public $productInCart;
    public $discount = 0;
    public $codeFacture = 0;
    public $generatedQr;
    public $ancien = 1;
    public $retrieve;
    public $searchClient;
    public $pay_money, $balance = 0;
    protected $listeners = [
        "dde",
    ];
    public $fullname;
    public $phone;
    public $email;
    public $adress;
    public $hideId;

    public function SearchClient()
    {
        $this->retrieve = Clients::where("Customer_name", 'like', '%' . $this->searchClient . '%')->get();
        // dd($this->retrieve);
    }

    public function validerClient($id)
    {
        $ancien = Clients::find($id);
        $this->fullname = $ancien->Customer_name;
        $this->phone = $ancien->phone_number;
        $this->email = $ancien->email;
        $this->adress = $ancien->Adress;
        $this->ancien = !$this->ancien;
        $this->hideId = $ancien->id;
    }

    public function chercherAncien()
    {
        $this->ancien = !$this->ancien;
    }
    // public $somme = 0;
    public function updateDiscount($id)
    {
        $uptodate = Cart::find($id);
        $up = ["discount" => intval($this->discount)];
        $uptodate->update($up);
    }

    public function dde()
    {
        $this->dispatchBrowserEvent("downloadModal");
        sleep(2);
        Cart::truncate();
    }


    public function mount()
    {
        $this->products = Produit::all();
        $this->productInCart = Cart::orderBy("id", "desc")->get();
        $numeroFacture = Cart::get("codeFacture")->toArray();
        do {
            $this->codeFacture = rand(10000000, 99999999);
        }while (in_array($this->codeFacture, $numeroFacture));
    }

    public function insertCart()
    {
        $this->dispatchBrowserEvent("sendCodeFacture", $this->codeFacture);
        $countin_product = Produit::where("product_code", $this->product_code)->first();

        if (!$countin_product) {
            return $this->message = "Product not Found";
        }
        $product_in_cart = Cart::where("product_code", $this->product_code)->count();
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

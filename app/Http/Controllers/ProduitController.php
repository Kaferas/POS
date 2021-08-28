<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Produit::paginate(5);
        $activenow="produits";
       return view("produits.index",[
           'products'=>$products,
           'activenow'=>$activenow
       ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'barre'=>"integer",
            // 'description'=>"|string",
            'price'=>"required|integer",
            'quant'=>"required|integer",
        ]);
        $produit=new Produit;
        $produit->nom_produit=$request->name;
        $produit->Code_barre=$request->barre;
        $produit->description=$request->description;
        $produit->categorie_produit=$request->categorie;
        $produit->prix=$request->price;
        $produit->quantite=$request->quant;
        $produit->save();
        return redirect()->back()->with("message","Product saved Well");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $produit=Produit::find($id);
        // dd($produit);
         
        if(!$produit)
        {
            return back()->with("error","The Product ain't founded");
        }
        $produit->update($request->all());
        return redirect()->back()->with("message","Product Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<div class="container row pl-5">
    <label for="" class="text-primary mt-2">Search By:</label>
    <div class="col-4">
        <select name="search_critere" id="" class="form-control" wire:model="critere">
            <option value="nom_produit">Product Name</option>
            <option value="category_produit">Category</option>
        </select>
    </div>

    @if ($critere == "category_produit")
        <div class="col-3">
            <select name="search_critere" id="" class="form-control" wire:model="query">
                <option value="" selected>---Choose a Categorie--</option>
                @foreach ($categories as $categorie)
                    <option value="{{$categorie->categorie_name}}">{{$categorie->categorie_name}}</option>
                @endforeach
            </select>
        </div>
    @else
            <div class="col-3 form-group">
                <input type="text" name="" value="Here" id="" class="form-control" placeholder="Query Here ..." wire:model="category">
            </div>
     @endif
</div>
<div class="row">
    <h3 class="alert-primary col-4 text-center">List of Products</h3>
    <h2 class="alert-danger col-7 ml-5 text-center">Details of Products</h2>
</div>

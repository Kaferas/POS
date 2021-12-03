<div class="container mt-4">
    <div class="col-md-12">
        @if(session()->has("message"))
            <div class="alert alert-success">
                {{ session("message") }}
            </div>
        @endif
        <div class="row">
            <div class="btn-group col-md-7 mb-4">
                <input type="search" name="" id="" class="form-control border-info " placeholder="Search Product Here" wire:model.defer="search">
            </div>
        </div>
         <div class="accordion" id="accordionExample">

                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                      <button class="btn btn-block text-left text-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbspAdd Product
                      </button>
                    </h2>
                  </div>
              
                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        @if($edition)
                        <div class="col-md-12 mt-5 mb-5 jumbotron">
                            <div class="card border-danger ">
                                <div class="card-header">
                                    <h4 class="text-center alert alert-info">Edit Product</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" wire:submit.prevent="save" enctype="multipart/form-data">
                                        @csrf
                                        @if ($picture)
                                        <div class="container d-flex justify-content-center mb-3">
                                            <img src="{{$picture->temporaryUrl()}}" alt="" width="120px" height="120px">
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Code-Produit:</label>
                                                <input type="text" name="code" class="form-control " wire:model.defer="code" disabled>
                                                @error('code')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Product Name:</label>
                                                <input type="text" name="name" class="form-control" wire:model.defer="name">
                                                @error('name')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Picture:</label>
                                                <input type="file" name="picture" class="form-control" wire:model.defer="picture">
                                                @error('picture')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Description:</label>
                                                <textarea name="description" id="" cols="10" rows="6" class="form-control" wire:model.defer="description">
        
                                                </textarea>
        
                                                @error('description')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                                <div class="form-group col-4">
                                                    <label for="" class="text-primary">Categorie:</label>
                                                    <select name="categorie" id="" class="form-control " wire:model.defer="categorie">
                                                        <option value="">---Choose Categorie---</option>
                                                        @foreach($categories as $cat)
                                                            <option value="{{$cat->id}}" @if ($cat->id == $categorie) selected @endif>{{$cat->categorie_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('categorie')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="" class="text-primary">Measure Unity:</label>
                                                    <select name="measure" id="" class="form-control " wire:model.defer="measure">
                                                        <option value="">---Choose Unity---</option>
                                                        @foreach($unites as $unite)
                                                            <option value="{{$unite->id}}" @if ($unite->id == $measure) selected @endif>{{$unite->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('measure')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
        
                                                <div class="form-group col-4">
                                                    <label for="" class="text-primary">Buying Price:</label>
                                                    <input type="number" name="buy_price" class="form-control " wire:model.defer="buy_price">
                                                    @error('buy_price')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="" class="text-primary">Selling Price:</label>
                                                    <input type="number" name="sell_price" class="form-control " wire:model.defer="sell_price" wire:change="calculInteret">
                                                    @error('sell_price')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="" class="text-primary">Interet:</label>
                                                    <input type="number" name="interet" class="form-control " wire:model.defer="interet"  readonly>
        
                                                    @error('interet')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row ml-3">
                                                <div class="form-group">
                                                    <label for="" class="text-primary">Quantity:</label>
                                                    <input type="number" name="quant" class="form-control " wire:model.defer="quantity">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label for="" class="text-danger">Stock Alert:</label>
                                                    <input type="number" name="quant" class="form-control " wire:model.defer="stock">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="" class="text-primary">Date In:</label>
                                                    <input type="date" name="quant" class="form-control " wire:model.defer="date_in">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label for="" class="text-danger">Expire Date:</label>
                                                    <input type="date" name="quant" class="form-control " wire:model.defer="date_out">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-info" >Close</button>
                                            <button type="submit" class="btn btn-primary">Save product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(!$edition)
                        <div class="col-md-12 mt-5 mb-5 jumbotron">
                            <div class="card border-primary">
                                <div class="card-header">
                                    <h4 class="text-primary text-center">Add New Product</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" wire:submit.prevent="save" enctype="multipart/form-data">
                                        @csrf
                                        @if ($picture)
                                        <div class="container d-flex justify-content-center mb-3">
                                            <img src="{{$picture->temporaryUrl()}}" alt="" width="120px" height="120px">
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Code-Produit:</label>
                                                <input type="text" name="code" class="form-control " wire:model.defer="code" >
                                                @error('code')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Product Name:</label>
                                                <input type="text" name="name" class="form-control" wire:model.defer="name">
                                                @error('name')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Picture:</label>
                                                <input type="file" name="picture" class="form-control" wire:model.lazy="picture">
                                                @error('picture')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="" class="text-primary">Description:</label>
                                                <textarea name="description" id="" cols="10" rows="6" class="form-control" wire:model.defer="description">
        
                                                </textarea>
                                                @error('description')
                                                    <span class="text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                                <div class="form-group col-4">
                                                    <label for="" class="text-primary">Categorie:</label>
                                                    <select name="categorie" id="" class="form-control " wire:model.defer="categorie">
                                                        <option value="">---Choose Categorie---</option>
                                                        @foreach($categories as $cat)
                                                            <option value="{{$cat->id}}">{{$cat->categorie_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('categorie')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="" class="text-primary">Measure Unity:</label>
                                                    <select name="measure" id="" class="form-control " wire:model.defer="measure">
                                                        <option value="">---Choose Unity---</option>
                                                        @foreach($unites as $unite)
                                                            <option value="{{$unite->id}}">{{$unite->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('measure')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
        
                                                <div class="form-group col-4">
                                                    <label for="" class="text-primary">Buying Price:</label>
                                                    <input type="number" name="buy_price" class="form-control " wire:model.defer="buy_price">
                                                    @error('buy_price')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="" class="text-primary">Selling Price:</label>
                                                    <input type="number" name="sell_price" class="form-control " wire:model.defer="sell_price" wire:submit="calculInteret">
                                                    @error('sell_price')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="" class="text-primary">Interet:</label>
                                                    <input type="number" name="interet" class="form-control " wire:model.defer="interet"  readonly>
        
                                                    @error('interet')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row ml-3">
                                                <div class="form-group">
                                                    <label for="" class="text-primary">Quantity:</label>
                                                    <input type="number" name="quant" class="form-control " wire:model.defer="quantity">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label for="" class="text-danger">Stock Alert:</label>
                                                    <input type="number" name="quant" class="form-control " wire:model.defer="stock">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="" class="text-primary">Date In:</label>
                                                    <input type="date" name="quant" class="form-control " wire:model.defer="date_in">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label for="" class="text-danger">Expire Date:</label>
                                                    <input type="date" name="quant" class="form-control " wire:model.defer="date_out">
                                                    @error('quant')
                                                        <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-info" >Close</button>
                                            <button type="submit" class="btn btn-primary">Save product</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    @endif
                    </div>
                  </div>
                </div>
         
            </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float:left;font-weight:bold">PRODUCT LISTING</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left text-center">
                            <thead>
                                <tr>
                                    <th>CodeBarre</th>
                                    <th>Product</th>
                                    <th>Price/unit</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($products)
                                @foreach($products as $produit)
                                <tr >
                                    <td class="d-flex flex-column justify-content-center align-items-center ">{!!$produit->Code_barre!!}<span style="letter-spacing: 18px">{{ $produit->product_code}}</span></td>
                                    <td>{{ $produit->nom_produit}}</td>
                                    <td>{{$produit->prix_vente}} <span class="text-primary">Fbu</span></td>
                                    <td>{{$produit->quantite}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-warning mr-2"
                                            wire:click="selectItem({{$produit->id}},'edit')">Edit</button>
                                            <button class="btn btn-danger mr-2"
                                            wire:click="selectItem({{$produit->id}},'delete')">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                        <!-- Modal For Editing product -->
                                <div class="modal fade" id="delProduct" tabindex="-1" role="dialog" aria-labelledby="delProduct" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="delProduct">Delete product</h5>
                                                    <button type="button"   wire:click="resetVar" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>

                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                        <h3>Are sure you want to Delete It ?</h3>
                                                        <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                        <button class="btn btn-danger" wire:click="deleteProduct">Yes</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                        @endforeach
                     @endif
                            </tbody>
                        </table>
                        {{  $products->links() }}
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
<!-- Modal  -->


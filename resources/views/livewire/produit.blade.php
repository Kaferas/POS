<div class="container mt-4">
    <div class="col-md-12">
        @if(session()->has("message"))
            <div class="alert alert-success">
                {{ session("message") }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="btn-group">
                        <input type="search" name="" id="" class="form-control border-info" placeholder="Search Product Here">
                    </div>
                    <div class="card-header">
                        <h5 style="float:left;font-weight:bold">ADD PRODUCT</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>CodeBarre</th>
                                    <th>Price/unit</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $produit)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{ $produit->nom_produit}}</td>
                                            <td>{{$produit->Code_barre}}</td>
                                            <td>{{$produit->prix}} <span class="text-primary">Fbu</span></td>
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
                                                            <h3>Are u want to Delete ?</h3>
                                                            <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-danger" wire:click="deleteProduct">Yes</button>
                                                    <div>
                                                </div>
                                        </div>
                                    </div>
                                @endforeach                                   
                    
                            </tbody>
                        </table>
                    {{  $products->links() }}
                    </div>
                </div>
            </div>
            @if($edition)
            <div class="col-md-4">
                <div class="card border-danger">
                        <div class="card-header border-danger">
                            <h4 class="text-danger">Edit Product</h4>
                        </div>
                        <div class="card-body">
                                    <form action="" wire:submit.prevent="save">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="text-primary">Code-Barre:</label>
                                    <input type="text" name="barre" class="form-control " wire:model="code_barre">
                                    @error('barre')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Product Name:</label>
                                    <input type="text" name="name" class="form-control" wire:model="name">
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Description:</label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control" wire:model="description">
                                    
                                    </textarea>
                                    @error('description')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Categorie:</label>
                                    <select name="categorie" id="" class="form-control " wire:model="categorie">
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->categorie_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Price:</label>
                                    <input type="number" name="price" class="form-control " wire:model="price">
                                    @error('price')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Quantity:</label>
                                    <input type="number" name="quant" class="form-control " wire:model="quantity">
                                    @error('quant')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-danger">Stock Alert:</label>
                                    <input type="number" name="quant" class="form-control " wire:model="stock">
                                    @error('quant')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            
                                <div class="modal-footer">
                                    <div  class="btn btn-info" wire:click="toggleEdition">Close Edition</div>
                                    <button type="submit" class="btn btn-primary">Update product</button>
                                </div>
                            </form>   
                        </div>
                </div>
            </div>
            @endif
            @if(!$edition)
            <div class="col-md-4">
                <div class="card border-primary">
                        <div class="card-header">
                            <h4 class="text-primary">Add New Product</h4>
                        </div>
                        <div class="card-body">
                                    <form action="" wire:submit.prevent="save">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="text-primary">Code-Barre:</label>
                                    <input type="text" name="barre" class="form-control " wire:model="code_barre">
                                    @error('barre')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Product Name:</label>
                                    <input type="text" name="name" class="form-control" wire:model="name">
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Description:</label>
                                    <textarea name="description" id="" cols="30" rows="5" class="form-control" wire:model="description">
                                    
                                    </textarea>
                                    @error('description')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Categorie:</label>
                                    <select name="categorie" id="" class="form-control " wire:model="categorie">
                                        @foreach($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->categorie_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('categorie')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Price:</label>
                                    <input type="number" name="price" class="form-control " wire:model="price">
                                    @error('price')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Quantity:</label>
                                    <input type="number" name="quant" class="form-control " wire:model="quantity">
                                    @error('quant')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-danger">Stock Alert:</label>
                                    <input type="number" name="quant" class="form-control " wire:model="stock">
                                    @error('quant')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
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
        </div>
    </div>
</div>


<!-- Modal  -->


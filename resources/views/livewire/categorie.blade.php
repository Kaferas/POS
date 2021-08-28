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
                        <!-- <div class="btn-group">
                            <input type="search" name="" id="" class="form-control border-info" placeholder="Search Product Here">
                        </div> -->
                        <div class="card-header">
                            <h5 style="float:left;font-weight:bold">ADD CATEGORIE</h5>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Categorie Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                 @foreach($categories as $categorie)
                                    <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$categorie->categorie_name}}</td>
                                           
                                            
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editcategorie">Edit</a>
                                                    <a href="" class="btn btn-primary mr-2" data-toggle="modal" data-target="#delcategorie">Delete</a>
                                                </div>
                                            </td>
                                    </tr>
                              
                                        <!-- Modal For Editing product -->
                                        <div class="modal fade" id="editcategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalScrollableTitle">Add New categorie</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                    
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="">
                                                              
                                                               
                                                                <div class="form-group">
                                                                    <label for="" class="text-primary">Product Name:</label>
                                                                    <input type="text" name="nom_produit" class="form-control">
                                                                    @error('name')
                                                                        <span class="text text-danger">{{ $name }}</span>
                                                                    @enderror
                                                                </div>

                                                            
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save product</button>
                                                                </div>
                                                            </form>   
                                                        <div>
                                                    </div>
                                            </div>
                                        </div>
                                                                            
                                        @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="card">
                        <div class="card-header">
                           <h4>New Categorie</h4>
                        </div>
                        <div class="card-body">
                                <form wire:submit.prevent="save">
                               
                                <div class="form-group">
                                    <label for="" class="text-primary">Categorie Name:</label>
                                    <input type="text" name="name" class="form-control"  wire:model.debounce.100ms="name">
                                    @error('name')
                                        <span class="text text-light bg-danger p-1">{{ $message }}</span>
                                    @enderror
                                    
                                </div>
                                
                            
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-danger col-5" >Reset</button>
                                    <button type="submit" class="btn btn-primary ">Save Categorie</button>
                                </div>
                            </form>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal  -->


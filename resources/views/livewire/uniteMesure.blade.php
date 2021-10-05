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
                        <h5 style="float:left;font-weight:bold">ADD UNITE MESURE</h5>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name Unity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach($unites as $unite)
                                <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$unite->name}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-warning mr-2"
                                                    wire:click="selectedItem({{ $unite->id }},'Edit')">Edit</button>
                                                <button class="btn btn-danger mr-2"
                                                    wire:click="selectedItem({{ $unite->id }},'Delete')">Delete</button>

                                            </div>
                                        </td>
                                </tr>
                                    <!-- Modal For Editing product -->
                                    <!-- <div class="modal fade" id="editcategorie" tabindex="-1" role="dialog" aria-labelledby="editcategorie" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Add New categorie </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>

                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="">
                                                            <div class="form-group">
                                                                <label for="" class="text-primary">Product Name:</label>
                                                                <input type="text" name="nom_produit" class="form-control" wire:model="updateName">
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
                                    </div> -->


                                <div class="modal fade" id="deletecategorie" tabindex="-1" role="dialog" aria-labelledby="deletecategorie" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Delete Unity ?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>

                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><h3>Are you Sure you Want to Delete It ?</h3></p>
                                                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-danger" wire:click="delete({{ $unite->id }})">Yes</button>
                                                <div>
                                            </div>
                                    </div>
                                </div>


                                    @endforeach
                            </tbody>
                        </table>
                        {{ $unites->links() }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
            <div class="card">

                @if(!$edition)
                    <div class="card-body">
                        <div class="card-header">
                            <h4>New Unity</h4>
                        </div>
                    <form wire:submit.prevent="save">

                    <div class="form-group">
                        <label for="" class="text-primary">Unity Name:</label>
                        <input type="text" name="name" class="form-control"  wire:model.lazy="name">
                        @error('name')
                            <span class="text text-light bg-danger p-1">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-info col-5" >Reset</button>
                        <button type="submit" class="btn btn-primary ">Save Unity</button>
                    </div>
                </form>
                @else
                <div class="card-body border border-danger">
                        <div class="card-header">
                            <h4 class="alert alert-success">Edit Unity</h4>
                        </div>
                    <form wire:submit.prevent="updateCategorie">

                    <div class="form-group">
                        <label for="" class="text-primary">Unity Name:</label>
                        <input type="text" name="name" class="form-control border-dark" focus  wire:model.lazy="updateName">
                        @error('name')
                            <span class="text text-light bg-danger p-1">{{ $message }}</span>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="reset" class="btn btn-danger col-5" >Reset</button> -->
                        <button type="submit" class="btn btn-warning col-12 ">Update Unity</button>
                    </div>
                </form>
                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal  -->


<div class="container mt-4 border p-4">
    @if(session()->has("message"))
        <div class="alert alert-success" >
            {{ session("message") }}
        </div>
    @endif
    <span style="width:100%; display:flex; justify-content:flex-start">
        <h2 class="text text-primary pr-4">Chercher: </h3>
        <input type="text" name="" id="" class="pl-4 mb-4 col-7 border border-secondary form-control" placeholder="Chercher fournisseur..." wire:model="search">
    </span>
    <div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-block text-left text text-primary" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-shipping-fast"></i> &nbspAjouter Fournisseur
              </button>
            </h2>
          </div>

          <div id="collapseOne" class="collapse collapseSup" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                @if($idFournisseur)
                <fieldset class="col-md-12 border border-danger jumbotron">
                    <legend class="text text-danger">Edit Fournisseur</legend>
                    <form action="" method="" action="multipart/form-data" wire:submit.prevent="save" >
                        <div class="row col-12">
                            <div class="form-group mr-3 p-2">
                                <label for="" class="text text-danger">Nom Compagnie:</label>
                                <input type="text" name="company_name" id="" class="form-control col-lg-12 border-secondary" wire:model.defer="company_name">

                                @error("company_name")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-2">
                                <label for="" class="text text-danger">Nom:</label>
                                <input type="text" name="firstname" id="" class="form-control col-12 border-secondary" wire:model.defer="firstname">

                                @error("firstname")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-2">
                                <label for="" class="text text-danger">Prenom:</label>
                                <input type="text" name="lastname" id="" class="form-control col-12 border-secondary" wire:model.defer="lastname">

                                @error("lastname")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="form-group mr-3 p-1">
                                <label for="" class="text text-danger">Email</label>
                                <input type="email" name="email" id="" class="form-control col-12 border-secondary" wire:model.defer="email">

                                @error("email")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-1">
                                <label for="" class="text text-danger">Numero Tel:</label>
                                <input type="number" name="phone" id="" class="form-control col-12 border-secondary" wire:model.defer="phone">

                                @error("phone")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-1">
                                <label for="" class="text text-danger">Avatar:</label>
                                <input type="file" name="avatar" id="" class="form-control col-12 border-secondary" wire:model.defer="avatar">

                                @error("avatar")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="row col-12">
                            <button type="submit" class="btn btn-danger col-md-3">Edit</button>
                        </div>
                    </form>
                </fieldset>
                @else

                <fieldset class="col-md-12 border border-success jumbotron">
                    <legend class="text text-primary">Nouveau Fournisseur</legend>
                    <form action="" method="" action="multipart/form-data" wire:submit.prevent="save" >
                        <div class="row col-12">
                            <div class="form-group mr-3 p-2">
                                <label for="" class="text text-primary">Nom Compagnie:</label>
                                <input type="text" name="company_name" id="" class="form-control col-lg-12 border-secondary" wire:model.defer="company_name">

                                @error("company_name")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-2">
                                <label for="" class="text text-primary">Nom :</label>
                                <input type="text" name="firstname" id="" class="form-control col-12 border-secondary" wire:model.defer="firstname">

                                @error("firstname")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-2">
                                <label for="" class="text text-primary">Prenom:</label>
                                <input type="text" name="lastname" id="" class="form-control col-12 border-secondary" wire:model.defer="lastname">
                                @error("lastname")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="form-group mr-3 p-1">
                                <label for="" class="text text-primary">Email</label>
                                <input type="email" name="email" id="" class="form-control col-12 border-secondary" wire:model.defer="email">
                                @error("email")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-1">
                                <label for="" class="text text-primary">Numero Tel:</label>
                                <input type="number" name="phone" id="" class="form-control col-12 border-secondary" wire:model.defer="phone">
                                @error("phone")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group mr-3 p-1">
                                <label for="" class="text text-primary">Avatar:</label>
                                <input type="file" name="avatar" id="" class="form-control col-12 border-secondary" wire:model.defer="avatar">
                                @error("avatar")
                                <div class="alert alert-danger mt-3">{{$message}}</div>
                            @enderror
                            </div>
                        </div>
                        <div class="row col-12">
                            <button type="submit" class="btn btn-success col-md-3">Confirmer</button>
                        </div>
                    </form>
                </fieldset>
                @endif
            </div>
          </div>
        </div>
    </div>

    <table class="table table-striped border border-danger border-left-0 border-top-0 ">
        <thead class="text-center">
            <tr class="table-primary">
              <th scope="col">#</th>
              <th scope="col">Nom</th>
              <th scope="col">Prenom</th>
              <th scope="col">Nom Compagnie</th>
              <th scope="col" class="text text-info">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($fournisseurs as $supplier)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$supplier->firstname}}</td>
                <td>{{$supplier->lastname}}</td>
                <td>{{$supplier->company_name}}</td>
                <td>
                    <button class="btn btn-warning" wire:click="selectItem({{ $supplier->id }},'edit')">Editer</button>
                    <button class="btn btn-danger" wire:click="selectItem({{ $supplier->id }},'delete')">Supprimer</button>
                </td>
            </tr>
            <div class="modal fade" id="delfournisseur" tabindex="-1" role="dialog" aria-labelledby="delfournisseur" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delfournisseur">Delete Supplier</h5>
                                <button type="button"   wire:click="resetVar" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>

                                </button>
                            </div>
                            <div class="modal-body">
                                    <h3>Are sure to delete Supplier ?</h3>
                                    <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                    <button class="btn btn-danger" wire:click="deleteFournisseur">Yes</button>
                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
        </tbody>
    </table>
    <span>{{$fournisseurs->links()}}</span>

    {{-- @if($idFournisseur)
    <fieldset class="col-md-12 border border-danger jumbotron">
        <legend class="text text-danger">Edit Supplier</legend>
        <form action="" method="" action="multipart/form-data" wire:submit.prevent="save" >
            <div class="row col-12">
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-danger">Company Name:</label>
                    <input type="text" name="company_name" id="" class="form-control col-lg-12 border-secondary" wire:model="company_name">

                    @error("company_name")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-danger">First Name:</label>
                    <input type="text" name="firstname" id="" class="form-control col-12 border-secondary" wire:model="firstname"> --}}

</div>

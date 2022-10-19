<div class="container row mt-4 border-primary">
       @if(empty($idItem))
       <fieldset class="col-md-6 pl-4 border border-primary jumbotron" height="auto">
        <legend class="text text-primary">Nouveau Client</legend>
        @if(session()->has("message"))
            <div class="alert alert-success">
                {{ session("message") }}
            </div>
        @endif
        <form action="" method="POST" action="multipart/form-data" class="border-primary" wire:submit.prevent="save"  class="col-12">
            <div class="row">
                <div class="form-group mr-3 p-2 col-md-11">
                    <label for="" class="text text-primary">Nom Client:</label>
                    <input type="text" name="nameCutomer" id="" class="form-control col-12 border-dark" wire:model="nameCutomer" value="@old('nameCutomer')">
                    @error("nameCutomer")
                        <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row ">
                <div class="form-group mr-2 p-1 col-md-5">
                    <label for="" class="text text-primary">Email</label>
                    <input type="email" name="emailCustomer" id="" class="form-control col-12 border-dark" wire:model="emailCustomer" value="@old('emailCustomer')">
                    @error("emailCustomer")
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                @enderror
                </div>
                <div class="form-group mr-3 p-1 col-md-6">
                    <label for="" class="text text-primary">Numero Tel:</label>
                    <input type="number" name="phoneCustomer" id="" class="form-control col-12 border-dark" wire:model="phoneCustomer" value="@old('phoneCustomer')">
                    @error("phoneCustomer")
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group mr-3 p-1 col-md-11">
                    <label for="" class="text text-primary">Adress 1</label>
                    <input type="text" name="adressCustomer" id="" class="form-control col-12 border-dark" wire:model="adressCustomer" value="@old('adressCustomer')">
                    @error("adressCustomer")
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary col-md-3">Confirmer</button>
            </div>
        </form>
    </fieldset>
       @else
        <fieldset class="col-md-6 pl-4 border border-success jumbotron">
            <legend class="text text-success">Editer Client</legend>
            @if(session()->has("message"))
                <div class="alert alert-success">
                    {{ session("message") }}
                </div>
            @endif
            <form action="" method="POST" action="multipart/form-data" class="border-primary" wire:submit.prevent="save" >
                <div class="row">
                    <div class="form-group mr-3 p-2 col-md-11">
                        <label for="" class="text text-danger">Nom Client:</label>
                        <input type="text" name="nameCutomer" id="" class="form-control col-12 border-dark" wire:model="nameCutomer" value="@old('nameCutomer')">
                        @error("nameCutomer")
                            <div class="alert alert-danger mt-2">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row ">
                    <div class="form-group mr-2 p-1 col-md-5">
                        <label for="" class="text text-danger">Email</label>
                        <input type="email" name="emailCustomer" id="" class="form-control col-12 border-dark" wire:model="emailCustomer" value="@old('emailCustomer')">
                        @error("emailCustomer")
                        <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                    </div>
                    <div class="form-group mr-3 p-1 col-md-6">
                        <label for="" class="text text-danger">Numero Tel:</label>
                        <input type="number" name="phoneCustomer" id="" class="form-control col-12 border-dark" wire:model="phoneCustomer" value="@old('phoneCustomer')">
                        @error("phoneCustomer")
                        <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group mr-3 p-1 col-md-11">
                        <label for="" class="text text-danger">Adress 1</label>
                        <input type="text" name="adressCustomer" id="" class="form-control col-12 border-dark" wire:model="adressCustomer" value="@old('adressCustomer')">
                        @error("adressCustomer")
                        <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-success col-md-3">Editer Client</button>
                </div>
            </form>
        </fieldset>
       @endif
    <div class="col-md-6 ">
        <div class="form-group">
            <h4 class="text-primary">Chercher:</h4>
            <input type="text" name="search" id="" placeholder="Search a Customer..." class="col-md-12 form-control border border-dark" wire:model.debounce="search">
            <table class="table table-striped mt-3">
                <thead>
                  <tr>
                      <th scope="col">Nom Complet</th>
                      <th scope="col">Numero Tel:</th>
                      <th scope="col">Adresse</th>
                      <th scope="col" class="text text-primary">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($clients as $client)
                  <tr>
                      <td>{{$client->Customer_name}}</td>
                      <td>{{$client->phone_number}}</td>
                      <td>{{$client->Adress}}</td>
                      <td scope="row">
                        <div class="btn btn-warning  col-xs-6" wire:click="selectedItem({{$client->id}},'edit')">Edit</div>
                          <div class="btn btn-danger col-xs-5" wire:click="selectedItem({{$client->id}},'delete')">Delete</div>
                      </tr>
                      <div class="modal fade" id="delClient" tabindex="-1" role="dialog" aria-labelledby="delClient" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="delProduct">Supprimer Client</h5>
                                        <button type="button"   wire:click="resetField" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>

                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <h3>Etez-vous Sure ? ?</h3>
                                            <button class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                            <button class="btn btn-danger" wire:click="deleteClient">Confirmer</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{$clients->links()}}
        </div>
    </div>
</div>

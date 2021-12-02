<div class="container mt-4 border p-4">
    @if(session()->has("message"))
        <div class="alert alert-success" >
            {{ session("message") }}
        </div>
    @endif
    <span style="width:100%; display:flex; justify-content:flex-start">
        <h2 class="text text-primary pr-4">Search: </h3>
        <input type="text" name="" id="" class="pl-4 mb-4 col-7 border border-secondary form-control" placeholder="Search Supplier..." wire:model="search">
    </span>
    <table class="table table-striped border border-danger border-left-0 border-top-0 ">
        <thead class="text-center">
            <tr class="table-primary">
              <th scope="col">#</th>
              <th scope="col">Firstname</th>
              <th scope="col">Lastname</th>
              <th scope="col">CompanyName</th>
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
                    <button class="btn btn-warning" wire:click="selectItem({{ $supplier->id }},'edit')">Edit</button>
                    <button class="btn btn-danger" wire:click="selectItem({{ $supplier->id }},'delete')">Delete</button>
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
    @if($idFournisseur)
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
                    <input type="text" name="firstname" id="" class="form-control col-12 border-secondary" wire:model="firstname">

                    @error("firstname")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-danger">Last Name:</label>
                    <input type="text" name="lastname" id="" class="form-control col-12 border-secondary" wire:model="lastname">

                    @error("lastname")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-danger">Email</label>
                    <input type="email" name="email" id="" class="form-control col-12 border-secondary" wire:model="email">

                    @error("email")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-danger">Phone Number</label>
                    <input type="number" name="phone" id="" class="form-control col-12 border-secondary" wire:model="phone">

                    @error("phone")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-danger">Avatar:</label>
                    <input type="file" name="avatar" id="" class="form-control col-12 border-secondary" wire:model="avatar">

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
        <legend class="text text-primary">New Supplier</legend>
        <form action="" method="" action="multipart/form-data" wire:submit.prevent="save" >
            <div class="row col-12">
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">Company Name:</label>
                    <input type="text" name="company_name" id="" class="form-control col-lg-12 border-secondary" wire:model="company_name">

                    @error("company_name")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">First Name:</label>
                    <input type="text" name="firstname" id="" class="form-control col-12 border-secondary" wire:model="firstname">

                    @error("firstname")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">Last Name:</label>
                    <input type="text" name="lastname" id="" class="form-control col-12 border-secondary" wire:model="lastname">
                    @error("lastname")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Email</label>
                    <input type="email" name="email" id="" class="form-control col-12 border-secondary" wire:model="email">
                    @error("email")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Phone Number</label>
                    <input type="number" name="phone" id="" class="form-control col-12 border-secondary" wire:model="phone">
                    @error("phone")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Avatar:</label>
                    <input type="file" name="avatar" id="" class="form-control col-12 border-secondary" wire:model="avatar">
                    @error("avatar")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                @enderror
                </div>
            </div>
            <div class="row col-12">
                <button type="submit" class="btn btn-success col-md-3">Submit</button>
            </div>
        </form>
    </fieldset>
    @endif
</div>

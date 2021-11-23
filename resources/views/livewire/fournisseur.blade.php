<div class="container mt-4 border p-4">
    @if(session()->has("message"))
        <div class="alert alert-success">
            {{ session("message") }}
        </div>
    @endif
    <span style="width:100%; display:flex; justify-content:space-around">
        <h4 class="text text-success">Search</h4>
        <input type="text" name="" id="" class="mb-4 col-7 border border-secondary form-control" placeholder="Search Supplier" wire:model="search">
        <span>{{$fournisseurs->links()}}</span>
    </span>
    <table class="table table-striped border border-danger border-left-0 border-top-0 ">
        <thead class="text-center">
            <tr class="table-warning">
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
                    <button class="btn btn-primary">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
          @endforeach
        </tbody>
    </table>

    <fieldset class="col-md-12 border border-success jumbotron">
        <legend class="text text-primary">New Supplier</legend>
        <form action="" method="" action="multipart/form-data" wire:submit.prevent="save" >
            <div class="row col-12">
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">Company Name:</label>
                    <input type="text" name="company_name" id="" class="form-control col-lg-12 border-secondary" wire:model="company_name">
                    {{$company_name}}
                    @error("company_name")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">First Name:</label>
                    <input type="text" name="firstname" id="" class="form-control col-12 border-secondary" wire:model="firstname">
                    {{$firstname}}
                    @error("firstname")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">Last Name:</label>
                    <input type="text" name="lastname" id="" class="form-control col-12 border-secondary" wire:model="lastname">
                    {{$lastname}}
                    @error("lastname")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Email</label>
                    <input type="email" name="email" id="" class="form-control col-12 border-secondary" wire:model="email">
                    {{$email}}
                    @error("email")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Phone Number</label>
                    <input type="number" name="phone" id="" class="form-control col-12 border-secondary" wire:model="phone">
                    {{$phone}}
                    @error("phone")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Avatar:</label>
                    <input type="file" name="avatar" id="" class="form-control col-12 border-secondary" wire:model="avatar">
                    {{$avatar}}
                    @error("avatar")
                    <div class="alert alert-danger mt-3">{{$message}}</div>
                @enderror
                </div>
            </div>
            {{-- <div class="row col-12">
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Adress 1</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Adress 2</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Country</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Town</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
            </div> --}}
            <div class="row col-12">
                <button type="submit" class="btn btn-success col-md-3">Submit</button>
            </div>
        </form>
    </fieldset>
</div>

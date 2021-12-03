<div class="d-flex justify-content-end col-12">
    <div class="col-8">
        @if(session()->has("message"))
            <div class="alert alert-success" >
                {{ session("message") }}
            </div>
        @endif
       <div class="row d-flex justify-content-around">
           <div class="d-flex col-9 justify-content-between">
            <div class="form-group">
                <label for="" class="text text-secondary">Username:</label>
                 <select name="" id="" class="form-control border border-secondary" wire:model="selectuser">
                     <option value="" selected>Choose User</option>
                     @foreach ($users as $user)
                         <option value="{{$user->id}}">{{$user->name}}</option>
                     @endforeach
                 </select>
                 {{-- {{$selectuser}} --}}
            </div>
            <div class="form-group">
                 <label for="" class="text text-primary">From:</label>
                 <input type="date" name="" id="" class="form-control border border-secondary" wire:model="fromdate">
                 {{-- {{$fromdate}} --}}
             </div>
             <div class="form-group">
                 <label for="" class="text text-danger">To:</label>
                 <input type="date" name="" id="" class="form-control border border-secondary" wire:model="todate">
                 {{-- {{$todate}} --}}
            </div>
           </div>
           <div class="col-9 m-0">
                <input type="text" name="" id="" class="form-control border border-primary alert alert-info" placeholder="Search..." wire:model="search">
                {{-- {{$search}} --}}
            </div>
        </div>
        <div class="container text text-danger">
            <table class="table border border-primary border-top-0 border-bottom-0 ">
                <thead class="thead-dark text-center">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Concerned</th>
                    <th scope="col">Describe</th>
                    <th scope="col">Total</th>
                    <th scope="col">Date</th>
                    <th scope="col" class="text text-success">Action</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @foreach ($depenses as $depense)
                  <tr>
                    <th scope="row">{{$depense->id}}</th>
                    <th scope="row">{{$depense->spender}}</th>
                    <th scope="row">{{$depense->description}}</th>
                    <th>{{$depense->total}}</th>
                    <th scope="row" class="col-3">{{$depense->created_at->format("d-m-Y")}}</th>
                    <td>
                        <button class="btn btn-warning" wire:click="selectItem({{$depense->id}},'edit')">Edit</button>
                        @if(Gate::allows("is_admin"))
                            <button class="btn btn-danger" wire:click="selectItem({{$depense->id}},'delete')">Erase</button>
                        @endif
                        {{-- <button class="btn btn-success">Edit</button> --}}
                    </td>
                  </tr>
                  <div class="modal fade" id="deldepense" tabindex="-1" role="dialog" aria-labelledby="deldepense" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deldepense">Delete Outcome</h5>
                                    <button type="button"   wire:click="resetVar" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>

                                    </button>
                                </div>
                                <div class="modal-body">
                                        <h3>Are you sure ?</h3>
                                        <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-danger" wire:click="deleteDepense">Yes</button>
                                </div>
                            </div>
                        </div>
                </div>
                  @endforeach
                </tbody>
              </table>
              {{$depenses->links()}}
        </div>
    </div>
    <div class="col-4">
        <div class="container p-0">
            <h5>Outcome Type: </h5>
            <select name="" id="" class="form-control mb-3 border border-primary" wire:model="type">
                <optgroup>
                    <option value="ordinaire">Ordinary</option>
                    <option value="stock">Stock</option>
                </optgroup>
            </select>

            <form action="" method="post" class="jumbotron border border-primary border-top-0 border-bottom-0 p-3" >
                {{-- @method("PUT") --}}
                <div>
                    <label for="">Spender:</label>
                    <input type="text" name="" id=""  class="form-control border border-primary" value="" wire:model="spender">
                </div>
                @error("spender")
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
                <div>
                    {{-- <label for="">Username:</label> --}}
                <input type="hidden" name="" id="" disabled class="form-control border border-primary" value="{{ Auth()->user()->id }}" wire:model="username">
                </div>
                @if ($type == "stock")
                <div  style="transition:.5ms ease-in-out">
                    <div >
                        <label for="">Product:</label>
                        <select name="" id="" class="form-control  border border-success" wire:model="produit">
                            <option value="" selected>Choose Product</option>
                            @foreach ($products as $product)
                               <option value="{{$product->id}}" @if ($product->id == $produit) selected @endif>{{$product->nom_produit}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div >
                        <label for="">Quantity:</label>
                        <input type="text" name="" id="" class="form-control  border border-success" wire:model="quantity">
                    </div>
                </div>
                @endif
                <div >
                    <label for="">Description:</label>
                   <textarea name="" id="" cols="30" rows="3" class="form-control border border-dark" wire:model="description"></textarea>
                </div>
                @error("description")
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                 @enderror
                <div >
                    <label for="">Total Amount:</label>
                    <input type="number" name="" id="" class="form-control border border-dark" wire:model="totalAmount">
                </div>
                @error("totalAmount")
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                 @enderror
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" wire:click.prevent="save">Submit Spend</button>
                </div>
            </form>
        </div>
    </div>
</div>

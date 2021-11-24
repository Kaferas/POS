<div class="d-flex justify-content-end col-12">
    <div class="col-8">
       <div class="row d-flex justify-content-around">
           <div class="form-group">
               <label for="" class="text text-secondary">Username:</label>
                <select name="" id="" class="form-control border border-secondary" wire:model="users">
                    <option value="" selected>Choose User</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
           </div>
           <div class="form-group">
                <label for="" class="text text-primary">From:</label>
                <input type="date" name="" id="" class="form-control border border-secondary" wire:model="fromdate">
                {{-- {{$fromdate}} --}}
            </div>
            <div class="form-group">
                <label for="" class="text text-success">To:</label>
                <input type="date" name="" id="" class="form-control border border-secondary" wire:model="todate">
                {{-- {{$todate}} --}}
           </div>
       </div>
    </div>
    <div class="col-4">
        <div class="container p-0">
            <h5>Spend Type: </h5>
            <select name="" id="" class="form-control mb-3 border border-primary" wire:model="type">
                <optgroup>
                    <option value="ordinaire">Ordinary</option>
                    <option value="stock">Stock</option>
                </optgroup>
            </select>

            <form action="" method="post" class="jumbotron border border-primary border-top-0 border-bottom-0 p-3">
                <div>
                    <label for="">Username:</label>
                <input type="text" name="" id="" disabled class="form-control border border-primary" value="{{ Auth()->user()->name }}">
                </div>
                @if ($type == "stock")
                <div  style="transition:.5ms ease-in-out">

                    <div >
                        <label for="">Product:</label>
                        <select name="" id="" class="form-control  border border-success">
                            <option value="" selected>Choose Product</option>
                            @foreach ($products as $product)
                               <option value="{{$product->id}}">{{$product->nom_produit}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div >
                        <label for="">Quantity:</label>
                        <input type="text" name="" id="" class="form-control  border border-success">
                    </div>
                </div>
                @endif
                <div >
                    <label for="">Description:</label>
                   <textarea name="" id="" cols="30" rows="3" class="form-control border border-dark"></textarea>
                </div>
                <div >
                    <label for="">Total Amount:</label>
                    <input type="number" name="" id="" class="form-control border border-dark">
                </div>
                <div class="mt-3">
                    <button class="btn btn-primary">Sumbit Spend</button>
                </div>
            </form>
        </div>
    </div>
</div>

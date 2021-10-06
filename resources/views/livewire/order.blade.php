<div class="container mt-2">
            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="card">
                            <div class="card-header">
                                <h5 style="float:left;font-weight:bold">ORDER NEW PRODUCT</h5>
                                    <input type="text" name="" id="barre_code_search" class="form-control border-primary"
                                    placeholder="Barcode Here" wire:model="product_code" wire:keyup="insertCart">
                                    @if($message)
                                        <div class="alert alert-danger text-center mt-3">
                                            {{$message}}
                                        </div>
                                    @endif

                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-left text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th >Total</th>
                                            <th>
                                                <i class="btn-sm btn-success" id="">+</i>
                                            </th>
                                        </tr>
                                    </thead>

                                <tbody class="">
                                    @foreach($productInCart as $cart)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                               <input type="text" value="{{ $cart->product->nom_produit }}"  class="form-control">
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <button class="btn btn-sm-1 btn-danger " wire:click.prevent="DecrementQty({{ $cart->id }})">-</button>
                                                    <div class="col-sm-3 d-flex justify-content-center align-items-center">{{ $cart->product_qnty}}</div>
                                                    <button class="btn btn-sm-1 btn-success" wire:click.prevent="IncrementQty({{ $cart->id }})">+</button>
                                                </div>
                                                <!-- <input type="number" name="quantity" id="" class="form-control " value="{{ $cart->product_qnty}}" max="{{ $cart->product_qnty}}"> -->

                                            </td>
                                            <td>
                                                <input type="number" name="price[]" id="" value="{{$cart->product->prix_vente}}" class="form-control price" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="discount[]" id="" class="form-control discount col-md-8" wire:model="discount" wire:emit="updateDiscount($id)" >
                                            </td>
                                            <td >
                                                <input type="number" name="total_amount[]" id="" class="form-control" value="{{($cart->product->prix_vente * $cart->product_qnty)*$discount}}"  readonly>
                                            </td>
                                            <td>
                                                <div class="btn btn-sm btn-danger" style="cursor:pointer" wire:click.prevent="removeCart({{$cart->id}})">X</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>

                    </div>




                            <div class="col-md-4">
                                <div class="card border-secondary">
                                    <div class="card-header bg-success">
                                    <h4 ><span >Total: </span><b style="color:white">{{ $productInCart->sum("product_price")}}</b><span> F</span></h4>
                                    </div>
                                    <form action="{{ route ('commande.store') }}" method="post">
                                            @csrf
                                            @foreach($productInCart as $cart)

                                                <input type="hidden" value="{{ $cart->product->id }}"  name="product_id[]" class="form-control">
                                                <input type="hidden" name="quantity[]" value="{{ $cart->product_qnty}}">
                                                <input type="hidden" name="price[]" value="{{$cart->product->prix_vente}}" class="form-control " readonly>
                                                <input type="hidden" name="discount[]" class="form-control  col-md-8" width="10%" >
                                                <input type="hidden" name="total_amount[]" class="form-control" value="{{$cart->product->prix_vente * $cart->product_qnty}}" width="40%">
                                            @endforeach
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-dark" ><i>Print</i></button>
                                                        <button type="button" class="btn btn-primary" ><i>History</i></button>
                                                        <button type="button" class="btn btn-danger" ><i>Report</i></button>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="text-primary">Customer Name</label>
                                                        <input type="text" name="customer_name" id="" class="form-control border-dark">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="" class="text-primary">Customer Phone</label>
                                                    <input type="text" name="customer_phone" id="" class="form-control border-dark">
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-around">
                                                    <p>
                                                        <i>Payment Method</i>
                                                    </p>
                                                    <p>
                                                        <span class="text-primary">Cash:</span>
                                                        <input type="radio" name="payment" checked id="" value="cash">
                                                    </p>
                                                </div>
                                                <div class="row d-flex justify-content-center">
                                                    <div class="form-group">
                                                        <label for="" class="text-primary">Payment Fees:</label>
                                                        <input type="number" name="paid_amount" id="" class="form-control border-dark" wire:model="pay_money">
                                                    </div>
                                                    <div class="form-group">
                                                    <label for="" class="text-primary">Change Fees:</label>
                                                    <input type="text" name="remain_amount" id="" class="form-control border-dark" wire:model="balance" readonly>
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-center">
                                                    <button class="form-control btn btn-primary col-md-8">Order Now</button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="modal">
            <div class="print">

            </div>
        </div>


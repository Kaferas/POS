<div class="container mt-4">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 style="float:left;font-weight:bold">ORDER NEW PRODUCT</h5>
                                <input type="text" name="" id="" class="form-control border-primary" placeholder="Barcode Here">
                            </div>
                            <form action="" wire:submit.prevent="save">
                                @csrf
                            <div class="card-body">
                                <table class="table table-bordered table-left text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                            <th>
                                                <i class="btn-sm btn-success" id="addbtn">+</i>
                                            </th>
                                        </tr>
                                    </thead>

                                <tbody class="addMoreProduct">
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <!-- <input type="hidden" name="" wire:model="activenow"> -->
                                                <select name="product_id[]" id="" class="form-control product_id" wire:model="cart.produit_id">
                                                    <option value="" selected>Chosse Product</option>
                                                    @foreach($products as $product)
                                                        <option data-price="{{$product->prix}}" data-promote="{{$product->promotion}}" value="{{$product->id}}">{{$product->nom_produit}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" id="quantity" class="form-control quantity" wire:model="cart.quantity">
                                             
                                            </td>
                                            <td>
                                                <input type="number" name="price[]" id="price" class="form-control price" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="discount[]" id="discount" class="form-control discount" >
                                            </td>
                                            <td>
                                                <input type="number" name="total_amount[]" id="total" class="form-control total m-0" >
                                            </td>
                                            <td>
                                                <div class="btn btn-sm btn-danger" style="cursor:pointer">X</div>
                                            </td>
                                        </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-md-4">
                        <div class="card border-secondary">
                                <div class="card-header bg-success">
                                <h4 ><span >Total: </span><b class="result" style="color:white"> 0.00</b><span> F</span></h4>
                                </div>
                                <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark" onclick="PrintReceipt('print')"><i>Print</i></button>
                                        <button type="button" class="btn btn-primary" onclick="PrintReceipt('print')"><i>History</i></button>
                                        <button type="button" class="btn btn-danger" onclick="PrintReceipt('print')"><i>Report</i></button>
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
                                        <input type="number" name="paid_amount" id="paid_amount" class="form-control border-dark">
                                    </div>
                                    <div class="form-group">
                                    <label for="" class="text-primary">Change Fees:</label>
                                    <input type="text" name="remain_amount" id="remain_amount" class="form-control border-dark" readonly>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button class="form-control btn btn-primary col-md-8">Save</button>
                                </div>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal">
            <div class="print">
            
            </div>
        </div>

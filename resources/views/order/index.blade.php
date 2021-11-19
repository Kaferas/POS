@extends("welcome")

@section("content")
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link text text-info active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">BarCode Cashier</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text text-success" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> Cashier</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

      @livewire("order")

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="container mt-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8 p-2">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="float:left;font-weight:bold">ORDER NEW PRODUCT</h5>
                            <!-- <input type="text" name="" id="" class="form-control border-primary" placeholder="Barcode Here"> -->
                        </div>

                        <form action="{{ route('commande.store') }}" method="POST">
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
                                            <select name="product_id[]" id="" class="form-control product_id text-center" wire:model="cart.produit_id">
                                                <option value="" selected class="text text-primary">---Chosse Product---</option>
                                                @foreach($products as $product)
                                                    <option data-price="{{$product->prix_vente}}" data-promote="{{$product->promotion}}" value="{{$product->id}}">{{$product->nom_produit}}</option>
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
                            <div class="card-header bg-info">
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
                                <button class="form-control btn btn-primary col-md-8">Order Now</button>
                            </div>

                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

@endsection

@section("script")
    <script>
        const barre= document.querySelector("#barre_code_search")
        console.log(barre)
        $("#addbtn").click(function(){
           var product=$(".product_id").html();
           var numberRow=($(".addMoreProduct tr").length-0)+1;
            var tr= "<tr><td class='no'>"+numberRow+"</td>"+
                    "<td><select class='form-control product_id' name='product_id[]'>"+product+"</td>"+
                    "</selected></td>"+
                    "<td><input type='number' name='quantity[]' class='form-control quantity'></td>"+
                    "<td><input type='number' name='price[]' class='form-control price' readonly></td>"+
                    "<td><input type='number' name='discount[]' class='form-control discount'></td>"+
                    "<td><input type='number' name='total_amount[]' class='form-control total m-0'></td>"+
                    "<td><i class='btn btn-sm btn-danger delete' style='cursor:pointer'>X</i></td>";
                    $(".addMoreProduct").append(tr);


        })
                    $(".addMoreProduct").delegate(".delete",'click',function(){
                        $(this).parent().parent().remove();
                        Calculate();
                    })

                    function Calculate()
                    {
                        var total=0;
                        $(".total").each(function(i,e){
                            var amount=$(this).val()-0;
                            total+=amount;
                        });
                        $(".result").html(total);
                    }

                    $(".addMoreProduct").delegate('.product_id','change',function(){
                        var tr=$(this).parent().parent();
                        var price=tr.find(".product_id option:selected").attr("data-price");
                        var promote=tr.find(".product_id option:selected").attr("data-promote");
                        console.log(price);
                        tr.find(".price").val(price);
                        tr.find(".discount").val(promote);
                        var qty= tr.find(".quantity").val()-0;
                        var disc= tr.find(".discount").val()-0;
                        var price= tr.find(".price").val()-0;
                        var total_amount= (qty*price)-((qty*price*disc)/100);
                        tr.find(".total").val(total_amount);
                        Calculate();
                    });

                    $(".addMoreProduct").delegate('.quantity , .discount','keyup',function(){
                        var tr=$(this).parent().parent();
                        var qty= tr.find(".quantity").val()-0;
                        var disc= tr.find(".discount").val()-0;
                        var price= tr.find(".price").val()-0;
                        var total_amount= (qty*price)-((qty*price*disc)/100);
                        tr.find(".total").val(total_amount);
                        Calculate();
                    });

                    $("#paid_amount").keyup(function(){
                        var total= $(".result").html()
                        var paid_amount=$(this).val();
                        var remain=paid_amount-total;
                        $("#remain_amount").val(remain);
                    });


                    // function PrintReceipt(el)
                    // {
                    //     var data='<input type="button" id="printPage'+ 'class="printPage" style="display:block;'+
                    //     'width="100%"; border:none; background-color:teal ;color:white'+ 'padding:14px 28px; font-size:16px; cursor:pointer'+
                    //     'text-align:center; value="Print Receipt" onclick="window.print()">';
                    //     data+=document.getElementById(el).innerHTML;
                    //     myReceipt=window.open("","myWin","left=150 , top=130 , width=400, height=400");
                    //     myReceipt.screenX=0;
                    //     myReceipt.screenY=0;
                    //     myReceipt.document.write(data);
                    //     myReceipt.document.title="Print Receipt";
                    //     myReceipt.focus();
                    //     setTimeout(() => {
                    //         myReceipt.close();
                    //     }, 8000);
                    // }
    </script>
@endsection

@extends("welcome")

@section("content")
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link text text-info active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Caisse</a>
  </li>
  <li class="nav-item">
    <a class="nav-link text text-success" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> Commandes</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      @livewire("order")
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="row jumbotron">
        <div class="col-md-7">
            <h1>Commmandes</h1>
        </div>
        <div class="col-md-4">
            <h1>Commmandes Details</h1>
        </div>
    </div>
</div>

</div>

@endsection

@section("script")
    <script>
         
        const barre= document.querySelector("#barre_code_search")
        // console.log(barre)
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

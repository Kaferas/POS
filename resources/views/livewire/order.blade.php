<div class="container mt-2 commande">
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
                                                <div class="d-flex justify-content-around ">
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
                                                        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModalCenter">
                                                            Print
                                                          </button>
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
                                            {{-- {{$productInCart}} --}}
                                            @if(count($productInCart))
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                    
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="facture">
                                                                <div class="facture_head">
                                                                    <p>FACTURE</p>
                                                                </div>
                                                                <div class="name">
                                                                    <h2>FLEMA SHOP</h2>
                                                                </div>
                                                                <span>BRINADA BUSSINESS S.A </span>
                                                                <ul>
                                                                    <li>Commerce General</li>
                                                                    <li>Centre Fiscal D G C </li>
                                                                    <li>Carama Avenue Mudwedwe</li>
                                                                    <li>BP 1523 Bujumbura-Burundi </li>
                                                                    <li>NIF 4738358954906 </li>
                                                                    <li>Registre de Commerce N0 32445 </li>
                                                                    <li>Assujeti de La TVA  OUI<input type="checkbox" checked> NON <input type="checkbox" name="" id=""></li>
                                                                    <li>Telephone: 22 84 89 54 </li>
                                                                </ul>
                                                                <div class="facture_identifier">
                                                                    <p class="identifier">
                                                                        <span id="bold">Facture No: </span>
                                                                        <span>18334</span>
                                                                        <span>M</span>
                                                                    </p>
                                                                    <p class="identifier">
                                                                        <span id="bold">Date :</span>
                                                                        <span>Thursday 8 October 2021</span>
                                                                    </p>
                                                                    <p class="identifier">
                                                                        <span id="bold">Client :</span>
                                                                        <span>Client</span>
                                                                    </p>
                                                                    <p class="identifier">
                                                                        <span id="bold">Assujeti TVA :</span>
                                                                        <span>Oui</span>
                                                                    </p>
                                                                    <p class="identifier">
                                                                        <span id="bold">NIF :</span>
                                                                    </p>
                                                                    <p class="identifier">
                                                                        <span id="bold">Residant a:</span>
                                                                    </p>
                                                                    <p class="identifier">
                                                                        <span id="bold">Payment :</span>
                                                                        <span >Cash</span>
                                                                    </p>
                                                                </div>
                                                                <div class="items">
                                                                    <table>
                                                                        <thead>
                                                                            <th>ITEMS</th>
                                                                            <th>QTY</th>
                                                                            <th>PU HTVA</th>
                                                                            <th>PT HTVA</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr style="text-align:center">
                                                                                <td>Kettle Saachi</td>
                                                                                <td>1 Pc(s)</td>
                                                                                <td>3000</td>
                                                                                <td>3000</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="font-weight: bold;">Garantie : 7jours</td>
                                                                                <td></td>
                                                                                <td>
                                                                                    <table>
                                                                                        <thead>
                                                                                            <th>PU TVAC</th>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr style="text-align:center">
                                                                                                <td>7000</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                                <td>
                                                                                    <table>
                                                                                        <thead>
                                                                                            <th>PT TVAC</th>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr style="text-align:center">
                                                                                                <td>7000</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="total">
                                                                    <p>
                                                                        <span id="bold">TOTAL GENERAL HORS TVA</span>
                                                                        <span>30000</span>
                                                                    </p>
                                                                    <p>
                                                                        
                                                                        <span id="bold">TOTAL CORRESPONDANCE</span>
                                                                        <span style="border-bottom: 2px solid black;">30000</span>
                                                                    </p>
                                                                    <p>
                                                                        <span id="bold">TOTAL GENERAL TVAC</span>
                                                                        <span>7000</span>
                                                                    </p>
                                                                </div>
                                                                <div class="thanks">
                                                                    <b>MERCI / THANK YOU </b>
                                                                    <p>SVP Verifier les marchandises  avant de quitter le magasin , Les marchandises vendues ne sont ni remises ni echangees</p>
                                                                    <span>**********ACHAT FINAL**********</span>
                                                                </div>
                                                                <div class="conditions">
                                                                    <ol>
                                                                        <li>L'appareil ne peut etre remis ou rembourse</li>
                                                                        <li>Pendant une periode de 14(quatorze) jours apres la date de l'achat l'appareil peut etre echange si celui-ci est dans le meme etat qu'il etait a l'achat</li>
                                                                        <li>Apres 14 (quatorze) jours de la date de l'achat l'apparel sera inspecte et repare gratuitement . Aucun changement d'appareil ne sera effectue</li>
                                                                        <li>En cas de reparation, la reparation , la garantie ne sera pas prolongee que de 14 (quatorze) jours a compter la date de reparation </li>
                                                                        <li>Au cas ou l'appareil ne sera pas reparable durant la periode de garantie l'entreprise chargera le client 5% par mois ecoule de la valeur a l'achat et chargera l'appareil si le client accepte la valeur de depreciation</li>
                                                                    </ol>
                                                                </div>
                                                                <div class="footer">
                                                                    <span>9/3/2020</span>
                                                                    <span>Kaferas</span>
                                                                    <span>04:20:14 PM</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                        <button type="button" class="btn btn-success col-12">Print Now</button>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
       
          
      


<div class="row col-md-11">

    <div class="col-md-7">
        <form action="" method="post" class="card p-2 bg-dark" >
            <div class="row col-md-12">
                <div class="form-group col-md-4">
                    <label for="" class="text text-light">Code-Produit</label>
                    <input type="text" name="" id="" class="form-control" disabled wire:model="codeBarre">
                </div>
                <div class="form-group col-md-5">
                    <label for="" class="text text-light">Nom Produit:</label>
                    {{-- @dump($produits) --}}
                    <select name="" id="" class="form-control" wire:model="produit" wire:change="grabCodeBarre">
                        <option value=""></option>
                        @foreach ($produits as $pro)
                            <option value="{{$pro->id}}" @if ($pro->quantite <= $pro->alert_ecoulement)
                                class="text text-danger"
                            @endif> @if ($pro->quantite <= $pro->alert_ecoulement)
                            {{$pro->nom_produit}} ({{$pro->quantite}} restants)
                            @else
                            {{$pro->nom_produit}}
                        @endif</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="text text-warning">Stock Alert</label>
                    <input type="text" name="" id="" class="form-control" wire:model="stockAlert">
                </div>
            </div>
            <div class="row col-md-11">
                <div class="form-group col-md-3">
                    <label for="" class="text text-light">Prix Achat</label>
                    <input type="text" class="form-control" wire:model="prixachat">
                </div>
                @error("prixachat")
                        <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group col-md-3">
                    <label for="" class="text text-light">Prix Vente</label>
                    <input type="text" class="form-control" wire:model="prixvente" wire:keyup="costInteret">
                </div>
                @error("prixvente")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group col-md-3">
                    <label for="" class="text text-light">Interet</label>
                    <input type="text" class="form-control" wire:model="interet">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="text text-light">Quantite</label>
                    <input type="text" class="form-control" wire:model="quantite">
                </div>
                @error("quantite")
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                <div class="form-group col-md-12">
                    <div class="btn btn-warning mt-3 text-dark container" wire:click.prevent="save">Approvisionner</div>
                </div>
            </div>
        </form>
        <table class="table" style="overflow: auto">
            {{-- @dump($latest) --}}
            <h3 class="text text-center p-2 text-sucess"><i>Recent Produit</i></h3>
            <thead class="thead-light">
              <tr class="text-center">
                <th scope="col">CodeProduit</th>
                <th scope="col">Nom</th>
                <th scope="col">Quantite Restant</th>
                <th scope="col">Prix Unitaire</th>

              </tr>
            </thead>
            <tbody class="text-center">
                @foreach ($latest as $last)
                    <tr style="cursor: pointer" wire:click="floo({{$last->codeProduit}})" id="apprHover">
                        <th scope="row">{{$last->codeProduit}}</th>
                        <td>{{$last->nameProduit()->first()->nom_produit}}</td>
                        <td>{{$last->nameProduit()->first()->quantite}}</td>
                        <td>{{$last->nameProduit()->first()->prix_vente}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$latest->links()}}
    </div>
    <div class="col-md-5">
        <h4 class="text text-primary"> Historique </h4>
        <div>
            @if($hasHistory)
                <table class="table" style="overflow: auto">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">CodeProduit</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Quantite Restant</th>
                            <th scope="col">Prix Unitaire</th>
                            <th scope="col">Date Approvisonement</th>
                          </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($history as $singlentry)
                        <tr style="cursor: pointer">
                            <td >{{json_decode($singlentry->LastStock)->product_code}}</td>
                            <td >{{json_decode($singlentry->LastStock)->nom_produit}}</td>
                            <td >{{json_decode($singlentry->LastStock)->quantite}}</td>
                            <td >{{json_decode($singlentry->LastStock)->prix_vente}}</td>
                            <td >{{date_format(date_create(json_decode($singlentry->LastStock)->updated_at),"d-m-y h:m:i")}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
             @endif
        </div>
    </div>
</div>

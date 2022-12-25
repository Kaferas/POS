@extends("welcome")

@section("content")

<form action="{{route('rapport')}}" method="GET">
    <div class="col-md-12 form-group d-flex mt-3 mb-4"> 
        <div class="input-group" style="line-height:40px">
            <span class="input-group-addon text-uppercase text-success">Date de Depart:&nbsp; </span>
            <input type="date" name="depart" id="" class="form-contdol col-md-5" style="border-radius: 5px">
        </div>
        <div class="input-group">
            <span class="input-group-addon text-uppercase text-success" style="text-align:center;line-height:40px">Date de Fin :&nbsp;</span>
            <input type="date" name="fin" id="" class="form-contdol col-md-5" style="border-radius: 5px">
        </div>
        <div class="input-group " style="line-height:40px">
            <span class="input-group-addon text-uppercase text-success">Type de Rapport: </span>
            &nbsp;
            <select name="motif" id="" class="form-contdol col-md-5">
                <option value="detaille">Detaille Commandes</option>
                <option value="compresse">Detaille Compresse</option>
            </select>
        </div>
        <div class=" col-md-2 d-flex justify-content-around">
            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-undo text text-primary"></i>&nbsp;Charger</button>
            <button class="btn btn-sm  btn-outline-success"><i class="fa fa-print text text-success"></i> &nbsp;Imprimer</button>
        </div>
    </div>
</form>
    <div class="col-md-12 table mt-5">
        <table class="table-responsive">
            <thead >
                <th style="text-align:center;width:200px">No</th>
                <th style="text-align:center; width:200px">Date Creation</th>
                <th style="text-align:center; width:200px">CodeBarre</th>
                <th style="text-align:center; width:200px">Produit</th>
                <th style="text-align:center; width:200px">Auteur</th>
                <th style="text-align:center; width:200px">Facture</th>
                <th style="text-align:center; width:200px">Quantite</th>
                <th style="text-align:center; width:200px">Total</th>
            </thead>
            <tbody>
                @if(isset($detaille))
                   <?php $total=0;?>
                    @forelse($detaille as $index => $one)
                        <tr>
                            <td style="width:200px">{{$index+1}}</td>
                            <td style="width:200px">{{$one->created_at->format("d/m/Y")}}</td>
                            <td style="width:200px">{{$one->produit[0]->product_code}}</td>
                            <td style="width:200px">{{$one->produit[0]->nom_produit}}</td>
                            <td style="width:200px">{{$one->user[0]->name}}</td>
                            <td style="width:200px">{{$one->nFacture}}</td>        
                            <td style="width:200px">{{$one->quantite}}</td>
                            <td style="width:200px">{{$one->total}}</td>
                            <?php $total+=$one->total?>
                        </tr>
                     @empty
                    <tr style="rowspan:8">
                        <td style="width:200px;colspan:8">Aucun Donnee Disponible</td>
                    </tr>
                     @endforelse  
                @else    
                    <p>HElooo</p>
                @endif
            </tbody>
        </table>
        <div class="mt-3">
            <table>
                <tr>
                    <td><h2 style="font-style:italic">Total </h2></td>
                    <td><h2 style="font-style:italic;color:rgb(70, 70, 205)">{{isset($total)?$total:0}} FBU</h2></td>
                </tr>
            </table>
         </div>
    </div>
@endsection
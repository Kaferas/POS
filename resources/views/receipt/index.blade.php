<style>
    .container{
        border:4px dashed yellow;
        background-color: rgba(0,0,0,.9);
    }
    button{
        padding:8px;
        background-color: rgb(18, 215, 81);
        color:rgb(16, 15, 15);
        border-radius: 5px;
    }
    p
    {
        height: 30px;
        text-indent:40px;
        text-align: justify;
        padding:10px;
        color:white;
        font-size: 1.3rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .header{
        width: 100vw;
        text-align: start;
        font-size: 2em;
        color:rgb(18, 215, 81);
        background-color: rgba(0,0,0,.9);
        /* padding-bottom: 10px; */
        line-height: 1em;
        border:4px dashed yellow;
    }
</style>
<p class="header">Produits Retournes</p>
<div  style="display:flex; justify-content:center;">
    <div class="container" style="width:40vw">
        <p>Date  : <span style="color:rgb(18, 215, 81)">{{ date("l d-m-Y") }}</span> </p>
        <p>Code Commande : <span style="color:rgb(18, 215, 81)">{{$commande[0]->code_commande}}</span></p>
        <p>Date de Commande : <span style="color:rgb(18, 215, 81)">{{$commande[0]->created_at->format("d-m-Y h:m:s")}}</span></p>
        <p>Montant Payer Commande : <span style="color:rgb(18, 215, 81)">{{number_format($commande[0]->montant_payer) ." FBU"}}</span> </p>
        <p>Montant Restant : <span style="color:rgb(18, 215, 81)">{{number_format($commande[0]->montant_restant) ." FBU"}}</span> </p>
        <p>Facture Emise par : <span style="color:rgb(18, 215, 81)">{{$commande[0]->user[0]->name }}</span> </p>
        <p>Jour de Passe depuis la Commande : <?php $date1= new DateTime(date("d-m-Y")); ?>
            <?php $date2= $commande[0]->created_at ?>
            <?php $diff= $date1->diff(new DateTime($date2)) ?>
            <span style="color:rgb(18, 215, 81)">{{$diff->days." Jours"}}</span>
        </p>
    </div>
    <div class="container" style="width:60vw">
        <p style="text-align: center">Produits du Commande {{$commande[0]->code_commande}}</p>
        <?php $total=0; ?>
     @foreach($commande_produit as  $single)
        <div style="display: flex;justify-content:space-around">
            <div class="border">
                <p>Nom : <span style="color:rgb(76, 207, 117)">{{$single->produit[0]->nom_produit}}</span></p>
                <p>Jour de Garantie Produit : <span style="color:rgb(76, 207, 117)">{{$single->produit[0]->jourGarantie ." Jours"}}</span> </p>
            </div>
            <div>
                <p>Quantite : <span style="color:rgb(76, 207, 117)">{{$single->quantite}}</span></p>
                <p>Prix Unitaire : <span style="color:rgb(76, 207, 117)">{{$single->prix_unitaire}}</span></p>
            </div>
            <div>
                <p>
                    <button>Retourner</button>
                </p>
            </div>
            <p><?php  $total+=($single->quantite*$single->prix_unitaire) ?></span></p>
        </div>
        @endforeach
        <div>
            <p style="text-align:center">Total Commande : <span style="color:rgb(76, 207, 117)">{{$total." FBU"}}</span></p>
        </div>
    </div>
</div>
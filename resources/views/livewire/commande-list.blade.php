<style>
    .commandeHov{
        background-color: !aqua
    }
</style>
<div>
    <div class="d-flex justify-center">
        <input type="text" wire:model="sCommande" class="form-control pl-4 mb-3 col-lg-10"  placeholder="Rechercher une Commande par Son Code">
    </div>
    {{$sCommande}}
    @foreach($commandes as $key => $commande)
        <div wire:click="getDetailCommande('{{$commande->id}}')" style="cursor:pointer;display:flex; justify-content:space-evenly;align-items:center; background-color:white; height:60px;border-radius:3px; margin:10px" class="commandeHov">
                <p style="text-align:center;color:white;background-color:rgb(43, 111, 184); width:20px;line-height:3em; padding:0;margin:0">{{$key+1}}</p>
                <p>{{$commande->code_commande}}</p>
                <p>{{($commande->montant_payer-$commande->montant_restant)."FBU"}}</p>
                <p>Cree par: @dump($commande->user)</p>
                <p style="display: flex;">

                </p>
        </div>
    @endforeach
    <div class="row" style="display: flex; justify-content:center">
        <p>{{$commandes->links()}}</p>
    </div>
</div>

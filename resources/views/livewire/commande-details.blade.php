<div>
    @if ($has)
        <div class="d-flex justify-content-between">
            <h4 class="text mb-3">Details Commandes <span class="text-primary"> : {{ $currentCommand }}</span></h4>
            <p class="text text-danger bg-light p-2" style="cursor:pointer" wire:click="looseView">Fermer X</p>
        </div>
        <div style="display:flex; flex-direction:column; justify-content:space-between; height:70vh; padding:10px; border:1px solid rgb(172, 170, 170)">
            <?php $tot = 0; ?>
            <table style="border: none">
                <thead style="border: none">
                    <tr>
                        <td>Image</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($retrieve_details as $found)
                        <tr>
                            <td>
                                <p
                                    style="display:flex; justify-content:center;align-items:center;background-color:rgba(255, 255, 255, 0.914); height:50px">
                                    <img src="{{'storage/Photos/'.$found->produit[0]->pic_path }}"  alt="" width="50px" height="50px">
                                </p>
                            </td>
                            <td>
                                <p
                                    style="display:flex; justify-content:center;align-items:center;background-color:rgba(255, 255, 255, 0.914); height:50px">
                                    {{ $found->produit[0]->nom_produit }}
                                </p>
                            </td>
                            <td>
                                <?php $tot += $found->total; ?>
                                <p
                                    style="display:flex; justify-content:center;align-items:center;background-color:rgba(255, 255, 255, 0.914); height:50px">
                                    {{ $found->prix_unitaire }}
                                </p>
                            </td>
                            <td>
                                <p
                                    style="display:flex; justify-content:center;align-items:center;background-color:rgba(255, 255, 255, 0.914); height:50px">
                                    <span style="color:blue;font-size:20px"> {{ $found->quantite.' '.$found->produit[0]->unite_mesures->name }}</span>
                                </p>
                            </td>
                            <td>
                                <p
                                    style="display:flex; justify-content:center;align-items:center;background-color:rgba(255, 255, 255, 0.914); height:50px">
                                    <span style="color:blue;font-size:20px">{{($found->quantite*$found->prix_unitaire)}} FBU</span>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="display:flex;justify-content:space-between;padding:10px;background-color:white">
                <p style="font-size:30px;font-style:italic">Total a Payer:</p>
                <p class="text-primary" style="font-size:35px;font-style:italic">{{ number_format($tot) }} FBU</p>
            </div>
        </div>
</div>
@endif
</div>

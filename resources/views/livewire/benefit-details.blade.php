<div class="d-flex flex-column justify-content-center align-items-center">
    @if ($display)
        <h4>Section Benefit:</h4>
        <div width="100%">
            <h3 class="alert alert-secondary text text-secondary">Stock Benefit:
                <span class="text text-success">
                    {{ ($total->prix_vente-$total->prix_achat)*$total->quantite}} FBU
                </span>
            </h3>
        </div>
    @endif
</div>

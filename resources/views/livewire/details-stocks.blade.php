<div class="col-6 text-center d-flex flex-column align-items-center">
  @if ($display)
    <div>
      <h2 class="">Total <span class="text text-info">{{ $totalIn->nom_produit}}</span>:  <span class="text text-danger alert alert-success" style="font-size: 2.5rem">{{number_format($totalIn->quantite * $totalIn->prix_vente,3,'.','')}}</span> FBU</h2>
    </div>
    <div class="m-2">
        <img src="{{asset('img/xx.png')}}" alt="" width="150px" height="150px">
    </div>
    <div class="d-flex flex-column justify-content-evenly align-items-center" width="100vw">

        <p  style="font-size: 1.2rem">
            Quantite en Stock :
            @if ($totalIn->quantite > $totalIn->alert_ecoulement)
                <span class="alert alert-success p-2">
                    {{ $totalIn->quantite }}
                </span>
            @else
                <span class="alert alert-danger p-2">
                    {{ $totalIn->quantite }}
                </span>
            @endif
        </p>
        <p class="text text-secondary mt-2" style="font-size: 1.2rem">
            Date Expiration : {{ $totalIn->date_out }}
        </p>
        <p class="text text-info" style="font-size: 1.2rem">
            Prix Achat : {{ $totalIn->prix_achat }} FBU
        </p>
        <p class="text text-success" style="font-size: 1.2rem">
            Prix Vente : {{ $totalIn->prix_vente }} FBU
        </p>
    </div>
    <div>
        <h2 class="text-primary" style="font-size: 2rem">{{ $totalIn->nom_produit}} </h2>
        <p>
            {!! $totalIn->Code_barre !!}
            <span style="letter-spacing: 16px;">{{ $totalIn->product_code }}</span>
        </p>
    </div>
  @endif
</div>
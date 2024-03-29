<div class="row col-md-10 h-100">
    <div class="col-md-5">
        <div class="bg-light text text-dark p-5 ">
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" wire:click.prevent="whatisCurrent('client')"><i class="fa fa-user" aria-hidden="true"></i>
                Clients</a></li>
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" wire:click.prevent="whatisCurrent('ventes')"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Ventes</a></li>
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" wire:click.prevent="whatisCurrent('categories')"><i class="fa fa-list-alt" aria-hidden="true"></i>
                Categories</a></li>
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" wire:click.prevent="whatisCurrent('fournisseurs')">
                Fournisseurs</a></li>
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" wire:click.prevent="whatisCurrent('produits')"><i class="fa fa-shopify-alt" aria-hidden="true"></i>
                Produits</a></li>
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" wire:click.prevent="whatisCurrent('cloture')">
                Cloture </a></li>
        </div>
    </div>
    @if ($current == "client")
        <div class="col-md-4">
            Client
        </div>
    @elseif ($current == "ventes")
    <div class="col-md-5">
        <div class="bg-light text text-dark p-5 ">
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="{{ route("optionReport") }}"><i class="fa fa-user" aria-hidden="true"></i>
                Rapport Journalier</a></li>
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" ><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                Rapport  Graphical</a></li>
            <li class="border-secondary border-bottom m-3 list-unstyled pl-4"><a href="" ><i class="fa fa-list-alt" aria-hidden="true"></i>
                Historique</a></li>
        </div>
    </div>
    @elseif ($current == "categories")
    <div class="col-md-4">
        Categories
    </div>
    @elseif ($current == "fournisseurs")
    <div class="col-md-4">
        Fournisseurs
    </div>
    @elseif ($current == "produits")
    <div class="col-md-4">
        Produits
    </div>
    @endif

</div>

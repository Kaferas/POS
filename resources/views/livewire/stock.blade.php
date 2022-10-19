<div class="col-12">
    <div class="container row pl-5 mt-4">
        <label for="" class="text-primary mt-2">Filtrer par:</label>
        <div class="col-4">
            <select name="search_critere" id="" class="form-control border-dark" wire:model="critere">
                <option value="nom_produit">Nom Produit</option>
                <option value="category_produit">Categorie</option>
            </select>
        </div>

        @if ($critere == "category_produit")
            <div class="col-3">
                <select name="search_critere" id="" class="form-control border-dark" wire:model="category">
                    <option value="" selected>---Choisisez la Categorie--</option>
                    @foreach ($categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->categorie_name}}</option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="col-3">
                <input type="text" name="" value="Here" id="" class="form-control border-dark" placeholder="Chercher Ici ..." wire:model="query">
            </div>
         @endif
    </div>
    <div class="row mt-5">

        <div class="col-5 d-flex flex-column ">
            <div class="pl-5">
                <h2 class="secondary mb-3">Listes des Produits</h2>
            <table class="table table-striped">
                <thead class="text-center">
                    @foreach ($headers as $key => $value )
                        <th style="cursor:pointer" class="text text-primary" wire:click="sort('{{ $key }}')">
                            @if($sortColumn== $key)
                                <span>{!! $sortDirection== "asc" ? "&#8659;" : "&#8657;" !!}</span>
                            @endif
                            {{ $value}}
                        </th>
                    @endforeach
                </thead>
                <tbody>
                    @if(count($data))
                        @foreach ($data as $item)
                            <tr style="cursor:pointer">
                                @foreach ($headers as $key => $value )
                                    @if($key == "")
                                        <td>
                                            <button class="btn btn-primary col-12" wire:click="danger('{{$item->id}}')">Details</button>
                                        </td>
                                    @endif
                                        <td>
                                            {{  $item->$key }}
                                        </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <h2 colspan="{{count($headers)}}" class="text-center">No Results Founds</h2>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
        <div>
            <livewire:benefit-details />
        </div>
        </div>
            <livewire:details-stocks/>
        </div>
</div>

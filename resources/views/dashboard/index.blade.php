@extends('welcome')


@section('content')
    <h1 class="mt-2">Dashboard</h1>
    <div class="row container d-flex justify-content-around">
        <div class="white_notify">
            <div class="pl-4 pb-3">
                <h3 class="text text-primary">{{ $ventes }}</h3>
                <span>Global Ventes</span>
            </div>
            <div class="counter_notify bg-primary">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="white_notify">
            <div class="pl-4 pb-3">
                <h3 class="text text-success">{{ $clients }}</h3>
                <span>Global Clients</span>
            </div>
            <div class="counter_notify bg-success">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="white_notify">
            <div class="pl-4 pb-3">
                <h3 class="text text-danger">{{ $produits }}</h3>
                {{-- <span>Global Articles {{dd($ecoule)}}</span> --}}
            </div>
            <div class="counter_notify bg-danger">
                <i class="fas fa-hdd "></i>

            </div>
        </div>
    </div>
    <div>
        <h3 class="text-center mt-4">Items expiring soon</h3>
        <table class="table table-stripped">
            <thead>
                <tr class="text-center text text-dark">
                    <th scope="col">ID Produit</th>
                    <th scope="col">Nom Produit</th>
                    <th scope="col">Quantite Expiration</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Date Expiration</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soonExpire as $item)
                    @if ((new \DateTime($item->date_out))->diff(new \DateTime($item->date_in))->days <= 30)
                        <tr class="text-center mb-3" style="background-color:rgb(227, 206, 148)">
                            <td>{{ $item->product_code }}</td>
                            <th scope="row">{{ $item->nom_produit }}</th>
                            <td>
                                {{ $item->quantite }}
                                @foreach ($item->unite_mesures as $unite)
                                    {{-- <span class="text text-primary">{{$unite->name}}</span> --}}
                                @endforeach
                            </td>
                            @foreach ($item->categories as $categorie)
                                <td>{{ $categorie->categorie_name }}</td>
                            @endforeach
                            <td>{{ $item->date_out }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

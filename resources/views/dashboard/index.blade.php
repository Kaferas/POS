@extends('welcome')


@section('content')
    <h1 class="mt-2">Dashboard</h1>
    <div class=" d-flex justify-content-between mb-4">
        <div class="white_notify">
            <div class="pl-2 pb-3">
                <h3 class="text text-primary">{{ $ventes }}</h3>
                <span>Global Ventes</span>
            </div>
            <div class="counter_notify bg-primary">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
        <div class="white_notify">
            <div class="pl-2 pb-3">
                <h3 class="text text-success">{{ $clients }}</h3>
                <span>Global Clients</span>
            </div>
            <div class="counter_notify bg-success">
                <i class="fas fa-users"></i>
            </div>
        </div>
        <div class="white_notify">
            <div class="pl-2 pb-3">
                <h3 class="text text-warning">{{ $produits }}</h3>
                <span>Global Articles </span>
            </div>
            <div class="counter_notify bg-warning">
                <i class="fas fa-hdd "></i>

            </div>
        </div>
        <div class="white_notify">
            <div class="pl-2 pb-3">
                <h3 class="text text-danger">{{ $total }} FBU</h3>
                <span>Total Ventes </span>
            </div>
            <div class="counter_notify bg-danger">
                <i class="fas fa-credit-card "></i>

            </div>
        </div>
    </div>
    <div class="mt-4">
        <livewire:chart.chart-component />
    </div>
@endsection

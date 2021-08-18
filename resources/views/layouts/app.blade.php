<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HALLEUIA FAST FOOD</title>
    <link rel="stylesheet" href="{{ asset('css/design.css') }}">
    <script src="{{asset('js/script.js')}}" defer></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
  <div class="both">
    <div class="aside">
        <ul>
    <li><i class="fa fa-product-hunt" aria-hidden="true"></i> Produits</li>
            <li>Entree</li>
            <li>Fournisseurs</li>
            <li class="active">Entree/Sortie</li>
            <li>Social</li>
            <li>Rapport</li>
            <li>Commande</li>
            <li>Produits</li>
            <li>Transactions</li>
            <li>Utilisateur</li>
        </ul>
    </div>
    <div class="profile">
        <div class="info">
            <div class="factory_name">
                <h2 style="margin-left:25px;color:rgb(44, 41, 41);font-style: italic;font-weight:bold;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif">
                    GALLERIE ALLELUIA
                </h2>
            </div>
            <div class="time">
                <h3 class="what-time" style="color:rgb(32, 134, 230);"></h3>
                <h4>
                    <span style="color:rgb(12, 95, 40);">Connected as:</span>
                    <span>Profile</span>
                    <h3><button class="btn-logout" style="display:inline">Logout</button></h3>
                </h4>
            </div>
        </div>
        <div class="center">
            @yield("content")
        </div>
    </div>
</body>
</html>
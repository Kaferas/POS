<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HALLELUIA FAST FOOD</title>
    <link rel="stylesheet" href="{{ asset('css/design.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <livewire:styles/>
</head>
<body>
  <div class="both">
        <div class="aside">
            <ul style="margin-top:150px;" class="sidebar">
                <li id="sidebar" @if($activenow=='utilisateur') class='actived' @endif ><a href="/utilisateur">Approvisionner</a></li>
                <li id="sidebar" ><a href="/produits" >Produits</a></li>
                <li id="sidebar" ><a href="/commande" >Caissier</a></li>
                <li id="sidebar" ><a href="/report" >Caissier</a></li>
                <li id="sidebar" ><a href="/commande" >Stocks</a></li>
                <li id="sidebar" ><a href="/commande" >Rapports</a></li>
                <li id="sidebar" ><a href="/commande" >Deconnexion</a></li>
                <!--  -->
            </ul>
        </div>
        <div class="profile">
            <div class="info">
                <div class="factory_name">
                        <h4 style="margin-left:25px;color:dodgerblue;font-family:Arial, Helvetica, sans-serif">GALLERIE ALLELUIA</h4>
                </div>
                <div class="time mt-3">
                    <h6 class="what-time" style="color:brown;"></h6>
                    <h6>Profile</h6>
                    <h6><button class="btn-logout">Logout</button></h6>
                </div>
            </div>
            <div class="center">
                @yield("content")    
            </div>
        </div>
    </div>
    <script  src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/script.js')}}" defer></script>
    @yield("script")
    <livewire:scripts/>
    <script>
        
        window.addEventListener("modalUser",event =>{
            $("#addUSer").modal('show');
        });
      
        window.addEventListener("openModalDelete",event =>{
            $("#deletecategorie").modal('show');
        });
        window.addEventListener("closeCategorieModal",event =>{
            $("#deletecategorie").modal('hide');
        });
      

        window.addEventListener("eraseUser",event=>{
            $("#eraseUser").modal("show");
        });
        window.addEventListener("eraseUserClose",event=>{
            $("#eraseUser").modal("hide");
        });

        window.addEventListener("OpendelProductModal",event=>{
            $("#delProduct").modal("show");
        });
        window.addEventListener("closedelProductModal",event=>{
            $("#delProduct").modal("hide");
        });
    </script>
</body>
</html>
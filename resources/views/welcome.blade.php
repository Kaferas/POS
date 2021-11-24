<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS System</title>
    <link rel="stylesheet" href="{{ asset('assets/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/design.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <livewire:styles/>
</head>
<body>
  <div class="both">
        <div class="aside">
            <ul style="margin-top:150px;" class="sidebar">
                <li id="sidebar" @if($activenow=='dashboard') class='actived' @endif ><a href="/" ><i class="fa fa-terminal"></i>Dashboard</a></li>
                <li id="sidebar" @if($activenow=='cashier') class='actived' @endif ><a href="/commande" ><i class="fa fa-terminal"></i>Cashier</a></li>
                <li id="sidebar" @if($activenow=='depenses') class='actived' @endif ><a href="{{route('depenses')}}" >Depenses</a></li>
                <li id="sidebar" @if($activenow=='fournisseur_client') class='actived' @endif ><a href="/fournisseur_client" >Customers/Suppliers</a></li>
                <li id="sidebar" ><a href="/commande" >Reports</a></li>
                <li id="sidebar" @if($activenow=='utilisateur') class='actived' @endif ><a href="/utilisateur">Settings</a></li>
                <li id="sidebar" @if($activenow=='stocks') class='actived' @endif><a href="/stocks" >Stocks</a></li>
                <li id="sidebar" ><a href="{{route('logout')}}" >Logout</a></li>
                <!--  -->
            </ul>
        </div>
        <div class="profile">
            <div class="info">
                <div class="factory_name">
                        <h4 style="margin-left:25px;color:dodgerblue;font-family:Arial, Helvetica, sans-serif">POS MANAGEMENT SYSTEM</h4>
                </div>
                <div class="time mt-3">
                    <h6 class="what-time" style="color:rgb(211, 18, 18); font-size:3em padding:10px"></h6>
                    <h6 class="connectUser">{{ Auth::user()->name }}</h6>
                    <form action="" method="post">
                        <h6><a class="btn btn-danger" href="{{ route('logout') }}">Logout</a></h6>
                    </form>

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

        window.addEventListener("mesureOpenModal",()=>{
            $("#deleteUnite").modal("show")
        });
        window.addEventListener("closeMesureModal",()=>{
            $("#deleteUnite").modal("hide")
        });
        window.addEventListener("OpenModaleditclient",()=>{
            $("#delClient").modal("show")
        });
        window.addEventListener("OpenModaldeleteFournisseur",()=>{
            $("#delfournisseur").modal("show")
        });
        window.addEventListener("CloseModaldeleteFournisseur",()=>{
            $("#delfournisseur").modal("hide")
        });
        window.addEventListener("openModalDepensedelete",()=>{
            $("#deldepense").modal("show")
        });
        window.addEventListener("closeModalDepensedelete",()=>{
            $("#deldepense").modal("hide")
        });
        window.addEventListener("closedelClientModal",()=>{
            $("#delClient").modal("hide")
        });
        $(document).ready(function(){
            $("#barre_code_search").focus()
        })
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/Flema.svg') }}" sizes="any" type="image/svg+xml">
    <title>POS System</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/design.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facture.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/facture.css') }}">
    <script src="{{ asset('css/assets/jquery-3.6.0.min.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.css" rel="stylesheet" media="all">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>
    <livewire:styles />
</head>

<body>
    <div class="both">
        <div class="aside">
            <img src="{{ asset('img/Flema.png') }}" alt="" width="120px">
            <ul style="margin-top:35px;" class="sidebar">
                <li id="sidebar" @if ($activenow == 'dashboard') class='actived' @endif><a href="/"><i
                            class="fa fa-tachometer-alt text text-primary"></i> &nbsp Tableau Bord</a></li>
                <li id="sidebar" @if ($activenow == 'cashier') class='actived' @endif><a href="/commande"><i
                            class="fas fa-cash-register text text-primary"></i> &nbsp Caissier</a></li>
                <li id="sidebar" @if ($activenow == 'depenses') class='actived' @endif><a
                        href="{{ route('depenses') }}"><i class="fab fa-bitcoin text text-primary"></i>
                        &nbspDepenses</a></li>

                @if (Gate::allows('is_admin'))
                    <li id="sidebar" @if ($activenow == 'fournisseur_client') class='actived' @endif><a
                            href="/fournisseur_client"><i class="fas fa-users text text-primary"></i>
                            &nbspClient/Fournisseur</a></li>
                    <li id="sidebar" @if ($activenow == 'stocks') class='actived' @endif><a href="/stocks"><i
                                class="fas fa-dolly text text-primary"></i> &nbspStocks</a></li>
                    {{-- <li id="sidebar"><a href="{{route('receipt',"75744324")}}"><i class="fas fa-undo-alt text text-primary"></i> &nbsp;Produit
                            Retourner</a></li> --}}
                    <li id="sidebar" @if ($activenow == 'approvision') class='actived' @endif><a
                            href="/approvision"><i class="fas fa-plus text text-primary"></i>
                            &nbsp;Approvisionner</a></li>
                    <li id="sidebar" @if ($activenow == 'utilisateur') class='actived' @endif><a
                            href="/utilisateur"><i class="fas fa-sliders-h text text-primary"></i> &nbspParametres</a>
                    </li>
                    <li id="sidebar" @if ($activenow == 'reports') class='actived' @endif><a href="/reports"><i
                        class="fas fa-chart-bar text text-primary"></i> &nbspRapports</a></li>
                @endif
                <li id="sidebar"><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt text text-primary"></i>
                        &nbsp Deconnexion</a></li>
                <!--  -->
            </ul>
            {{-- <p class="text text-light" style="float:bottom">Here you must provide a Date</p> --}}
        </div>
        <div class="profile">
            <div class="info">
                <div class="factory_name">
                    <h4 style="margin-left:25px;color:dodgerblue;font-family:Arial, Helvetica, sans-serif">POS
                        MANAGEMENT SYSTEM</h4>
                </div>
                <div class="time mt-3">
                    <h6 class="what-time" style="color:rgb(211, 18, 18); font-size:3em padding:10px"></h6>
                    <div class="dropdown" title="Articles pres a epuiser dans le Stock">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="text text-primary fas fa-bell 2xl"><span class="badge text-bg-secondary"
                                    style="font-size:18px;font-weight:bold">{{DB::table('produits')->select('alert_ecoulement','quantite')->where('quantite','<',20)->count()}}</span></i>
                        </button>
                        <?php $data=DB::table('produits')->select('nom_produit','quantite')->where('quantite','<',20)->get() ?>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" title="Article ecoule en Stock">
                                @foreach($data as $one)
                                    <a class="dropdown-item text text text-success" style="font-style:italic;font-weight:bold" href="#">L'article <span class='text text-danger'>{{$one->nom_produit}}</span> reste {{$one->quantite}} en Stock</a>
                                @endforeach
                            </div>
                    </div>

                    <h6 class="connectUser">{{ Auth::user()->name }}</h6>
                    <form action="" method="post">
                        <h6><a title="Deconnexion" class="btn btn-danger p-1" href="{{ route('logout') }}"><i
                                    class="fa fa-power-off" aria-hidden="true"></i>
                            </a></h6>
                    </form>

                </div>
            </div>
            <div class="center jumbotron p-2 h-auto">
                @yield('content')
            </div>
        </div>
        
    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    @yield('script')
    <livewire:scripts />
    <script>
        function printDiv(el) {
            var divContents = document.getElementById(el).innerHTML;
            var a = window.open('', '', 'height=auto, width=30vw');
            a.document.write('<html>');
            a.document.write('<head>');
            a.document.write('<link rel="stylesheet" href="css/facture.css"/>');
            a.document.write('</link>');
            a.document.write('<body>');
            a.document.write(divContents);
            a.document.write('</body></head>');
            a.document.close();
            a.print();
        }
    </script>
    <script>
        var b;
        window.addEventListener("modalUser", event => {
            $("#addUSer").modal('show');
        });

        window.addEventListener("openModalDelete", event => {
            $("#deletecategorie").modal('show');
        });
        window.addEventListener("closeCategorieModal", event => {
            $("#deletecategorie").modal('hide');
        });
        window.addEventListener("addShowClass", event => {
            $("#collapseOne").addClass('show');
        });
        window.addEventListener("collapseSupplier", event => {
            $(".collapseSup").addClass('show');
        });

        window.addEventListener("eraseUser", event => {
            $("#eraseUser").modal("show");
        });
        window.addEventListener("eraseUserClose", event => {
            $("#eraseUser").modal("hide");
        });

        window.addEventListener("OpendelProductModal", event => {
            $("#delProduct").modal("show");
        });
        window.addEventListener("closedelProductModal", event => {
            $("#delProduct").modal("hide");
        });

        window.addEventListener("printCode", event => {
            let code=document.querySelector("#codePrintBarre");
            let codeBarre= ($(code).attr("data-value"));
            let codeNumber= ($(code).attr("data-code"));
            var a = window.open('', '', 'height=auto, width=60vw');
            a.document.write('<html>');
            a.document.write('<head>');
            a.document.write('<link rel="stylesheet" href="css/facture.css"/>');
            a.document.write('</link>');
            a.document.write('<body>');
                a.document.write('<div style="display:flex; align-items:center; flex-direction:column; justify-content:center">')
                for(let i=0 ; i<8 ; i ++){
                    a.document.write(codeBarre);    
                    a.document.write(codeNumber);  
                    a.document.write("<p style='margin-bottom:3px'>")  
                }
            a.document.write('</body></head>');
            a.print();   
            a.document.close();
            });
        
        window.addEventListener("mesureOpenModal", () => {
            $("#deleteUnite").modal("show")
        });
        window.addEventListener("closeMesureModal", () => {
            $("#deleteUnite").modal("hide")
        });
        window.addEventListener("OpenModaleditclient", () => {
            $("#delClient").modal("show")
        });
        window.addEventListener("OpenModaldeleteFournisseur", () => {
            $("#delfournisseur").modal("show")
        });
        window.addEventListener("CloseModaldeleteFournisseur", () => {
            $("#delfournisseur").modal("hide")
        });
        window.addEventListener("openModalDepensedelete", () => {
            $("#deldepense").modal("show")
        });
        window.addEventListener("closeModalDepensedelete", () => {
            $("#deldepense").modal("hide")
        });
        window.addEventListener("closedelClientModal", () => {
            $("#delClient").modal("hide")
        });
        window.addEventListener("downloadModal", () => {
            printDiv("staticBackdrop");
        });
        window.livewire.on('afterprint', () => {
            window.livewire.emit("downloadismiss");
        })
        window.addEventListener("downloadismiss", () => {
            $("#staticBackdrop").modal("hide");
        });
        $(document).ready(function() {
            $("#barre_code_search").focus()
        })
    </script>
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>

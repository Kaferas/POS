@extends("welcome")

@section("content")
    <div class="col-md-12 form-group d-flex mt-3 mb-4">
        <div class="input-group " style="line-height:40px">
            <span class="input-group-addon text-uppercase text-success">Type de Rapport: </span>
            <select name="" id="" class="form-control col-md-5">
                <option value="">Rapport de vente</option>
                <option value="">Rapport Articles</option>
                <option value="">Situation Caisse</option>
            </select>
        </div>
        <div class="input-group" style="line-height:40px">
            <span class="input-group-addon text-uppercase text-success">Date de Depart: </span>
            <input type="date" name="" id="" class="form-control col-md-5" style="border-radius: 5px">
        </div>
        <div class="input-group">
            <span class="input-group-addon text-uppercase text-success" style="line-height:40px">Date de Fin :</span>
            <input type="date" name="" id="" class="form-control col-md-5" style="border-radius: 5px">
        </div>
        <div class=" col-md-2 d-flex justify-content-around">
            <button class="btn btn-sm btn-outline-primary"><i class="fa fa-undo text text-primary"></i>&nbsp;Charger</button>
            <button class="btn btn-sm  btn-outline-success"><i class="fa fa-print text text-success"></i> &nbsp;Imprimer</button>
        </div>
    </div>
    <div class="col-md-12 table mt-3">
        <table class="table-responsive">
            <thead class="col-md-12">
                <th>No</th>
                <th>Date</th>
                <th>Piece</th>
                <th>Client</th>
                <th>Description</th>
                <th>Entree</th>
                <th>Sortie</th>
                <th>Soldes</th>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
@extends("layouts.template")


@section("title")
    Acceuil
@endsection

@section("content")


<div class=" row col-12">
    <div class="col-5 d-flex justify-content-start">
         <h3>
          Listes des Eleves
         </h3>
    </div>
         <div class="col-7 d-flex justify-content-end">
            <button type="button" class="btn btn-primary mr-3 col-md-4 col-sm-5" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" >New Student</button>
           <div class="upload-btn-wrapper">
            <form action="{{ route('import') }}" method="post">
                <button class="btn">Import from Excel</button>
            <input type="file" name="myfile" />
            </form>
            </div>
         </div>
 </div>
    <livewire:student/>
@endsection


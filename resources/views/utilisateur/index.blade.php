@extends("welcome")

@section("content")
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Utilisateur</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Products</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Categorie</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="unity-tab" data-toggle="tab" href="#unity" role="tab" aria-controls="unity" aria-selected="false">Unite de Mesure</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">

  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <livewire:utilisateur />
  </div>

  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <livewire:produits/>
  </div>

  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <livewire:categories />
  </div>
  <div class="tab-pane fade" id="unity" role="tabpanel" aria-labelledby="unity-tab">
        <livewire:unite-mesure />
  </div>

</div>
@endsection

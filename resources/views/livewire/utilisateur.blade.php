    <div class="container mt-4">
        <div class="col-md-12">
        @if(session()->has("message"))
                <div class="alert alert-success col-6 left">
                    {{ session("message") }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="btn-group">
                            <input type="text" class="search form-control border-info mb-3" placeholder="Search User Here !!!">
                        </div>
                        <div class="card-header">
                            <h5 style="float:left;font-weight:bold">Ajouter Utilisateur</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-left text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>@if($user->is_admin==1) <span class='text text-danger'>Admin</span> @else <span class='text text-success'> Cashier </span> @endif</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-warning mr-2" wire:click="selectItem({{$user->id}},'edit')">Editer</button>
                                                    <button class="btn btn-danger mr-2" wire:click="selectItem({{$user->id}},'delete')">Supprimer</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal For Editing User -->

                                    <div class="modal fade" id="eraseUser" tabindex="-1" role="dialog" aria-labelledby="eraseUser" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="eraseUser">Supprimer Utilisateur ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>

                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><h3>Etes-vous sur de ouloir Supprimer ?</h3></p>
                                                        <button class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                        <button class="btn btn-danger" wire:click="delUser">Oui</button>
                                                    <div>
                                                </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
               @if($edition)
               <div class="col-md-4 ">
                    <div class="card ">
                            <div class="card-header border-danger">
                            <h4 class="text-danger">Edit User</h4>
                            </div>
                            <div class="card-body">
                            <form  wire:submit.prevent="save" >

                                <div class="form-group">
                                    <label for="" class="text-primary">Username:</label>
                                    <input type="text" name="name" class="form-control border-dark" value="" wire:model="name">
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Email:</label>
                                    <input type="email" name="email" class="form-control  border-dark" value="" wire:model="email">
                                    @error('email')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Phone:</label>
                                    <input type="number" name="phone" class="form-control  border-dark" value="" wire:model="phone">
                                    @error('phone')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- <div class="form-group">
                                    <label for="" class="text-primary">Password:</label>
                                    <input type="password" name="password" class="form-control  border-dark" value="">
                                    @error('password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Confirmed Password:</label>
                                    <input type="password" name="confirmed_password" class="form-control  border-dark" value="">

                                </div> -->
                                <div class="form-group">
                                    <label for="" class="text-primary">Role:</label>
                                    <select name="is_admin" id="" class="form-control  border-dark" wire:model="admin">
                                        <option value="">---Choose Role---</option>
                                       <option value="1" @if($admin==1) selected @endif>Admin</option>
                                       <option value="2" @if($admin==2) selected @endif >Cashier</option>
                                        <!-- <option value=""></option> -->
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info col-12">Update User</button>
                                </div>
                            </form>
                            </div>
                        </div>
                </div>
                @else
                    <div class="col-md-4 ">
                        <div class="card">
                            <div class="card-header border-primary">
                                <h4 class="text text-primary">Add User</h4>
                            </div>
                            <div class="card-body">
                            <form action="" wire:submit.prevent="save">
                                    <div class="form-group">
                                        <label for="" class="text-primary">Username:</label>
                                        <input type="text" name="name" class="form-control " value="" wire:model="name">
                                        @error('name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-primary">Email:</label>
                                        <input type="email" name="email" class="form-control " value="" wire:model="email">
                                        @error('email')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-primary">Phone:</label>
                                        <input type="number" name="phone" class="form-control " value="" wire:model="phone">
                                        @error('phone')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-primary">Mot de Passe:</label>
                                        <input type="password" name="password" class="form-control " value="" wire:model="password">
                                        @error('password')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-primary">Confirmer Mot de Passe:</label>
                                        <input type="password" name="confirmed_password" class="form-control" value="">

                                    </div>
                                    <div class="form-group">
                                        <label for="" class="text-primary">Role:</label>
                                        <select name="is_admin"  id="" class="form-control" wire:model="admin">
                                            <option value="">---Choisissez le Role---</option>
                                                <option value="1" >Admin</option>
                                                <option selected value="2" >Cashier</option>
                                        </select>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info col-12">Add New User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
               @endif
            </div>
        </div>
    </div>

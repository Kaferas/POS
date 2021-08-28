<div class="container mt-4">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-4">
                    <div class="card">
                            <div class="card-header">
                            <h4>New User</h4>
                            </div>
                            <div class="card-body">
                            <form action="" >
                                                                
                                <div class="form-group">
                                    <label for="" class="text-primary">Nom:</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="">
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Email:</label>
                                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="">
                                    @error('email')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Phone:</label>
                                    <input type="number" name="phone" class="form-control " value="">
                                    @error('phone')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Password:</label>
                                    <input type="password" name="password" class="form-control " value="">
                                    @error('password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Confirmed Password:</label>
                                    <input type="password" name="confirmed_password" class="form-control" value="">
                                
                                </div>
                                <div class="form-group">
                                    <label for="" class="text-primary">Role:</label>
                                    <select name="is_admin" id="" class="form-control">
                                        
                                            <option value="1" selected>Admin</option>
                                            <option value="2" >Cashier</option>
                                        <!-- <option value=""></option> -->
                                        
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info col-12">Save User</button>
                                </div>
                            </form>   
                            </div>
                        </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="btn-group">
                            <input type="text" class="search form-control border-info mb-3" placeholder="Search User Here !!!">
                        </div>
                        <div class="card-header">
                            <h5 style="float:left;font-weight:bold">ADD USER</h5>
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

                                    <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                       
                                            <td>
                                                                                              
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editUser">Edit</a>
                                                    <a href="" class="btn btn-primary mr-2" data-toggle="modal" data-target="#delUser">Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal For Editing User -->

                                        <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger" id="exampleModalScrollableTitle">Edit User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" >
                                                                
                                                                <div class="form-group">
                                                                    <label for="" class="text-primary">Nom:</label>
                                                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="">
                                                                    @error('name')
                                                                        <span class="text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="text-primary">Email:</label>
                                                                    <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" value="">
                                                                    @error('email')
                                                                        <span class="text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="text-primary">Phone:</label>
                                                                    <input type="number" name="phone" class="form-control " value="">
                                                                    @error('phone')
                                                                        <span class="text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="text-primary">Password:</label>
                                                                    <input type="password" name="password" class="form-control " value="">
                                                                    @error('password')
                                                                        <span class="text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="text-primary">Confirmed Password:</label>
                                                                    <input type="password" name="confirmed_password" class="form-control" value="">
                                                                
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="text-primary">Role:</label>
                                                                    <select name="is_admin" id="" class="form-control">
                                                                       
                                                                            <option value="1" selected>Admin</option>
                                                                            <option value="2" >Cashier</option>
                                                                        <!-- <option value=""></option> -->
                                                                        
                                                                    </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-warning col-12">Update User</button>
                                                                </div>
                                                            </form>   
                                                        <div>
                                                    </div>
                                            </div>
                                        </div>

                                      <section>
                                      <div class="modal fade" id="delUser" tabindex="-1" role="dialog" aria-labelledby="example" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-danger" id="exampleModalScrollableTitle">Edit User</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="">
                                                          
                                                                    <p><h3>Are you sure to delete <span class="text-danger"></span> </h3></p>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger">Update User</button>
                                                                </div>
                                                            </form>   
                                                        <div>
                                                    </div>
                                            </div>
                                        </div>  
                                      </section>
                            
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
</div>

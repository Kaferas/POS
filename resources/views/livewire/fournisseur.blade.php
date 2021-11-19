<div class="container mt-4 border p-4">
    <figcaption class="col-md-12 border-secondary">
        <h2 class="text text-secondary">New Supplier</h2>
        <form action="" method="POST" action="multipart/form-data" >
            <div class="row col-12">
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">Company Name:</label>
                    <input type="text" name="" id="" class="form-control col-lg-12 border-secondary" wire:model="company_name">
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">First Name:</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary" wire:model="firstname">
                </div>
                <div class="form-group mr-3 p-2">
                    <label for="" class="text text-primary">Last Name:</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary" wire:model="lastname">
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Email</label>
                    <input type="email" name="" id="" class="form-control col-12 border-secondary" wire:model="email">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Phone Number</label>
                    <input type="number" name="" id="" class="form-control col-12 border-secondary" wire:model="phone">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Avatar:</label>
                    <input type="file" name="" id="" class="form-control col-12 border-secondary" wire:model="avatar">
                </div>
            </div>
            <div class="row col-12">
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Adress 1</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Adress 2</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Country</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
                <div class="form-group mr-3 p-1">
                    <label for="" class="text text-primary">Town</label>
                    <input type="text" name="" id="" class="form-control col-12 border-secondary">
                </div>
            </div>
            <div class="row col-12">
                <button type="submit" class="btn btn-success col-md-3">Submit</button>
            </div>
        </form>
    </figcaption>
</div>

<div>
    <div class="col-md-10">
        <div >
            <h4 class="text text-primary"><i>Option du Rapport</i></h4>
        </div>
        <form action="">
            <div class="form-group">
            <label for="">Rang Date:</label>
            <select name="" id="" class="form-control" wire:model="range" wire:change="grabRange">
                <option value="{{ date("d-m-Y") }}">Today</option>
                <option value="{{ $yesterday  }}">Yesterday</option>
                <option value="customer" >Custom</option>
            
            </select>
        </div>
        @if ($range == "customer")
            <div class="form-group">
                <label>Du:</label>
                <input type="date" name="" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Au:</label>
                <input type="date" name="" id="" class="form-control">
            </div>
        @endif
        <div class="form-group">
            <label for="">Type Vente</label>
            <select name="" id="" class="form-control">
                <option value="">Vente</option>
                <option value="">Retourner</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Rechercher" class="btn btn-sm btn-primary">
        </div>  
        </form>
    </div>
</div>
<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\User;

class Utilisateur extends Component
{

    public $edition=false;
    public $user_id;
    public $action;
    public $name;
    public $email;
    public $phone;
    public $admin;
    public $password;

    protected $listeners=[
        'refresh'
    ];

    public function selectItem($id,$action)
    {
        $this->user_id=$id;
        $this->action=$action;
        if($action=="edit")
        {
            $this->edition=true;
            $user_edition=User::find($id);
            $this->name=$user_edition->name;
            $this->email=$user_edition->email;
            $this->password=$user_edition->password;
            $this->phone=$user_edition->phone;
            $this->admin=$user_edition->is_admin;
     
        }
        if($action=="delete")
        {
            $this->dispatchBrowserEvent("eraseUser");
        }
    }
    public function delUser()
     {
         User::destroy($this->user_id);
         $this->dispatchBrowserEvent("eraseUserClose");

     }
    public function refresh()
    {
        sleep(3);
        $this->name=null;
        $this->password=null;
        $this->email=null;
        $this->phone=null;
        $this->admin=null;
    }

    public function userIn()
    {
        $this->dispatchBrowserEvent("modalUser");
        $this->user_id=null;
    }
    
    public function save()
    {
        $this->validate([
            'name'=>"required",
            "email"=>"required|email",
            "phone"=>"required|integer",
            "admin"=>"required"
        ]);
    $data=[
        'name'=> $this->name,
        'email'=>$this->email,
        'phone'=>$this->phone,
        'is_admin'=>$this->admin,
        'password'=>$this->password
    ];
          if($this->user_id)
          {
            User::find($this->user_id)->update($data);            
            $this->edition=false;
            $this->emit("refresh");
            $this->edition=false;
            session()->flash("message","User Updated Well");
            $this->user_id=null;
        }
        else{
            User::create($data);
            $this->emit("refresh");
            session()->flash("message","User Created Well");
            // dd($data);
        }

    }
    public function render()
    {
        $users=User::paginate(5);
        return view('livewire.utilisateur',[
            "users"=> $users
        ]);
    }
}

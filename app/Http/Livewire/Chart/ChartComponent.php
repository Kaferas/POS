<?php

namespace App\Http\Livewire\Chart;

use App\Models\Produit;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ChartComponent extends Component
{
    public $myData = [];
    public $bestClientsName=[];
    public $bestClientsChiffre=[];

    public function mount(){
    }


    private function chiffreAffaire(){
        $start = date('Y-01-01');
        $end = date('Y-12-31');
        $query=DB::table('commande_details')->selectRaw("DATE_FORMAT(created_at,'%m') as created_at")->selectRaw('sum(total) as sales')->where("created_at",'>=',$start)->where("created_at",'<=',$end)->groupBy('created_at')->get();
        $data = [];
        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        foreach($query as $value) {
            $data[intVal($value->created_at)] = intVal($value->sales);
          }
          
          foreach ($months as $month) {
            if (!array_key_exists(intVal($month), $data)) {
              $data[intVal($month)] = 0;
            }
          }
          ksort($data);
          return array_values($data);
    }


    private function chiffreVsDepense(){
      $start = date('Y-01-01');
      $end = date('Y-12-31');
      
      $query=DB::table('commande_details')->selectRaw("DATE_FORMAT(created_at,'%m') as created_at")->selectRaw('sum(total) as sales')->where("created_at",'>=',$start)->where("created_at",'<=',$end)->groupBy('created_at')->get();

      $depenses_query=DB::table('depenses')->selectRaw("DATE_FORMAT(created_at,'%m') as created_at")->selectRaw("sum(total) as depenses")->where("created_at",'>=',$start)->where("created_at",'<=',$end)->groupBy('created_at')->get();
      
      $data = [];
      $depenses = [];
      $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
      foreach($query as $value) {
          $data[intVal($value->created_at)] = intVal($value->sales);
        }

      foreach($depenses_query as $value) {
          $depenses[intVal($value->created_at)] = intVal($value->depenses);
        }
  
        
        foreach ($months as $month) {
          if (!array_key_exists(intVal($month), $data)) {
            $data[intVal($month)] = 0;
          }
        }

        foreach ($months as $month) {
          if (!array_key_exists(intVal($month), $depenses)) {
            $depenses[intVal($month)] = 0;
          }
        }
      
        ksort($data);
        ksort($depenses);
        return ['affaires'=>array_values($data),'depenses'=>array_values($depenses)];
    }


    private function topTenProducts(){
      $query=DB::table('commande_details')->selectRaw('distinct(produit_id)')->selectRaw("count(*) as nbre_article")->groupBy('produit_id')->orderByRaw('nbre_article DESC')->get();
      $articles=$query;
      $out=[];
      $name=[];
      $quantity=[];
      foreach($query as $k => $product){
        $data=Produit::where('id',$product->produit_id)->select('nom_produit')->get();
        $out[$k]=[$data[0]->nom_produit,$articles[$k]->nbre_article];
      }
      foreach($out as $single){
        array_push($name,$single[0]);
        array_push($quantity,$single[1]);
      }
      return ['names'=>array_values($name),'quantity'=>array_values($quantity)];
    }

    public function render()
    {
        $data=[103,45,2,5,65];

        $bestClients= DB::table("transactions")
                        ->join('clients','transactions.clientId','=','clients.id')
                        ->select('Customer_name',DB::raw("sum(montant_payer-montant_restant) as Total"))
                        ->groupBy("Customer_name")
                        ->get();
        foreach($bestClients as $single){
            array_push($this->bestClientsName,$single->Customer_name);
            array_push($this->bestClientsChiffre,$single->Total);
        }

        return view('livewire.chart.chart-component',[
            'bestClientsName'=>$this->bestClientsName,
            'bestClientsChiffre'=>$this->bestClientsChiffre,
            'chifffre'=>$this->chiffreAffaire(),
            'chiffrevsdepense'=>$this->chiffreVsDepense(),
            'topTenProducts'=>$this->topTenProducts()
        ]);
    }
}

<div>
    {{-- The best athlete wants his opponent at his best. --}}
<div class="row ">
    <div class="col-md-12 mt-4">
        <div class="d-flex justify-content-around col-md-12">
            <div class="col-md-4 ">
                <p class="h4 text text-center text-primary pb-3">Top 10 Clients par Facture</p>
                <canvas id="myChart" width="600" height="300"></canvas>  
            </div>
            <div class="col-md-5">
                <p class="h4 text text-center text-primary pb-3">Chiffres d'Affaire (en FBU)</p>
                <canvas id="my1Chart" width="400" height="300"></canvas>  
            </div>
        </div>
        <div class="col-md-12 mt-4 ">
            <div class="d-flex justify-content-around col-md-12">
                <div class="col-md-4">
                    <p class="h4 text text-center text-primary pb-3">Chiffres d'Affaire Vs Depenses</p>
                    <canvas id="my3Chart" width="400" height="400"></canvas>  
                </div>
                <div class="col-md-5">
                    <p class="h4 text text-center text-primary pb-3">Top 10 Meuilleur Produits</p>
                    <canvas id="my2Chart" width="300" height="400"></canvas>  
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const ctx1 = document.getElementById('my1Chart').getContext('2d');
const ctx2 = document.getElementById('my2Chart').getContext('2d');
const ctx3 = document.getElementById('my3Chart').getContext('2d');
let x = @json($line);
let chiffreAffaire= @json($chifffre);
let bestClientsName= @json($bestClientsName);
let bestClientsChiffre= @json($bestClientsChiffre);
let chiffrevsDepense=@json($chiffrevsdepense);
let topTenProducts= @json($topTenProducts);
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: bestClientsName,
        datasets: [{
            label: '# of Votes',
            data: bestClientsChiffre,
            backgroundColor: [
                'rgba(255, 9, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
const myChart1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels:  ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            label: 'Chiffres d\'affaires Mensuel',
            data: chiffreAffaire,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
const myChart2 = new Chart(ctx2, {
    type: 'polarArea',
    data: {
        labels: topTenProducts.names,
        datasets: [{
            label: 'TOP TEN PRODUCTS',
            data: topTenProducts.quantity,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgb(75, 192, 192)',
                'rgb(75, 192, 192)',
                'rgb(75, 192, 192)',
                'rgb(75, 192, 192)',
                'rgb(75, 192, 192)',
                'rgb(75, 192, 192)'
            ],
            borderWidth: 1,
            tension:0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
const myChart3 = new Chart(ctx3, {
    data: {
        datasets: [{
            type: 'bar',
            label: 'Depenses',
            data : chiffrevsDepense.depenses,
            borderColor: 'rgb(255, 99, 132)',
             backgroundColor: 'rgba(75, 200, 255, 0.6)'
            }, 
            {
                type: 'bar',
                label: 'Chiffre Affaire',
                data:chiffrevsDepense.affaires,
                backgroundColor: 'rgba(255, 99, 132,10)',
            borderColor: 'rgb(54, 162, 235)'
        }],
        labels: ['Jan', 'Febr', 'Mar', 'Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
 


</div>


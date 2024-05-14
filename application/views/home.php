
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

  <!--Start Dashboard Content-->
<div class="row">
	<div class="card mt-3" style="margin:20px;">
    <div class="card-content">

        <div class="row row-group m-0">
          
        <?php foreach($somme_total_devis_existant as $tt){ ?>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body" style="width: 550px;">
                <i class="fa fa-money"></i>
                  <h1 class="text" style="color: #ffd400;" > <span class="float-left"><i class="zmdi zmdi-long-arrow-up"></i>  <?php echo number_format($tt->somme_totale,2). 'Ar' ;?></span></h1>
                   <br> 
                   <br>
                   <br>
                  <p class="mb-0 text-white small-font"> Montant total des devis <span class="float-right"></span></p>
                </div>
                
            </div>
            <?php }?>
        </div>

    </div>
    
 </div>  
 <div class="card mt-3" style="margin:20px;">
    <div class="card-content">

        <div class="row row-group m-0">
          
        <?php foreach($getTotalMontantPayé as $tt){ ?>
            <div class="col-12 col-lg-6 col-xl-3 border-light">
                <div class="card-body" style="width: 550px;">
                <i class="fa fa-money"></i>
                  <h1 class="text" style="color: #ffd400;" > <span class="float-left"><i class="zmdi zmdi-long-arrow-up"></i>  <?php echo number_format($tt['total_paye'],2). 'Ar' ;?></span></h1>
                   <br> 
                    <br>
                    <br>
                  <p class="mb-0 text-white small-font"> Montant total des payements effectué <span class="float-right"></span></p>
                </div>
                
            </div>
            <?php }?>
        </div>

    </div>
    
 </div>  
 </div>
	<div class="row">
     <div class="col-12 col-lg-8 col-xl-8" >
	    <div class="card">
		 <div class="card-header">Griphique devis 
		   <div class="card-action">
			 <div class="dropdown">
			 <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
			  <i class="icon-options"></i>
			 </a>
				<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="javascript:void();">Action</a>
				<a class="dropdown-item" href="javascript:void();">Another action</a>
				<a class="dropdown-item" href="javascript:void();">Something else here</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="javascript:void();">Separated link</a>
			   </div>
			  </div>
		   </div>
		 </div>
		 <div class="card-body">
		    <ul class="list-inline">
			  <!-- <li class="list-inline-item"><i class="fa fa-circle mr-2 text-white"></i>New Visitor</li>
			  <li class="list-inline-item"><i class="fa fa-circle mr-2 text-light"></i>Old Visitor</li> -->
			</ul>
			<div class="chart-container-1" style="height:700px;">
      
      <!-- <?php var_dump($donnees_par_annee)?> -->
      <select class="form-group" id="selectYear">
    <?php 
    // Obtenir uniquement les années distinctes
    $annees_distinctes = array_unique(array_column($donnees_par_annee, 'annee'));
    
    // Générer les options pour chaque année distincte
    foreach ($annees_distinctes as $annee): 
    ?>
        <option value="<?= $annee ?>"><?= $annee ?></option>
    <?php endforeach; ?>
</select>

<canvas id="lineChart"></canvas>

<script src="<?=base_url('assets/js/chart.min.js')?>"></script>
<script>
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart;

    // Fonction pour initialiser le graphique avec les données fournies
    function initLineChart(data) {
        lineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($mois) ?>,
                datasets: [{
                    label: 'Devis par mois',
                    data: data,
                    borderColor: 'yellow',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Démarre l'axe Y à zéro
                    }
                }
            }
        });
    }

    // Initialisation du graphique avec les données initiales
    initLineChart(<?= json_encode(array_column($donnees_par_annee, 'somme_nouveau_prix_total')) ?>);

    // Écouteur d'événements pour détecter le changement d'année sélectionnée
    document.getElementById('selectYear').addEventListener('change', function() {
        var selectedYear = this.value;
        var selectedData = []; // Les données correspondant à l'année sélectionnée

        // Récupérer les données correspondant à l'année sélectionnée
        <?php foreach ($donnees_par_annee as $annee_data): ?>
            if ('<?= $annee_data['annee'] ?>' === selectedYear) {
                selectedData.push(<?= json_encode($annee_data['somme_nouveau_prix_total']) ?>);
            }
        <?php endforeach; ?>

        // Mettre à jour les données du graphique
        lineChart.data.datasets[0].data = selectedData;
        lineChart.update();
    });
</script>

       
			</div>
		 </div>
		
		</div>
	 </div>


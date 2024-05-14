
<div class="clearfix">

</div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
     
    <!-- <div class="row">
      <div class="col-lg-12">
        <a href="<?php echo base_url("Controller/resetData"); ?>" class="btn btn-danger">Réinitialiser les données</a>
      </div>
    </div> -->
<br>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">LISTE DES PAYEMEMT</h5>
			  <div class="table-responsive">

              <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
            <?php endif; ?>

              <table class="table table-hover">
                <thead>
                  <tr  style="color: #ffd400;">
                    <th scope="col">Devis</th>
                    <th scope="col">Client</th>
                    <th scope="col">Prix total</th>
                    <th scope="col">Montant payé</th>
                    <th scope="col">Reste a payer</th>
                    <th scope="col">Payement effectué</th>

                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                <?php foreach($payement_ajour_restant_payer as $tt): ?>
                    <?php
                        // Calcul du pourcentage de paiement
                        $pourcentage_payé = ($tt->montant_payé / $tt->nouveau_prix_total) * 100;
                        
                        // Déterminer la couleur en fonction du pourcentage
                        if ($pourcentage_payé < 25) {
                            $couleur = 'red'; // Rouge pour les pourcentages inférieurs à 25%
                        } elseif ($pourcentage_payé < 50) {
                            $couleur = 'orange'; // Orange pour les pourcentages entre 25% et 50%
                        } elseif ($pourcentage_payé < 75) {
                            $couleur = 'yellow'; // Jaune pour les pourcentages entre 50% et 75%
                        } else {
                            $couleur = 'green'; // Vert pour les pourcentages supérieurs à 75%
                        }
                    ?>

                    <tr>
                        <th>Devis <?php echo $tt->id_demande ;?></th>
                        <th><?php echo $tt->nom_utilisateur ;?></th>
                        <td><?php echo number_format($tt->nouveau_prix_total, 2). 'Ar';?></td>
                        <td><?php echo number_format($tt->montant_payé, 2). 'Ar';?></td>
                        <td>
                            <p style="display:flex; justify-content:center; font-weight:bolder; background-color:#ffd400; padding:10px; color:black; border-radius:5px;">
                                <?php echo number_format($tt->montant_restant, 2). 'Ar';?>
                            </p>
                        </td>
                        <td>
                            <p style="display:flex; justify-content:center; font-weight:bolder; background-color:<?php echo $couleur; ?>; padding:10px; color:white; border-radius:5px;">
                                <?php echo number_format($pourcentage_payé, 2). '%';?>
                            </p>
                        </td>
                        <td style="float:right;">
                            <a href="<?= base_url('Controller/details_devis_admin?id=' . $tt->id_demande) ?>" class="btn btn-light btn-round px-5">Voir la liste des travaux à effectuer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>


                 
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>
      </div><!--End Row-->

      
	  
	  <!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
    <script>
    function openPopup(id) {
        document.getElementById('popup' + id).style.display = 'block';
        document.getElementById('id').value = id;
    }   

    function payement(id) {
        var payement = document.getElementById('payement' + id).value;
        var date_payement = document.getElementById('date_payement' + id).value;
        var baseUrl = "<?php echo base_url('Controller/payement_devis/'); ?>";

        // Rediriger vers la fonction payementbillet avec l'ID de la vente et le montant du paiement
        window.location.href = baseUrl + '/' + id + '/' + payement + '/' + date_payement + '/' ;
    }
</script>
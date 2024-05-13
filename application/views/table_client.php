
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
              <h5 class="card-title">Devis</h5>
			  <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr  style="color: #ffd400;">
                    <th scope="col">Maison</th>
                    <th scope="col">Finition</th>
                    <th scope="col">Date debut</th>
                    <th scope="col">Date fin</th>
                    <th scope="col">Reste a payer</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                <?php foreach($demande_maison_finition_client as $tt){ ?>
                  <tr>
                    <th><?php echo $tt->nom_maison;?></th>
                    <td><?php echo $tt->designation;?></td>
                    <td><?php echo $tt->date_debut;?></td>
                    <td><?php echo $tt->date_fin;?></td>
                    <td><?php echo number_format($tt->nouveau_prix_total,2).'Ar';?> </td>
                    <td style="float:right;">
                      <a href="#" onclick="openPopup(<?= $tt->id ?>)" class="btn btn-light btn-round px-5">Payer</a>
                        <br>
                      <div id="popup<?= $tt->id ?>" style="display: none;border: 1px solid white; border-radius:10px ;padding:10px; margin:20px;">
                        <h2>Entrez le prix à payer</h2>
                        <p>Montant :</p>
                        <input class="form-control form-control-rounded" type="text" id="payement<?= $tt->id ?>" placeholder="Montant"> 
                        <br>
                        <p>Entrez la date :</p>
                        <input class="form-control form-control-rounded" type="date" id="date_payement<?= $tt->id ?>" placeholder="Date de payement"> 
                        <br>
                        <button style="background-color:#ffd400;" class="btn btn-light btn-round px-5" onclick="payement(<?= $tt->id ?>)">Envoyer</button>
                    </div>
                        <br>
                      <a style="background-color: red; border:none;" href="<?= base_url('Controller/details_devis_user?id=' . $tt->id) ?>" class="btn btn-light btn-round px-5">Voir détails du Devis</a>
                    </td>
                  </tr>
                  <?php }?>
                 
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
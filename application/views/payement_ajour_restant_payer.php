
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
              <h5 class="card-title">PAYEMEMT</h5>
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
                    <th scope="col">Prix total</th>
                    <th scope="col">Montant payé</th>
                    <th scope="col">Reste a payer</th>
                    <th scope="col">Action</th>

                  </tr>
                </thead>
                <tbody>
                <?php foreach($payement_ajour_restant_payer as $tt){ ?>
                  <tr>
                    <th><?php echo $tt->id_demande ;?></th>
                    <td><?php echo number_format($tt->somme_prix_total,2). 'Ar';?></td>
                    <td><?php echo number_format($tt->montant_payé,2). 'Ar';?></td>
                    <td ><p style=" display:flex;justify-content:center; font-weight:bolder; background-color:#ffd400;padding:10px; color:black; border-radius:5px;"><?php echo number_format($tt->montant_restant,2). 'Ar';?></p></td>
                    <td style="float:right;">
                      <a href="#" onclick="openPopup(<?= $tt->id_demande ?>)" class="btn btn-light btn-round px-5">Payer</a>
                        <br>
                      <div id="popup<?= $tt->id_demande ?>" style="display: none;border: 1px solid white; border-radius:10px ;padding:10px; margin:20px;">
                        <h2>Entrez le prix à payer</h2>
                        <p>Montant :</p>
                        <input class="form-control form-control-rounded" type="text" id="payement<?= $tt->id_demande ?>" placeholder="Montant"> 
                        <br>
                        <p>Entrez la date :</p>
                        <input class="form-control form-control-rounded" type="date" id="date_payement<?= $tt->id_demande ?>" placeholder="Date de payement"> 
                        <br>
                        <button style="background-color:#ffd400;" class="btn btn-light btn-round px-5" onclick="payement(<?= $tt->id_demande ?>)">Envoyer</button>
                    </div>
                    <br>
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
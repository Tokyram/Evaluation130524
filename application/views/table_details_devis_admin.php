<?php
  $user = $this->session->userdata('utilisateur');
  $user2 = $this->session->userdata('administrateur');

  if ($user ) {
      echo 'Nom d\'utilisateur : ' . $user['nom'];
  } elseif($user2) {
      echo 'Nom d\'utilisateur : ' . $user2['nom'];
  }else{
      echo "Aucun utilisateur connecté.";
  }

  
?>

<div class="clearfix">

</div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
     

<br>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Details Devis</h5> 
			  <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr  style="color: #ffd400;">
                    <th scope="col">Travaux</th>
                    <th scope="col">Unite</th>
                    <th scope="col">Quantite</th>
                    <th scope="col">Prix_unitaire</th>
                    <th scope="col">Prix Total</th>

                  </tr>
                </thead>
                <tbody>
                <?php foreach($details_devis as $tt){ ?>
                  <tr>
                    <th><?php echo $tt->designation_travaux;?></th>
                    <td><?php echo $tt->unite_travaux;?></td>
                    <td><?php echo $tt->quantite_detail_devis;?></td>
                    <td><?php echo  number_format($tt->prix_unitaire_detail_devis,2). 'Ar';?></td>
                    <td><?php echo number_format($tt->prix_total_detail_devis,2). 'Ar';?> </td>
                   
                    
                  </tr>


                 
                 
                  <?php }?>
                </tbody>
              </table>
            </div>
            <h2 class="float-right" style="margin-right:100px; margin-top:50px">
                <p>Total : <small class="text"><?php echo number_format($tt->nouveau_prix_total_devis,2). 'Ar';?> </small></p>
            </h2>
            <div class="row">
            <div class="col-lg-12">
            
                    
          



            </div>
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
	


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
                <?php foreach($devis_client as $tt){ ?>
                  <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="float:right;">
                      <a href="<?= base_url('Controller/payement_devis_user?id=' . $tt->id) ?>" class="btn btn-light btn-round px-5"><i class="icon-note"></i></a>
                    
                      <a style="background-color: red; border:none;" href="<?= base_url('Controller/details_devis_user/' .$tt->id) ?>" class="btn btn-light btn-round px-5">Supprimer</i></a>
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
	

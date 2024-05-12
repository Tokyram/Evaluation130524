
<div class="clearfix">

</div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
     
    <div class="row">
      <div class="col-lg-12">
        <a href="<?php echo base_url("Controller/resetData"); ?>" class="btn btn-danger">Réinitialiser les données</a>
      </div>
    </div>
<br>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Travaux preparatoire</h5>
			  <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr style="color: #ffd400;">
                    <th scope="col">Identifiant</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Unité</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($travaux_p as $tt){ ?>
                  <tr>
                    <th><?php echo $tt->id_travaux;?></th>
                    <td><?php echo $tt->designation_travaux;?></td>
                    <td><?php echo $tt->designation_unite;?></td>
                    <td><?php echo $tt->prix_unitaire;?></td>
                    <td style="float:right;">
                      <a href="<?= base_url('Controller/modification?id=' . $tt->id_travaux) ?>" class="btn btn-light btn-round px-5"><i class="icon-note"></i></a>
                    
                      <a style="background-color: red; border:none;" href="<?= base_url('Controller/supprimer/' .$tt->id_travaux) ?>" class="btn btn-light btn-round px-5">Supprimer</i></a>
                    </td>
                  
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Travaux terrassement</h5>
			  <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr  style="color: #ffd400;">
                    <th scope="col">Identifiant</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Unité</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col"></th>

                  </tr>
                </thead>
                <tbody>
                <?php foreach($travaux_t as $tt){ ?>
                  <tr>
                    <th><?php echo $tt->id_travaux;?></th>
                    <td><?php echo $tt->designation_travaux;?></td>
                    <td><?php echo $tt->designation_unite;?></td>
                    <td><?php echo $tt->prix_unitaire;?></td>
                    <td style="float:right;">
                      <a href="<?= base_url('Controller/modification?id=' . $tt->id_travaux) ?>" class="btn btn-light btn-round px-5"><i class="icon-note"></i></a>
                    
                      <a style="background-color: red; border:none;" href="<?= base_url('Controller/supprimer/' .$tt->id_travaux) ?>" class="btn btn-light btn-round px-5">Supprimer</i></a>
                    </td>
                  </tr>
                  <?php }?>
                 
                </tbody>
              </table>
            </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Travaux en infrastructure</h5>
			  <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr  style="color: #ffd400;">
                    <th scope="col">Identifiant</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Unité</th>
                    <th scope="col">Prix unitaire</th>
                    <th scope="col"></th>

                  </tr>
                </thead>
                <tbody>
                <?php foreach($travaux_i as $tt){ ?>
                  <tr>
                    <th><?php echo $tt->id_travaux;?></th>
                    <td><?php echo $tt->designation_travaux;?></td>
                    <td><?php echo $tt->designation_unite;?></td>
                    <td><?php echo $tt->prix_unitaire;?></td>
                    <td style="float:right;">
                      <a href="<?= base_url('Controller/modification?id=' . $tt->id_travaux) ?>" class="btn btn-light btn-round px-5"><i class="icon-note"></i></a>
                    
                      <a style="background-color: red; border:none;" href="<?= base_url('Controller/supprimer/' .$tt->id_travaux) ?>" class="btn btn-light btn-round px-5">Supprimer</i></a>
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
	

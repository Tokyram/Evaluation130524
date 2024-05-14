
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
              <h5 class="card-title">Liste Des finition</h5>
			  <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr  style="color: #ffd400;">
                    <th scope="col">Identifiant</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Pourcentage</th>
                    <th scope="col">Modifier</th>

                  </tr>
                </thead>
                <tbody>
                <?php foreach($finition as $tt){ ?>
                  <tr>
                    <th><?php echo $tt->id;?></th>
                    <td><?php echo $tt->designation;?></td>
                    <td><?php echo $tt->pourcentage;?></td>
                    <td style="float:right;">
                      <a href="<?= base_url('Controller/modification_finition?id=' . $tt->id) ?>" class="btn btn-light btn-round px-5"><i class="icon-note"></i></a>
                    
                      <a style="background-color: red; border:none;" href="<?= base_url('Controller/supprimer/' .$tt->id) ?>" class="btn btn-light btn-round px-5">Supprimer</i></a>
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
	

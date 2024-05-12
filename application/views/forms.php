
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

    <div class="row mt-3">
      <!-- <div class="col-lg-6">
         <div class="card">
           <div class="card-body">
           <div class="card-title">Vertical Form</div>
           <hr>
            <form>
           <div class="form-group">
            <label for="input-1">Name</label>
            <input type="text" class="form-control" id="input-1" placeholder="Enter Your Name">
           </div>
           <div class="form-group">
            <label for="input-2">Email</label>
            <input type="text" class="form-control" id="input-2" placeholder="Enter Your Email Address">
           </div>
           <div class="form-group">
            <label for="input-3">Mobile</label>
            <input type="text" class="form-control" id="input-3" placeholder="Enter Your Mobile Number">
           </div>
           <div class="form-group">
            <label for="input-4">Password</label>
            <input type="text" class="form-control" id="input-4" placeholder="Enter Password">
           </div>
           <div class="form-group">
            <label for="input-5">Confirm Password</label>
            <input type="text" class="form-control" id="input-5" placeholder="Confirm Password">
           </div>
           <div class="form-group py-2">
             <div class="icheck-material-white">
            <input type="checkbox" id="user-checkbox1" checked=""/>
            <label for="user-checkbox1">I Agree Terms & Conditions</label>
            </div>
           </div>
           <div class="form-group">
            <button type="submit" class="btn btn-light px-5"><i class="icon-lock"></i> Register</button>
          </div>
          </form>
         </div>
         </div>
      </div> -->

      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
           <div class="card-title">AJOUT DE TYPE DE TRAVAUX</div>
           <hr>
            <form action="<?= base_url("Controller/insertion_type_travaux"); ?>" method="post">
           <div class="form-group">
            <label for="input-6">Type</label>
            <input type="text" name="designation" class="form-control form-control-rounded" id="input-6" placeholder="Entre le type de travaux">
           </div>
           
           <div class="form-group">
            <button type="submit" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Register</button>
          </div>
          </form>
         </div>
         </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
           <div class="card-title">AJOUT DE TRAVAUX</div>
           <hr>
            <form action="<?=base_url("Controller/insertion_travaux");?>" method="post">
                <div class="form-group">
                  <label for="input-6">Type de travaux</label>
                    <select name="id_type_travaux" class="form-control form-control-rounded" id="input-6">
                      <?php foreach($type_travaux as $tt){ ?>
                          <option value="<?php echo $tt->id;?>"><?php echo $tt->designation;?></option>
                      <?php }?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="input-7">Designation du travaux</label>
                    <input type="text" name="designation" class="form-control form-control-rounded" id="input-7" placeholder="Designation">
                </div>

                <div class="form-group">
                  <label for="input-6">Unite de mesure</label>
                    <select name="id_unite" class="form-control form-control-rounded" id="input-6">
                      <?php foreach($unite as $u){ ?>
                          <option value="<?php echo $u->id;?>"><?php echo $u->designation;?></option>
                      <?php }?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="input-7">Prix unitaire</label>
                    <input type="text" name="prix_unitaire" class="form-control form-control-rounded" id="input-7" placeholder="Prix unitaire">
                </div>
        
           <div class="form-group">
            <button type="submit" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Acheter </button>
            </div>
          </form>
         </div>
         </div>
      </div>

      <!-- <div class="col-lg-6">
        <div class="card">
           <div class="card-body">
           <div class="card-title">Importer un fichier csv</div>
           <hr>
            <form action="#" method="post"  enctype="multipart/form-data">

           <div class="form-group">
              <label for="input-7">Importer votre csv</label>
              <input type="file"  name="csv_file" accept=".csv" class="form-control form-control-rounded" id="input-7" placeholder="Nombre de billet">
           </div>
        
           <div class="form-group">
            <button type="submit" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Importer </button>
          </div>
          </form>
         </div>
         </div>
      </div> -->
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
	
	

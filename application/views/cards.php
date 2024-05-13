  
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


   <div class="row" style="margin-top:100px;">
        <div class="col-10" style="margin-left: 300px; overflow-x: none;">
          <h4 class="d-inline">Choisir le type de maison</h4>
          <!-- <p class="text-muted">This is 3 column contents</p> -->
          <div class="row" style="margin-top:50px;">
          <div class="col-md-6 col-lg-3">
          <form action="<?= base_url("Controller/insertion_demande_maison_finition"); ?>" method="post" enctype="multipart/form-data">
          <div style="display:flex; align-items:center; width: 1500px ;height:auto; justify-content:space-between;">
            <?php foreach($devis_maison as $tt){ ?>
                <div class="card">
                    <div class="card-body">
                      <div style="background-color:#ffd400 ; padding : 15px; display:flex;flex-direction:column; border-radius:5px; justify-content:center">
                        <h5 class="card-title"><?php echo $tt->nom_maison;?></h5>
                        <h2 style="font-size:30px; color:#0d2026" class="card-title"><?php echo number_format($tt->somme_prix_total,2).'Ar';?> </h2>
                      </div>
                       
                        <br>
                       
                        <p class="card-text d-inline"><svg xmlns="http://www.w3.org/2000/svg" color="green" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                                      </svg>  Chambre : <small class="text"><?php echo $tt->nombre_chambres;?></small></p> <br>
                        <p class="card-text d-inline"><svg xmlns="http://www.w3.org/2000/svg" color="green" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                                      </svg>  Salon :<small class="text"><?php echo $tt->nombre_salons;?></small></p><br>
                        <p class="card-text d-inline"><svg xmlns="http://www.w3.org/2000/svg" color="green" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                                      </svg>  Cuisine :<small class="text"><?php echo $tt->nombre_cuisines;?></small></p><br>
                        <p class="card-text d-inline"> <svg xmlns="http://www.w3.org/2000/svg" color="green" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                                      </svg> Toilete :<small class="text"><?php echo $tt->nombre_toilettes;?></small></p><br><br>
                        <p class="card-text d-inline"> <svg xmlns="http://www.w3.org/2000/svg" color="green" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0"/>
                                                      </svg> Duree de contruction : <small style="color:#ffd400;" class="text"><?php echo $tt->duree_maison;?> jours</small></p><br>
                                                     
                          
                    </div>
                    <div class="card-footer">
                        
                    <input type="hidden" name="id_maison" value="<?php echo $tt->id_maison; ?>">
                    <!-- Bouton radio pour sélectionner la maison -->
                    <input type="radio" style="width: 30px; height:30px;" name="selected_maison" value="<?php echo $tt->id_maison;?>" class="btn-radio float-right">
                    </div>
                </div>
              <?php }?>
              </div>

              <br>
              <br>
              <br>
              <br>

          <h4 class="d-inline">Choisir le type de finition</h4>
          <br></br>
          <div style="display:flex; align-items:center; width: 1500px ;height:auto; justify-content:space-between;">
          <?php foreach($finition as $tt){ ?>
           
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $tt->designation;?></h5>
                        
                       
                        <p class="card-text d-inline">Augmentation : <small class="text"><?php echo $tt->pourcentage;?> %</small></p> <br>
                       
                    </div>
                    <div class="card-footer">
                        
                    <input type="hidden" name="id_finition" value="<?php echo $tt->id; ?>">
                    <!-- Bouton radio pour sélectionner la finition -->
                    <input type="radio" style="width: 30px; height:30px;" name="selected_finition" value="<?php echo $tt->id;?>" class="btn-radio float-right">
                    </div>
                </div>
              <?php }?>
              </div>

              <br>
              <br>
              <br>
              <br>
              <div class="date" style="display:flex; align-items:center; width: 1000px ;height:auto; justify-content:space-between;">

             
                  <div class="form-group">
                  <h4 class="d-inline">Choisir un date de commencement du projet</h4>
                  <br></br>
                        <input type="date" name="date_debut" class="form-control form-control-rounded" id="input-7">
                  </div>

                  <div class="form-group">
                  <h4 class="d-inline">Choisir un date de Creation devis</h4>
                  <br></br>
                        <input type="date" name="date_creation_devis" class="form-control form-control-rounded" id="input-7">
                  </div>

              </div>
              <br>
              <br>
              <br>
              <br>
            <div class="form-group" >
              <button type="submit" style="width:250px; color:#000000;background-color: #ffd400;" class="btn btn-light btn-round px-5 "><i class="icon-lock"></i> Valider la demande</button>
            </div>
          </form>

          </div>
          </div>
      </div>


	<!--start overlay-->
		  <div class="overlay toggle-menu"></div>
		<!--end overlay-->

    </div>
    <!-- End container-fluid-->
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	

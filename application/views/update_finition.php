
<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

    <div class="row mt-3">
      
    <div class="col-lg-6">
    <div class="card">
        <div class="card-body">
            <div class="card-title" style="color: #ffd400;">Modifier la finition <?php echo $finiton->id; ?></div>
            <hr>
            <form action="<?= base_url("Controller/modifier_finition"); ?>" method="post" enctype="multipart/form-data">
            
                <input type="hidden" name="id" value="<?php echo $finiton->id; ?>">

               
                <div class="form-group">
                    <label for="input-7">Designation du finition</label>
                    <input type="text" value="<?php echo $finiton->designation; ?>" name="finition" class="form-control form-control-rounded" id="input-7">
                </div>

                <div class="form-group">
                    <label for="input-7">Pourcentage</label>
                    <input type="text" value="<?php echo $finiton->pourcentage; ?>" name="pourcentage" class="form-control form-control-rounded" id="input-7">
                </div>
                

                <div class="form-group">
                    <button type="submit" style=" color:#000000;background-color: #ffd400;" class="btn btn-light btn-round px-5"><i class="icon-lock"></i> Register</button>
                </div>
            </form>
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
	
	
    <!-- <script>
      document.addEventListener("DOMContentLoaded", function() {
          document.getElementById("packForm").addEventListener("submit", function(event) {
              event.preventDefault(); // Empêche la soumission du formulaire par défaut
              
              // Créer un objet FormData pour collecter les données du formulaire
              var formData = new FormData(this);
              
              // Créer une nouvelle requête XHR
              var xhr = new XMLHttpRequest();
              
              // Définir le type de requête et l'URL
              xhr.open("POST", this.action, true);
              
              // Définir le gestionnaire d'événement pour la réponse de la requête
              xhr.onload = function() {
                  if (xhr.status === 200) {
                      // Traitement de la réponse du serveur
                      console.log(xhr.responseText);
                      alert('envoie avec success');
                      // Rediriger ou effectuer d'autres actions en fonction de la réponse
                  } else {
                      // Gérer les erreurs
                      console.error("Erreur lors de la requête.");
                  }
              };
              
              // Envoyer la requête avec les données du formulaire
              xhr.send(formData);
          });
      });
</script> -->


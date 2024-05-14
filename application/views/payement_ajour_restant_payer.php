<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PAYEMENT</h5>
                        <div class="table-responsive">
                            <?php if(isset($_GET['error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_GET['error']; ?>
                            </div>
                            <?php endif; ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr style="color: #ffd400;">
                                        <th scope="col">Devis</th>
                                        <th scope="col">Prix total</th>
                                        <th scope="col">Montant payé</th>
                                        <th scope="col">Reste à payer</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($payement_ajour_restant_payer as $tt): ?>
                                    <tr>
                                        <th><?php echo $tt->id_demande ;?></th>
                                        <td><?php echo number_format($tt->somme_prix_total,2). 'Ar';?></td>
                                        <td><?php echo number_format($tt->montant_payé,2). 'Ar';?></td>
                                        <td>
                                            <p style="display:flex; justify-content:center; font-weight:bolder; background-color:#ffd400; padding:10px; color:black; border-radius:5px;">
                                                <?php echo number_format($tt->montant_restant,2). 'Ar';?>
                                            </p>
                                        </td>
                                        <td style="float:right;">
                                            <a href="#" onclick="openPopup(<?php echo $tt->id_demande; ?>)" class="btn btn-light btn-round px-5">Payer</a>
                                            <br>
                                            <div id="popup<?php echo $tt->id_demande; ?>" style="display: none;border: 1px solid white; border-radius:10px ;padding:10px; margin:20px;">

                                            <form action="<?php echo base_url('Controller/payement_devis'); ?>" id="payementForm" method="post" enctype="multipart/form-data">

                                                  <input class="form-control form-control-rounded" value="<?php echo $tt->id_demande; ?>" name="id_demande_maison_finition" type="hidden" id="id_demande_maison_finition" placeholder="Montant"> 

                                                  <h2>Entrez le prix à payer</h2>
                                                  <p>Montant :</p>
                                                  <input class="form-control form-control-rounded" name="payement" type="text" id="payement" placeholder="Montant"> 
                                                  <br>
                                                  <p>Entrez la date :</p>
                                                  <input class="form-control form-control-rounded" name="date_payement" type="date" id="date_payement" placeholder="Date de payement"> 
                                                  <br>
                                                  <button type="submit" style="background-color:#ffd400;" class="btn btn-light btn-round px-5">Payer</button>
                                            </form>

                                            </div>
                                            
                                            <br>
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

    
</script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("payementForm").addEventListener("submit", function(event) {
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
                        alert("Le formulaire a été envoyé avec succès");
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

</script>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');	

class Controller extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
		date_default_timezone_set("Indian/Antananarivo");
		// parent::__construct();
        // $this->load->library('pdf');
        $this->load->library('session');
		// $data = $this->model->getDateNow();
		// session_start();	
		// $_SESSION['dateparking'] = $data;
	}
	
	public function home()
	{
		$data['donnees_par_annee'] = $this->model->getChartData();
    	$data['mois'] = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		$data['somme_total_devis_existant'] = $this->model->somme_total_devis_existant();
		$data['getTotalMontantPayé'] = $this->model->getTotalMontantPayé();
		$data['page'] = "home";
		$this->load->view('header', $data);
	}
	public function login()
	{
		$this->load->view('login');
	}

	public function login_admin()
	{
		$this->load->view('login_admin');
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function form()
	{
		$data['unite'] = $this->model->findAll('unite', 'designation');
		$data['page'] = "forms";
		$this->load->view('header',$data);
	}
	public function calendar()
	{
		$data['page'] = "calendar";
		$this->load->view('header',$data);
		// echo ("coucou");
	}	
	public function profil()
	{
		$data['page'] = "profile";
		$this->load->view('header', $data);
		// echo ("coucou");
	}
	public function table()
	{
		$data['travaux_p']= $this->model->findtravaup();
		$data['travauxx']= $this->model->findtravau();

		$data['page'] = "tables";
		$this->load->view('header', $data);
		// echo ("coucou");
	}

	public function table_finition()
	{
		$data['finition']= $this->model->findAll3('finition' , 'id', 'designation', 'pourcentage');

		$data['page'] = "tables_finition";
		$this->load->view('header', $data);
		// echo ("coucou");
	}
	
	
	public function table_client()
	{

		$user = $this->session->userdata('utilisateur');
			$user2 = $this->session->userdata('administrateur');
			
			if ($user) {
				$id_user = $user['id'];
			} elseif ($user2) {
				$id_user = $user2['id'];
			} else {
				echo "Aucun utilisateur connecté.";
				return;
			}

		$data['demande_maison_finition_client']= $this->model->find_demande_maison_finition($id_user);

		$data['page'] = "table_client";
		$this->load->view('header', $data);
		// echo ("coucou");
	}

	public function table_admin(){
		$user = $this->session->userdata('utilisateur');
			$user2 = $this->session->userdata('administrateur');
			
			if ($user) {
				$id_user = $user['id'];
			} elseif ($user2) {
				$id_user = $user2['id'];
			} else {
				echo "Aucun utilisateur connecté.";
				return;
			}

		$data['payement_ajour_restant_payer']= $this->model->payement_ajour_restant_payer_admin();

		$data['page'] = "payement_ajour_restant_payer_admin";
		$this->load->view('header', $data);
	}
	
	public function liste()
	{
		$data['page'] = "cards";
		$data['finition']= $this->model->findAll3('finition','id', 'designation', 'pourcentage');
		$data['devis_maison']= $this->model->findAll10('somme_prix_devis_maison','id_devis','id_maison', 'designation_devis', 'nom_maison', 'somme_prix_total', 'duree_maison', 'nombre_chambres' , 'nombre_cuisines' ,'nombre_salons', 'nombre_toilettes');
		$this->load->view('header', $data);
		
	}

	public function details()
	{
		$data['page'] = "details";
		$this->load->view('header', $data);
	}

	

	public function validerLogin() {
		$this->form_validation->set_rules('telephone', 'Numero de telephone', 'required');
		$this->form_validation->set_rules('mdp', 'Mot de passe', 'required');
        try {
            $inputs = $this->input->post();
            $login = $this->model->login($inputs, 'utilisateur');
            if($login != null) {
                if($login['type_utilisateur'] != 1) {
                    $_SESSION['utilisateur'] = $login;
                    $this->liste();
                }
            }
            else throw new PDOException("Vérifiez votre numero");	
        }
        catch(Exception $ex) {
			if($login == null)
            $data['erreur'] = $ex->getMessage();
            // $data['page']='login';
			$this->load->view('login', $data);
			// $this->load->view('header',$data);
        }
    }
	
	public function validerLogin_admin() {
		$this->form_validation->set_rules('email', 'Adresse email', 'required');
		$this->form_validation->set_rules('mdp', 'Mot de passe', 'required');
        try {
            $inputs = $this->input->post();
            $login = $this->model->login_admin($inputs, 'utilisateur');
            if($login != null) {
                if($login['type_utilisateur'] == 1) {
                    $_SESSION['administrateur'] = $login;
                    $this->table_admin();
                }
                if($login['type_utilisateur'] != 1) {
                    $_SESSION['utilisateur'] = $login;
                    $this->liste();
                }
            }
            else throw new PDOException("Vérifiez votre email ou mot de passe!!");
        }
        catch(Exception $ex) {
			if($login == null)
            $data['erreur'] = $ex->getMessage();
            // $data['page']='login';
			$this->load->view('login_admin', $data);
			// $this->load->view('header',$data);
        }
    }

	public function inscription_utilisateur(){
		$input = $this->input->post();

		$this->form_validation->set_rules('nom', 'Nom d utilisateur', 'required');
        $this->form_validation->set_rules('mdp', 'Mot de passe', 'required');
        $this->form_validation->set_rules('mdp1', 'Validation mot de passe', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

		if($this->form_validation->run() == FALSE) {
			
			$this->load->view('register');
		}
		elseif($input['mdp'] != $input['mdp1']){
			$data['erreur'] = "Le mot de passe doit être confirmé!!";
            $data['page'] = "register";
			$this->load->view('header',$data);
		}
		else {
			$pers = array("nom" => $input['nom'],"email" => $input['email'],"mdp" => $input['mdp'],"type_utilisateur" => 0);
			$p = $this->model->save('utilisateur',$pers);
            // $data['page'] = "login";
			$this->load->view('login');
		}
	}

	public function deconnexion() {
        session_destroy();
        $this->load->view('login');
    }

	public function insertion_type_travaux($designation){
		$designation = $this->input->post();
		$insert_data = array(
			'designation' => $designation['designation']
		);

		$this->model->save('type_travaux', $insert_data);
		redirect(base_url('controller/form'));
	}

	public function insertion_travaux(){
		$input = $this->input->post();

		// Convertir la valeur du prix unitaire en nombre
		$prix_unitaire = str_replace(',', '.', $input['prix_unitaire']); // Remplacer les virgules par des points pour assurer un format numérique valide
		$prix_unitaire = (float) $prix_unitaire; // Convertir la chaîne en nombre

		$insert_data = array(
			'designation' => $input['designation'],
			'id_unite' => $input['id_unite'],
			'prix_unitaire' => $prix_unitaire, // Insérer le prix unitaire converti en nombre
			'code_travaux' => $input['code_travaux']
		);

		$this->model->save('travaux', $insert_data);
		redirect(base_url('controller/form'));
}

	public function supprimer($id) {
		$this->model->delete('travaux','id',$id);
		redirect('Controller/table');
	}

	public function modification(){
		// $valeur = null;
		if(isset($_GET['id'])) {
			$valeur = $_GET['id'];
		}

		$data['travaux']=$this->model->findById('travaux','id',$valeur);
		$data['unite'] = $this->model->findAll('unite', 'designation');
		
		$data['page'] = 'update';
		$this->load->view('header', $data);
	}

	public function modification_finition(){
		// $valeur = null;
		if(isset($_GET['id'])) {
			$valeur = $_GET['id'];
		}

		$data['finiton']=$this->model->findById('finition','id',$valeur);
		
		$data['page'] = 'update_finition';
		$this->load->view('header', $data);
	}

	public function modifier_finition() {
		$input = $this->input->post();
		// var_dump($input);
		
		
		$pourcentage = str_replace(',', '.', $input['pourcentage']);
		$pourcentage = (float) $pourcentage; 

		$insert_data = array(
			'designation' => $input['finition'],
			'pourcentage' => $pourcentage
		);
	
				if ($this->model->update('finition', 'id', $input['id'], $insert_data)) {
					redirect(base_url('controller/table_finition'));
				} else {
					echo "Erreur lors de la mise à jour.";
				}
			}

	public function modifier() {
		$input = $this->input->post();
		// var_dump($input);
		
		
		$insert_data = array(
			'designation' => $input['designation'],
			'id_unite' => $input['id_unite'],
			'code_travaux' => $input['code_travaux']
		);
	
				if ($this->model->update('travaux', 'id', $input['id'], $insert_data)) {
					redirect(base_url('controller/table'));
				} else {
					echo "Erreur lors de la mise à jour.";
				}
			}
		

		public function resetData(){
			// Appeler la méthode pour réinitialiser les données
			$this->model->resetDatabase();
	
			// Rediriger ou afficher un message de confirmation
			redirect(base_url('controller/table'));
		}

		public function insertion_demande_maison_finition(){
			$input = $this->input->post();
			// var_dump($input);
		
			$user = $this->session->userdata('utilisateur');
			$user2 = $this->session->userdata('administrateur');
			
			if ($user) {
				$id_user = $user['id'];
			} elseif ($user2) {
				$id_user = $user2['id'];
			} else {
				echo "Aucun utilisateur connecté.";
				return;
			}
		
			// Récupérer la durée du projet en jours à partir de la table type_maison
			$this->db->select('duree');
			$this->db->from('type_maison');
			$this->db->where('id', $input['selected_maison']);
			$query = $this->db->get();
			$result = $query->row();
		
			if ($result) {
				$duree_projet = $result->duree;
			} else {
				// Gérer le cas où la durée du projet n'est pas trouvée
				echo "La durée du projet n'a pas été trouvée.";
				return;
			}
		
			// Convertir la date de début en objet DateTime
			$date_debut = new DateTime($input['date_debut']);
		
			// Ajouter la durée du projet en jours à la date de début
			$date_fin = $date_debut->add(new DateInterval('P'.$duree_projet.'D'));
		
			// Formatage de la date de fin
			$date_fin_format = $date_fin->format('Y-m-d');
		
			$insert_data = array(
				'id_maison' => $input['selected_maison'],
				'id_finition' => $input['selected_finition'],
				'id_user' => $id_user,
				'date_debut' => $input['date_debut'],
				'date_fin' => $date_fin_format, // Utilisez la date de fin calculée
				'date_creation_devis' => $input['date_creation_devis'], // Utilisez la date de fin calculée
			);
		
			$this->model->save('demande_maison_finition', $insert_data);
			redirect(base_url('controller/liste'));
		}

		public function payement_devis() {
			$input = $this->input->post();
			$payement = $input['payement']; // Utiliser 'payement' au lieu de 'montant_payé'
			$id_demande_maison_finition = $input['id_demande_maison_finition']; // Assurez-vous que cette clé correspond au nom du champ dans le formulaire
		
			// Vérifier si le montant entré est négatif
			if ($payement < 0) {
				// Rediriger avec un message d'erreur
				redirect(base_url('controller/payement_ajour_restant_payer?id=' . $id_demande_maison_finition . '&error=Le montant ne peut pas être négatif'));
			}
		
			// Récupérer le montant restant à payer
			$montant_restant = $this->model->getMontantRestantAPayer($id_demande_maison_finition);
		
			// Vérifier si le montant entré est supérieur au montant restant à payer
			if ($payement > $montant_restant) {
				// Rediriger avec un message d'erreur
				redirect(base_url('controller/payement_ajour_restant_payer?id=' . $id_demande_maison_finition. '&error=Le montant entré est supérieur au montant restant à payer'));
			}
		
			$insert_data = array(
				'id_demande_maison_finition' => $id_demande_maison_finition,
				'montant' => $payement,
				'date_payement' => $input['date_payement'] // Assurez-vous que cette clé correspond au nom du champ dans le formulaire
			);
		
			$this->model->save('historique_payement', $insert_data);
			// Rediriger vers la page de la table des clients en passant l'ID
			redirect(base_url('controller/payement_ajour_restant_payer?id=' . $id_demande_maison_finition));
		}
		

		public function payement_ajour_restant_payer(){
			$id = $this->input->get('id');
			$data['payement_ajour_restant_payer']= $this->model->payement_ajour_restant_payer($id);
			$data['page'] = 'payement_ajour_restant_payer';
			$this->load->view('header', $data);
		}

		public function payement_ajour_restant_payer_admin(){
			$id = $this->input->get('id');
			$data['payement_ajour_restant_payer']= $this->model->payement_ajour_restant_payer_admin($id);
			$data['page'] = 'payement_ajour_restant_payer_admin';
			$this->load->view('header', $data);
		}
		
		public function details_devis_user() {
			$id = $this->input->get('id');
			// var_dump($id);
			$data['details_devis'] = $this->model->find_details_devis_client2($id);
			$data['id'] = $id; // Passer l'ID à la vue
			$data['page'] = 'table_details_devis_client';
			$this->load->view('header', $data);
		}

		public function details_devis_admin() {
			$id = $this->input->get('id');
			// var_dump($id);
			$data['details_devis'] = $this->model->find_details_devis_client2($id);
			$data['id'] = $id; // Passer l'ID à la vue
			$data['page'] = 'table_details_devis_admin';
			$this->load->view('header', $data);
		}

		
		
		public function generate_pdf() {
			$id = $this->input->get('id');
			// var_dump($id);
			// Récupérer les détails du devis pour l'ID donné
			$data['details'] = $this->model->find_details_devis_client2($id);
			
			// Charger la bibliothèque PDF
			$this->load->library('pdf');
		
			// Générer le contenu HTML du PDF en utilisant une vue spécifique
			$html = $this->load->view('details_devis_client_pdf', $data, true);
		
			// Charger le contenu HTML dans la bibliothèque PDF
			$this->pdf->load_html($html);
			$this->pdf->render();
		
			// Récupérer le PDF en tant que chaîne de caractères
			$output = $this->pdf->output();
		
			// Envoyer le PDF en tant que téléchargement
			$filename = 'details_devis_' . $id . '.pdf';
			header('Content-Type: application/pdf');
			header('Content-Disposition: attachment; filename="' . $filename . '"');
			header('Content-Length: ' . strlen($output));
			echo $output;
		}
		
		
	public function export_csv_table($id_vente) {
		// Charger la bibliothèque Database
		$this->load->database();
	
		// Charger la bibliothèque dbutil
		$this->load->dbutil();
	
		// Requête pour obtenir les données à exporter en fonction de l'ID de vente
		$this->db->where('id', $id_vente);
		$query = $this->db->get('vente_billet');
		
		// Vérifier si des données ont été trouvées pour cet ID
		if ($query->num_rows() > 0) {
			$data = $this->dbutil->csv_from_result($query);
	
			// Nom du fichier CSV de sortie
			$file_name = 'export_' . $id_vente . '.csv';
	
			// Charger la bibliothèque de téléchargement pour forcer le téléchargement
			$this->load->helper('download');
			force_download($file_name, $data);
		} else {
			// Si aucune donnée n'a été trouvée pour cet ID, redirigez ou affichez un message d'erreur
			// Redirection ou affichage de message d'erreur
		}
	}

	public function export_csv($id_vente) {
		// Charger la bibliothèque Database
		$this->load->database();
	
		// Charger la bibliothèque dbutil
		$this->load->dbutil();
	
		// Requête pour obtenir les données à exporter en fonction de l'ID de vente
		$this->db->select('vd.id as id_vente, f.nom_film, t.montant as tarif, p.colonne, p.ligne, d.date_diffusion, d.heure_diffusion, s.nom_salle');
		$this->db->from('vente_billet vd');
		$this->db->join('tarif t', 'vd.type_tarif = t.type_tarif');
		$this->db->join('diffusion d', 'vd.id_diffusion = d.id');
		$this->db->join('film f', 'd.id_film = f.id');
		$this->db->join('salle s', 'd.id_salle = s.id');
		$this->db->join('place p', 'vd.id_place = p.id');
		$this->db->where('vd.id', $id_vente);
		$query = $this->db->get();
	
		// Vérifier si des données ont été trouvées pour cet ID
		if ($query->num_rows() > 0) {
			$data = $this->dbutil->csv_from_result($query);
	
			// Nom du fichier CSV de sortie
			$file_name = 'export_' . $id_vente . '.csv';
	
			// Charger la bibliothèque de téléchargement pour forcer le téléchargement
			$this->load->helper('download');
			force_download($file_name, $data);
		} else {
			// Si aucune donnée n'a été trouvée pour cet ID, redirigez ou affichez un message d'erreur
			// Redirection ou affichage de message d'erreur
		}
	}

	public function importation_csv_travaux(){
		$date['page']='forms_importation_t_m';
		$this->load->view('header', $date);
	}

	public function importation_csv_payement(){
		$date['page']='forms_importation_payement';
		$this->load->view('header', $date);
	}

	public function forms_importation(){
		$date['page']='forms_importation';
		$this->load->view('header', $date);
	}

	public function importation_csv_travaux_maison(){
		// Vérifiez si le fichier CSV pour les travaux de maison a été soumis
		if (!empty($_FILES['csv_file_1']['name'])) {
			// Appel de la fonction pour traiter le premier fichier CSV
			$this->upload_csv_1();
		} else {
			echo "Veuillez sélectionner le fichier CSV pour les travaux de maison.";
		}
	
		// Vérifiez si le fichier CSV pour les devis a été soumis
		if (!empty($_FILES['csv_file_2']['name'])) {
			// Appel de la fonction pour traiter le deuxième fichier CSV
			$this->upload_csv_2();
		} else {
			echo "Veuillez sélectionner le fichier CSV pour les devis.";
		}

		// redirect(base_url('controller/importation_csv_travaux'));
	}

	public function upload_csv_1() {
		$this->load->database();
	
		if (isset($_FILES['csv_file_1'])) {
			// Appel de la fonction pour traiter le premier fichier CSV
			$file_path = $_FILES['csv_file_1']['tmp_name'];
			$handle = fopen($file_path, "r");
	
			// Création de la table temporaire si elle n'existe pas
			$this->db->query("CREATE TEMPORARY TABLE IF NOT EXISTS temp_table1 (
				type_maison varchar(255),
				description varchar(255),
				surface float(10,2),
				code_travaux int(11),
				type_travaux varchar(255),
				unité varchar(255),
				prix_unitaire float(10,2),
				quantite double precision,
				duree_travaux double precision
			)");
	
			if ($handle !== FALSE) {
				$line_count = 0;
	
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if ($line_count == 0) {
						$line_count++;
						continue;
					}
					$pourcentage = str_replace(',', '.', $data[6]);
					$pourcentage = (float) $pourcentage; 
					var_dump($pourcentage );
					
					// Insertion des données dans la table temporaire
					$this->db->insert('temp_table1', array(
						'type_maison' => $data[0],
						'description' => $data[1],
						'surface' => $data[2],
						'code_travaux' => $data[3],
						'type_travaux' => $data[4],
						'unité' => $data[5],
						'prix_unitaire' => $pourcentage,
						'quantite' => $data[7],
						'duree_travaux' => $data[8]
					));
	
					// Récupération de l'ID de la maison
					$exist_type_maison_row = $this->db->get_where('type_maison', array('nom_maison' => $data[0]))->row();
					if ($exist_type_maison_row) {
						$exist_type_maison = $exist_type_maison_row->id;
					} else {
						// Insérer le type de maison s'il n'existe pas
						$this->db->insert('type_maison', array(
							'nom_maison' => $data[0],
							'duree' => $data[8]
						));
						$exist_type_maison = $this->db->insert_id();
					}

	
					$travaux_row = $this->db->get_where('travaux', array('code_travaux' => $data[3]))->row();
						if ($travaux_row) {
							$id_travaux = $travaux_row->id;
						} else {
							// Récupération de l'ID de l'unité
							$exist_unite_row = $this->db->get_where('unite', array('designation' => $data[5]))->row();
							if ($exist_unite_row) {
								$exist_unite = $exist_unite_row->id;
							} else {
								// Si l'unité n'existe pas, insérer cette nouvelle unité
								$this->db->insert('unite', array('designation' => $data[5]));
								$exist_unite = $this->db->insert_id();
							}

							// Insertion des données dans la table travaux
							$travaux_data = array(
								'code_travaux' => $data[3],
								'designation' => $data[4],
								'id_unite' => $exist_unite,
								'prix_unitaire' => $pourcentage
							);
							$this->db->insert('travaux', $travaux_data);
							$id_travaux = $this->db->insert_id();
						}



	
					// Insertion de la maison dans la table maison si elle n'existe pas
					$existing_maison_row = $this->db->get_where('maison', array('description' => $data[1], 'surface' => $data[2]))->row();
					if (!$existing_maison_row) {
						$maison_data = array(
							'id_type_maison' => $exist_type_maison,
							'description' => $data[1],
							'surface' => $data[2]
						);
						$this->db->insert('maison', $maison_data);
					}
	
					$maison_row = $this->db->get_where('maison', array('description' => $data[1], 'surface' => $data[2]))->row();
					if ($maison_row) {
						$id_maison = $maison_row->id;
					} else {
						// Gérer l'absence de la maison
						// Vous pouvez choisir de ne rien faire, de générer une erreur ou d'insérer la maison ici
						// Pour l'exemple, j'utilise 0 comme ID de maison inexistant
						$id_maison = 0;
					}

					// Vérifier s'il existe déjà un devis pour cette maison avec la même désignation
					$existing_devis = $this->db->get_where('devis', array('designation' => $data[0], 'id_maison' => $id_maison))->row();
					if ($existing_devis) {
						// Si le devis existe déjà, mettez à jour ses détails au lieu d'en insérer un nouveau
						$id_devis = $existing_devis->id;

						$devis_detail_data = array(
							'designation' => $data[0], // Utiliser le nom de maison comme désignation
							'id_maison' => $id_maison,
						);
						$this->db->set($devis_detail_data);
						$this->db->where('id', $id_devis);
						$this->db->update('devis');
					} else {
						// Si le devis n'existe pas encore, insérez-le dans la table devis
						$devis_data = array(
							'designation' => $data[0], // Utiliser le nom de maison comme désignation
							'id_maison' => $id_maison, // Insérer l'ID de la maison
							// Ajouter d'autres champs si nécessaire
						);
						$this->db->insert('devis', $devis_data);
						$id_devis = $this->db->insert_id();
					}

					
					// Insérer les détails du devis
					$prix_total = $pourcentage * $data[7];

					$pt = str_replace(',', '.', $prix_total);
					$pt = (float) $pt; 

					$details_devis_data = array(
						'id_travaux' => $id_travaux,
						'quantite' => $data[7],
						'prix_unitaire' => $pourcentage,
						'prix_total' => $pt,
						'id_devis' => $id_devis
					);
					$this->db->insert('details_devis', $details_devis_data);
	
					$line_count++;
				}
	
				fclose($handle);
				// redirect(base_url('controller/forms_importation_t_m'));
			} else {
				// Gérer le cas où aucun fichier n'a été téléchargé
				echo "Veuillez sélectionner un fichier CSV.";
			}
		} else {
			// Gérer le cas où aucun fichier n'a été téléchargé
			echo "Veuillez sélectionner un fichier CSV.";
		}
	}

	public function generate_ref_devis($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters_length = strlen($characters);
		$random_string = '';
	
		for ($i = 0; $i < $length; $i++) {
			$random_string .= $characters[rand(0, $characters_length - 1)];
		}
	
		return $random_string;
	}
	
	
	public function upload_csv_2() {
		$this->load->database();
		
		if (isset($_FILES['csv_file_2'])) {
			// Appel de la fonction pour traiter le deuxième fichier CSV
			$file_path = $_FILES['csv_file_2']['tmp_name'];
			$handle = fopen($file_path, "r");
	
			if ($handle !== FALSE) {
				$line_count = 0;
	
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if ($line_count == 0) {
						$line_count++;
						continue;
					}
	
					// Récupération de l'ID utilisateur associé au client
					$user_row = $this->db->get_where('utilisateur', array('telephone' => $data[0]))->row();
	
					if (!$user_row) {
						// Insérer un nouvel utilisateur
						$user_data = array(
							'telephone' => $data[0],
							'nom' => '', // Remplissez avec les autres données utilisateur si disponibles
							'prenom' => '',
							'email' => '',
							'mdp' => '', // Assurez-vous de traiter correctement le mot de passe
							'type_utilisateur' => 0 // Spécifiez le type d'utilisateur si nécessaire
						);
						$this->db->insert('utilisateur', $user_data);
						$user_id = $this->db->insert_id();
					} else {
						$user_id = $user_row->id;
					}
	
					// Récupération de l'ID de la finition associée à la désignation
					$finition_row = $this->db->get_where('finition', array('designation' => $data[3]))->row();
					if ($finition_row && $finition_row->pourcentage != $data[4]) {
						// Convertir la valeur de pourcentage en float
						$pourcentage = floatval(str_replace(',', '.', $data[4]));

						// Mettre à jour le pourcentage de la finition
						$this->db->set('pourcentage', $pourcentage);
						$this->db->where('designation', $data[3]);
						$this->db->update('finition');
					}

	
					// Vérification si la finition existe et récupération de son ID
					if ($finition_row) {
						$id_finition = $finition_row->id;
					} else {
						// La finition n'existe pas, vous pouvez gérer cela en conséquence
						 $pourcentage = floatval(str_replace(',', '.', $data[4]));
						// Insérer la nouvelle finition dans la table et récupérer son ID
						$new_finition_data = array(
							'designation' => $data[3],
							'pourcentage' => $pourcentage // Assurez-vous de récupérer la valeur correcte pour le pourcentage
						);
						$this->db->insert('finition', $new_finition_data);
						$id_finition = $this->db->insert_id();
					}
	
					// Récupération de l'ID de la maison associée au nom de la maison
					// Récupération de l'ID du type de maison associé au nom de la maison
						$type_maison_row = $this->db->get_where('type_maison', array('nom_maison' => $data[2]))->row();
						if ($type_maison_row) {
							$id_type_maison = $type_maison_row->id;
							$duree_maison = $type_maison_row->duree;
						} else {
							// Gérez le cas où le type de maison n'existe pas
							// Par exemple, affichez un message d'erreur ou créez un nouveau type de maison
							// Pour l'exemple, nous fixons un ID bidon
							$id_type_maison = 0;
							$duree_maison = 0;
						}

						// Recherche de l'ID de la maison en fonction du nom de la maison et de l'ID du type de maison
						$maison_row = $this->db->get_where('maison', array('id_type_maison' => $id_type_maison))->row();
						if ($maison_row) {
							$id_maison = $maison_row->id;
						} else {
							// Gérez le cas où la maison n'existe pas
							// Par exemple, affichez un message d'erreur ou créez une nouvelle maison
							// Pour l'exemple, nous fixons un ID bidon
							$id_maison = 0;
						}


						$devis_data = array(
							'designation' => $data[2],
							'ref_devis' => $data[1], // Ajouter la référence de devis
							'id_maison' => $id_maison // Ajouter l'ID de maison
							// Autres champs de la table devis
						);
						$this->db->insert('devis', $devis_data);
	
	
						$date_devis = date('Y-m-d', strtotime(str_replace('/', '-', $data[5])));
						$date_debut = date('Y-m-d', strtotime(str_replace('/', '-', $data[6])));

						// Calcul de la date de fin en ajoutant la durée à la date de début
						$date_fin = date('Y-m-d', strtotime($date_debut . ' +' . $duree_maison . ' days'));

						// Insertion des données dans la table demande_maison_finition
						$demande_maison_finition_data = array(
							'id_maison' => $id_maison,
							'id_finition' => $id_finition,
							'id_user' => $user_id,
							'date_creation_devis' => $date_devis,
							'date_debut' => $date_debut,
							'date_fin' => $date_fin, // Ajout de la date de fin calculée
							'lieu' => $data[7]
						);
							$this->db->insert('demande_maison_finition', $demande_maison_finition_data);

						

					$line_count++;
				}
	
				fclose($handle);
				// redirect(base_url('controller/forms_importation_t_m'));
			} else {
				// Gérer le cas où aucun fichier n'a été téléchargé
				echo "Veuillez sélectionner un fichier CSV.";
			}
		} else {
			// Gérer le cas où aucun fichier n'a été téléchargé
			echo "Veuillez sélectionner un fichier CSV.";
		}
	}
	
	public function upload_csv_paiement() {
		$this->load->database();
		
		if (isset($_FILES['csv_file_paiement'])) {
			// Appel de la fonction pour traiter le fichier CSV de paiement
			$file_path = $_FILES['csv_file_paiement']['tmp_name'];
			$handle = fopen($file_path, "r");
	
			if ($handle !== FALSE) {
				$line_count = 0;
	
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					if ($line_count == 0) {
						$line_count++;
						continue;
					}
	
					// Récupération de l'ID du devis en jointure avec la table devis
					$this->db->select('devis.id as id_devis');
					$this->db->from('devis');
					$this->db->where('devis.id_maison', $data[0]);
					$query = $this->db->get();
					$devis_row = $query->row();
					
	
					if (!$devis_row) {
						// Gérer le cas où la référence de devis n'existe pas
						continue; // passer à la ligne suivante
					}

					// Récupération de l'ID de la demande_maison_finition en fonction de la ref_devis du fichier CSV
					// Récupération de l'ID de la demande_maison_finition en fonction de l'ID du devis
						// Récupération de l'ID de la demande_maison_finition en fonction de l'ID du devis
					$this->db->select('id');
					$this->db->from('demande_maison_finition');
					$this->db->where('id_maison', $devis_row->id_maison); // Utilisation de l'ID du devis récupéré
					$query = $this->db->get();
					$row = $query->row();

					if (!$row) {
						// Gérer le cas où la demande de maison finition n'existe pas pour cet ID de devis
						continue; // passer à la ligne suivante
					}

					// Maintenant, vous pouvez accéder à l'ID de la demande de maison finition
					$id_demande_maison_finition = $row->id;



					$demande = $this->db->get_where('demande_maison_finition', array('id_maison' => $devis_row))->row();
						if ($demande) {
							$demande_maison = $demande->id;
						} else {
							// Gérez le cas où la maison n'existe pas
							// Par exemple, affichez un message d'erreur ou créez une nouvelle maison
							// Pour l'exemple, nous fixons un ID bidon
							$demande_maison = 0;
						}
	
					// Créer un tableau de données pour l'insertion dans la table paiement
					$paiement_data = array(
						'id_devis' =>  $devis_row->id_devis,
						'ref_paiement' => $data[1],
						'date_payement' => date('Y-m-d', strtotime(str_replace('/', '-', $data[2]))),
						'montant' => $data[3],
						'id_demande_maison_finition' => $id_demande_maison_finition // Utiliser l'ID de devis récupéré
						// Ajoutez d'autres champs si nécessaire
					);

					// echo "devis: " . $devis_row->id_devis . "<br>";
					// 	echo "ref p: " .$data[1] . "<br>";
					// 	echo "ref p: " .$data[3] . "<br>";
					// 	echo "ref p: " .$id_demande_maison_finition. "<br>";
					// 	echo "Date : " . date('Y-m-d', strtotime(str_replace('/', '-', $data[2]))) . "<br>";
	
					// Insérer les données dans la table paiement
					$this->db->insert('historique_payement', $paiement_data);
	
					$line_count++;
				}
	
				fclose($handle);
				// redirect(base_url('controller/importation_csv_payement'));
			} else {
				// Gérer le cas où aucun fichier n'a été téléchargé
				echo "Veuillez sélectionner un fichier CSV de paiement.";
			}
		} else {
			// Gérer le cas où aucun fichier n'a été téléchargé
			echo "Veuillez sélectionner un fichier CSV de paiement.";
		}
	}
	
	
	
	
	
		
}
	


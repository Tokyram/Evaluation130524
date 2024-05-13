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
		$data['type_travaux'] = $this->model->findAll('type_travaux', 'designation');
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
		$data['travaux_t']= $this->model->findtravaut();
		$data['travaux_p']= $this->model->findtravaup();
		$data['travaux_i']= $this->model->findtravaui();
		$data['travauxx']= $this->model->findtravau();

		$data['page'] = "tables";
		$this->load->view('header', $data);
		// echo ("coucou");
	}

	public function table_client()
	{
		// $data['devis_client']= $this->model->find_devis_client();

		$data['page'] = "table_client";
		$this->load->view('header', $data);
		// echo ("coucou");
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
                    $this->form();
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
			$this->load->view('login', $data);
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
			'id_type_travaux' => $input['id_type_travaux']
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
		$data['type_travaux'] = $this->model->findAll('type_travaux', 'designation');
		$data['unite'] = $this->model->findAll('unite', 'designation');
		
		$data['page'] = 'update';
		$this->load->view('header', $data);
	}

	public function modifier() {
		$input = $this->input->post();
		var_dump($input);
		
		
		$prix_unitaire = str_replace(',', '.', $input['prix_unitaire']);
		$prix_unitaire = (float) $prix_unitaire; 

		$insert_data = array(
			'designation' => $input['designation'],
			'id_unite' => $input['id_unite'],
			'prix_unitaire' => $prix_unitaire,
			'id_type_travaux' => $input['id_type_travaux']
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
			);
		
			$this->model->save('demande_maison_finition', $insert_data);
			redirect(base_url('controller/liste'));
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
	

	public function pdf_export($id_vente) {
		// Charger la bibliothèque Database
		$this->load->database();
	
		// Exécuter la requête SQL pour obtenir les données spécifiques à cette vente
		$query = $this->db->query("SELECT vd.id as id_vente, f.nom_film, t.montant as tarif, p.colonne, p.ligne, d.date_diffusion, d.heure_diffusion, s.nom_salle 
									FROM vente_billet vd
									JOIN tarif t ON vd.type_tarif = t.type_tarif
									JOIN diffusion d ON vd.id_diffusion = d.id
									JOIN film f ON d.id_film = f.id
									JOIN salle s ON d.id_salle = s.id
									JOIN place p ON vd.id_place = p.id
									WHERE vd.id = ?", array($id_vente));
	
		// Vérifier si la requête a retourné des résultats
		if ($query->num_rows() > 0) {
			// Récupérer les résultats de la requête
			$data['vente'] = $query->row_array();
	
			// Charger la bibliothèque PDF
			$this->load->library('pdf');
	
			// Générer le PDF avec les données spécifiques à cette vente
			$html = $this->load->view('vente_detailes', $data, true); // Assurez-vous que vous avez une vue nommée vente_details pour afficher les détails de la vente
			$dompdf = new PDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$output = $dompdf->output();
			file_put_contents('vente_' . $id_vente . '.pdf', $output);
			redirect(base_url('controller/panier'));
		} else {
			echo "error";
		}
	}
	
	
	

	


	
}

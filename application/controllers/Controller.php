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
	public function register()
	{
		$this->load->view('register');
	}
	public function form()
	{
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
		$data['page'] = "tables";
		$this->load->view('header', $data);
		// echo ("coucou");
	}
	
	public function liste()
	{
		$data['page'] = "cards";
		$this->load->view('header', $data);
		
	}

	public function details()
	{
		$data['page'] = "details";
		$this->load->view('header', $data);
	}

	

	public function validerLogin() {
        try {
            $inputs = $this->input->post();
            $login = $this->model->login($inputs, 'utilisateur');
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
            else throw new PDOException("Vérifiez votre nom d'utilisateur et mot de passe!!");
        }
        catch(Exception $ex) {
            $data['erreur'] = $ex->getMessage();
            // $data['page']='login';
			$this->load->view('login');
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

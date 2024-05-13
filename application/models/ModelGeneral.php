<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class ModelGeneral extends CI_Model{
        public function login($input,$table) {
			if(!empty($input["telephone"]) ){
				$sql = "SELECT * FROM %s WHERE telephone = '%s'";
				$sql = sprintf($sql, $table, $input["telephone"]);
				$query = $this->db->query($sql);
				$row = $query->row_array();
				return $row;
			}
			return null;
		}

		public function login_admin($input,$table) {
			if(!empty($input["email"]) || !empty($input["mdp"])){
				$sql = "SELECT * FROM %s WHERE email = '%s' AND mdp = '%s'";
				$sql = sprintf($sql, $table, $input["email"], $input["mdp"]);
				$query = $this->db->query($sql);
				$row = $query->row_array();
				return $row;
			}
			return null;
		}

		public function save($table, $data){
			// if($this->db->insert($table, $data)) return true;
			// else return false;

			$sql = $this->db->insert($table,$data);
			$query = $this->db->insert_id();
			return $query;
		}

		public function findAll($table, $colonne){
			$sql = "SELECT * FROM %s order by %s asc";
			$sql = sprintf($sql, $table, $colonne);
			return $this->db->query($sql)->result();
		}

		public function findAll3($table, $colonne, $colonne1, $colonne2){
			$sql = "SELECT * FROM %s order by %s asc";
			$sql = sprintf($sql, $table, $colonne, $colonne1, $colonne2);
			return $this->db->query($sql)->result();
		}

		public function findAll10($table, $colonne, $colonne1, $colonne2, $colonne3, $colonne4, $colonne5, $colonne6, $colonne7,$colonne8){
			$sql = "SELECT * FROM %s order by %s asc";
			$sql = sprintf($sql, $table, $colonne, $colonne1, $colonne2, $colonne3, $colonne4, $colonne5, $colonne6,  $colonne7, $colonne8);
			return $this->db->query($sql)->result();
		}

		public function findtravau(){
			$sql = "SELECT t.id AS id_travaux, t.designation AS designation_travaux, u.designation AS designation_unite, t.prix_unitaire, tt.id AS id_type_travaux, tt.designation AS designation_type_travaux
						FROM btp.travaux AS t
						JOIN btp.type_travaux AS tt ON t.id_type_travaux = tt.id
						JOIN btp.unite AS u ON t.id_unite = u.id";
		
			return $this->db->query($sql)->result();
		}

		public function findtravaut(){
			$sql = "SELECT t.id AS id_travaux, t.designation AS designation_travaux, u.designation AS designation_unite, t.prix_unitaire, tt.id AS id_type_travaux, tt.designation AS designation_type_travaux
						FROM btp.travaux AS t
						JOIN btp.type_travaux AS tt ON t.id_type_travaux = tt.id
						JOIN btp.unite AS u ON t.id_unite = u.id
						WHERE tt.designation = 'Travaux terrassement'";
		
			return $this->db->query($sql)->result();
		}

		public function findtravaup(){
			$sql = "SELECT t.id AS id_travaux, t.designation AS designation_travaux, u.designation AS designation_unite, t.prix_unitaire, tt.id AS id_type_travaux, tt.designation AS designation_type_travaux
					FROM btp.travaux AS t
					JOIN btp.type_travaux AS tt ON t.id_type_travaux = tt.id
					JOIN btp.unite AS u ON t.id_unite = u.id
					WHERE tt.designation = 'Travaux preparatoire'";
				
			return $this->db->query($sql)->result();
		}
		

		public function findtravaui(){
			$sql = "SELECT t.id AS id_travaux, t.designation AS designation_travaux,u.designation AS designation_unite, t.prix_unitaire, tt.id AS id_type_travaux, tt.designation AS designation_type_travaux
						FROM btp.travaux AS t
						JOIN btp.type_travaux AS tt ON t.id_type_travaux = tt.id
						JOIN btp.unite AS u ON t.id_unite = u.id
						WHERE tt.designation = 'Travaux en infrastructure'";
		
			return $this->db->query($sql)->result();
		}


		public function findById($table, $colonne, $id){
			$this->db->where($colonne, $id);
			return $this->db->get($table)->row();
		}

		public function delete($table,$colone_id,$id){
			$this->db->where($colone_id, $id);
			if($this->db->delete($table)) return true;
			else return false;
		}
		
		public function update($table, $colone_id, $id, $data){
			$this->db->where($colone_id, $id);
			if($this->db->update($table, $data)) return true;
			else return false;
		}

		public function find_demande_maison_finition($id){
			$sql = "SELECT dm.id, u.nom AS nom_utilisateur, u.prenom AS prenom_utilisateur, dm.date_debut, dm.date_fin, tm.nom_maison, f.designation, d.designation AS designation_devis
					FROM demande_maison_finition dm
					JOIN maison m ON dm.id_maison = m.id
					JOIN finition f ON dm.id_finition = f.id
					JOIN type_maison tm ON m.id_type_maison = tm.id
					JOIN utilisateur u ON dm.id_user = u.id
					JOIN devis d ON dm.id_maison = d.id_maison
					WHERE dm.id_user = $id ";
		
			return $this->db->query($sql)->result();
		}
		

			public function resetDatabase(){
				$this->load->database();
		
				$this->db->query('SET FOREIGN_KEY_CHECKS = 0');

				// Supprimer les données de la table 'type_travaux'
				$this->db->truncate('type_travaux');

				// Supprimer les données de la table 'unite'
				$this->db->truncate('unite');

				// Supprimer les données de la table 'travaux'
				$this->db->truncate('travaux');

				// Supprimer les données de la table 'suivi_travaux'
				$this->db->truncate('suivi_travaux');

				$this->db->where('type_utilisateur !=', '1');
        		$this->db->delete('utilisateur');

				// Réactiver les contraintes de clé étrangère
				$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
			}
		
		
		public function getAllPlaces() {
			return $this->db->get('place')->result();
		}

		public function findBilletVenduFilm(){

			$sql = "SELECT f.nom_film, COUNT(vb.id) AS nombre_billets_vendus
					FROM cinema.film f
					LEFT JOIN cinema.diffusion d ON f.id = d.id_film
					LEFT JOIN cinema.vente_billet vb ON d.id = vb.id_diffusion
					GROUP BY f.nom_film
					";
			return $this->db->query($sql)->result();	
		}

		public function filmleplusvue(){
			$sql = "SELECT f.nom_film, f.image, COUNT(vb.id_diffusion) AS nombre_vues, f.duree, c.nom_categorie
					FROM film f
					JOIN diffusion d ON f.id = d.id_film
					JOIN vente_billet vb ON d.id = vb.id_diffusion
					JOIN categorie c ON f.id_categorie = c.id
					GROUP BY f.nom_film
					ORDER BY nombre_vues DESC
					";

			return $this->db->query($sql)->result();
		}
		
		public function findVenteExport(){
			$sql = "SELECT vd.id as id_vente,f.nom_film ,t.montant as tarif, p.colonne, p.ligne, d.date_diffusion , d.heure_diffusion, s.nom_salle from vente_billet vd
					JOIN tarif t on vd.type_tarif = t.type_tarif
					JOIN diffusion d ON vd.id_diffusion = d.id
					JOIN film f on d.id_film = f.id
					JOIN salle s on d.id_salle = s.id
					JOIN place p ON vd.id_place = p.id
					";

			return $this->db->query($sql)->result();
		}
    }

?>
<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

    class ModelGeneral extends CI_Model{
        public function login($input,$table) {
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

		public function findDiffusion(){
			$sql = "SELECT 
						diffusion.id AS id_diffusion, 
						film.id AS film_id,
						film.nom_film,
						film.description,
						film.image,
						salle.nom_salle,
						diffusion.date_diffusion,
						diffusion.heure_diffusion
					FROM 
						cinema.diffusion
					JOIN 
						cinema.film ON diffusion.id_film = film.id
					JOIN 
						cinema.salle ON diffusion.id_salle = salle.id";
		
			return $this->db->query($sql)->result();
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
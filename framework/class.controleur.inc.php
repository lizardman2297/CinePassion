<?php
/*================================================================================================================
	fichier				: class.controleur.inc.php
	auteur				: Christophe Goidin (christophe.goidin@ac-grenoble.fr)
	date de création	: juin 2017
	date de modification: septembre 2017 	: traitement URL
											: modification des paramètres getNavigation
											: récupération d'un encart aléatoire
	rôle				: classe regroupant les services communs à TOUS les contrôleurs.
  ================================================================================================================*/

/**
 * Classe générique définissant les services communs à TOUS les contrôleurs
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.0
 * @copyright Christophe Goidin - juin 2017
 */
abstract class controleur {

	protected $requete;				// La requête HTTP initiale
	protected $module;				// Le module après "traitement"
	protected $page;				// La page après "traitement"
	protected $action;				// L' action après "traitement"
	protected $section;
	protected $donnees = array();// Le tableau où sont stockées les données pour la vue
	
	/**
	 * Permet de définir la requête HTTP entrante, les paramètres module, page et action
	 * @param requete $requete : la requête HTTP
	 * @param string $module : le module "utilisé"
	 * @param string $page : la page du module
	 * @param string $action : l'action à réaliser sur la page
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function setRequete(requete $requete, $module, $page, $action, $section) {
		$this->requete = $requete;
		$this->module = $module;
		$this->page = $page;
		$this->action = $action;
		$this->section = $section;
	}
	
	/**
	 * Met à jour le tableau $donnees avec les données communes à TOUTES les pages du site web
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.1
	 * @copyright Christophe Goidin - juin 2017
	 */
	protected function setDonnees() {
		// ===============================================================================================================
		// données communes à toutes les pages
		// ===============================================================================================================
		$this->doctype = configuration::get("doctypeStrict");
		$this->titreSiteWeb = configuration::get("siteWeb");
		$this->filAriane = $this->getFilAriane();
		$this->version = "version : " . configuration::get("version");
		$this->dateDuJour = utf8_encode(strftime("%A %d %B %Y"));
		$this->authentification = $this->getAuthentification();
		
		// ===============================================================================================================
		// on positionne l'action dans le tableau $donnees afin d'y avoir accès dans la vue
		// ===============================================================================================================
		$this->donnees['action'] = $this->action;
		$this->donnees['section'] = $this->section;

		// ===============================================================================================================
		// on positionne des données avec une valeur par défaut si elles n'ont pas été définies dans le contrôleur associé à la page en cours
		// ===============================================================================================================
		if (!$this->existe("titreHeader")) {
			$this->titreHeader = "?";
		}
		if (!$this->existe("titreMain")) {
			$this->titreMain = "?";
		}
		if (!$this->existe("enteteLien")) {
			$this->enteteLien = "";
		}

		// ===============================================================================================================
		// on positionne les encarts
		// ===============================================================================================================
		if ($this->existe("encarts", "partiel")) {	// il existe au moins un élément dans le tableau $donnees dont le nom commence par encarts
			$adresse = configuration::get("adrEncarts");
			
			// ===============================================================================================================
			// encarts à gauche
			// ===============================================================================================================
			if (array_key_exists("encartsGauche", $this->donnees)) { // il existe au moins un élément dans le tableau $donnees dont le nom = encartsGauche
				$this->lesEncartsGauche = new collection();
				foreach ($this->donnees['encartsGauche'] as $fichier) {
					$this->lesEncartsGauche->ajouter(new encart($adresse . $fichier));
				}
				unset($this->donnees['encartsGauche']);
			}
			
			// ===============================================================================================================
			// encarts à droite
			// ===============================================================================================================
			if (array_key_exists("encartsDroite", $this->donnees)) { // il existe au moins un élément dans le tableau $donnees dont le nom = encartsDroite
				$this->lesEncartsDroite = new collection();
				foreach ($this->donnees['encartsDroite'] as $fichier) {
					$this->lesEncartsDroite->ajouter(new encart($adresse . $fichier));
				}
				unset($this->donnees['encartsDroite']);
			}
		}
	}
	
	
	protected function getNavigation() {
	    // ===============================================================================================================
	    // cas général : numérotatio n des sections classique...
	    // ===============================================================================================================
	    
	    if (!$this->existe("nav")) {
	       $this->nav = (object) array("sectionPremiere" => 1,
	                                   "sectionPrecedente" => $this->section - 1,
	                                   "sectionSuivante" => $this->section + 1,
	                                   "sectionDerniere" => $this->nbSections);
	                                  
	     
	    
	       // ===============================================================================================================
	       // cas ganéral
	       // ===============================================================================================================
	       
	    }else {
	        // JE FAIS RIEN
	    }
	    
	    
	    $nbNumNav = configuration::get("nbBtnNumero");
	    
	    return new navigation($this->module, $this->page, $this->action, $this->section, $this->nbSections, $this->nav, $nbNumNav);
	}
	
	
	
	/**
	 * Teste si la propriété $propriete passée en paramètre existe (totalement ou partiellement) dans le tableau $donnees
	 * @param string $propriete : le nom de la propriété dont on veut tester l'existence
	 * @param string $type : "total" (valeur par défaut) pour tester l'existence de la totalité de la propriété $propriete. "partiel" pour s'avoir s'il existe au moins une propriété dont le nom commence par $propriete 
	 * @return boolean : true si la propriété $propriete existe dans le tableau $donnees ou s'il existe au moins une propriété dans le tableau $donnees dont le nom commence par $propriete. false sinon
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 * @exemple existe("encarts", "partiel") -> return true si "encartsGauche" ou "encartsDroite" existe dans $donnees
	 */
	private function existe($propriete, $type = "total") {
		if ($type == "total") {
			return isset($this->donnees[$propriete]);
		}elseif ($type == "partiel") {
			$nb = 0;
			foreach ($this->donnees as $nomPropriete => $valeurPropriete) {
				if (strlen($nomPropriete) >= strlen($propriete)) {
					if (substr_compare($nomPropriete, $propriete, 0, strlen($propriete)) == 0) {
						$nb++;
						break;
					}
				}
			}
			return ($nb != 0);
		}else {
			return false;
		}
	}
	
	/**
	 * Exécute la méthode du contrôleur en fonction de l'action à réaliser. Déclenche une exception en cas de problème.
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function executerAction() {
		if (method_exists($this, $this->action)) {
			$this->{$this->action}();	// mise en oeuvre du principe de REFLEXION. On exécute ici la méthode dont le nom est donné par la valeur de l'attribut action.
		}else {
			throw new Exception("[fichier] : " . __FILE__ . "<br/>[classe] : " . __CLASS__ . "<br/>[méthode] : " . __METHOD__ . "<br/>[message] : l 'action '". $this->action . "' n'est pas définie dans la classe '" . get_class($this) . "'.");
		}
	}
	
	/**
	 * La méthode abstraite defaut correspond à l'action par défaut. Les classes dérivées sont obligées d'implémenter cette methode.
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	public abstract function defaut();

	/**
	 * Génère la vue associée au contrôleur courant
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	protected function genererVue() {
		$vue = new vue($this->module, $this->page);
		$this->nettoyer($this->donnees);	// Le tableau $donnees est passé par référence
		$vue->generer($this->donnees);
	}
	
	/**
	 * Supprime les caractères \r, \n, \r\n et \t dans toutes les valeurs du tableau passé en paramètre.
	 * Le tableau est passé en paramètre par référence et la fonction est récursive
	 * @param array $tab : Les données à nettoyer fournies sous forme d'un tableau passé par référence
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	private function nettoyer(&$tab) {	// passage de paramètre PAR REFERENCE
		foreach ($tab as $cle => $valeur) {
			if (!is_array($valeur)) {
				if (is_string($valeur)) {
					$tab[$cle] = preg_replace("/(\r\n|\n|\r|\t)/", "", $valeur);
				}
			}else {
				$this->nettoyer($tab[$cle]); // appel récursif
			}
		}
	}
	
	/**
	 * Méthode permettant de retourner le fil d'Ariane
	 * @param null
	 * @return string : Le fil d'Ariane
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - juin 2017
	 */
	private function getFilAriane() {
		if ($this->module == "home") {
			return "home";
		}else {
			return "<a href='./index.php'>home</a> > <a href='./index.php?module=" . $this->module . "&amp;page=accueil'>" . $this->module . "</a> > " . $this->page;
		}
	}
	
	/**
	 * Renvoie le bloc relatif à l'authentification des visiteurs
	 * @param null
	 * @return string : les informations relatives au visiteur authentifié ou le formulaire d'authentification (le cas échéant)
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.1
	 * @copyright Christophe Goidin - juin 2017
	 */
	private function getAuthentification() {
		if (isset($_SESSION["compte"])) {
			echo "oui";
		}else {
			return fs::getContenuFichier("./formulaire/form.authentification.inc.php");
		}
	}
	
	/**
	 * Lit le contenu d'un fichier texte relatif au texte défilant et le renvoie sous forme d'un tableau associatif 
	 * @param string $fichier : le nom du fichier texte à analyser
	 * @return array : un tableau composé du titre et du contenu (un tableau de second niveau)
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.2
	 * @copyright Christophe Goidin - juin 2017
	 */
	protected function getTexteDefilant($fichier) {
		$fichier = configuration::get("adrTexteDefilant") . $fichier;
		if (($refFichier = fopen($fichier, "r")) !== False) {
			try {
				// Lecture du titre : On ignore les lignes n°1 et n°3 et on lit le contenu de la ligne n°2 à partir du caractère n°12
				fgets($refFichier);
				for ($i = 1; $i <= 11; $i++) {
					fgetc($refFichier);
				}
				$titre = fgets($refFichier);
				fgets($refFichier);
				
				// Lecture des textes qui doivent défiler
				while (!feof($refFichier)) {
					$tab = explode("#", fgets($refFichier));
					$contenu[$tab[0]] = $tab[1];
				}
				fclose($refFichier);
				return array("titre" => $titre, "contenu" => $contenu);
			}catch (Exception $e) {
				throw new Exception("[fichier] : " . __FILE__ . "<br/>[classe] : " . __CLASS__ . "<br/>[méthode] : " . __METHOD__ . "<br/>[message] : le contenu du fichier texte  " . $fichier . " n'est pas cohérent par rapport à la structure attendue.");
			}
		}else {
			throw new Exception("[fichier] : " . __FILE__ . "<br/>[classe] : " . __CLASS__ . "<br/>[méthode] : " . __METHOD__ . "<br/>[message] : le fichier texte défilant " . $fichier . " est introuvable");
		}
	}
	
	/**
	 * Renvoie les lignes du fichier texte passé en paramètre sous forme d'un tableau (utilisé notamment pour les textes de la galerie slidesjs de la page d'accueil du site)
	 * @param string $fichier : l'adresse relative du fichier texte à lire
	 * @return array : un tableau contenant les lignes du fichier texte $fichier
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.1
	 * @copyright Christophe Goidin - juin 2017
	 */
	protected function getContentFile($fichier) {
		if (($refFichier = fopen($fichier, "r")) !== False) {
			$i = 0;
			while (!feof($refFichier)) {
				$result[$i++] = fgets($refFichier);
			}
			fclose($refFichier);
			return $result;
		}else {
			throw new Exception("[fichier] : " . __FILE__ . "<br/>[classe] : " . __CLASS__ . "<br/>[méthode] : " . __METHOD__ . "<br/>[message] : le fichier texte " . $fichier . " est introuvable.");
		}
	}
	
	/**
	 * Méthode MAGIQUE permettant de retourner la valeur de l'élément correspondant à la clé $cle dans le tableau $donnees. Cette méthode se déclenche AUTOMATIQUEMENT lorsqu'on essaie de récupérer la valeur d'un attribut INEXISTANT
	 * @param string $cle : La cle de l'élément
	 * @return string : La valeur de l'élément correspondant à la clé $cle dans le tableau $donnees. Déclenche une exception si non trouvé
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.1
	 * @copyright Christophe Goidin - mai 2013
	 */
	public function __get($cle) {
		if (array_key_exists($cle, $this->donnees)) {
			return $this->donnees[$cle];
		}else {
			throw new Exception("[fichier] : " . __FILE__ . "<br/>[classe] : " . __CLASS__ . "<br/>[méthode] : " . __METHOD__ . "<br/>[message] : l 'élément dont la clé est " . $cle . " est introuvable");
		}
	}
	
	/**
	 * Méthode MAGIQUE permettant d'alimenter le tableau $donnees qui se déclenche AUTOMATIQUEMENT lorsqu'on fait référence à un attribut INEXISTANT
	 * @param string $cle : la clé de l'élément à ajouter au tableau
	 * @param string $valeur : la valeur de l'élément à ajouter au tableau
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.2
	 * @copyright Christophe Goidin - mai 2013
   	 */
	// VERSION A FAIRE EVOLUER car il y a une erreur s'il n'y a qu'un seul encart (à gauche ou à droite)
	public function __set2($cle, $valeur) {
		if (!array_key_exists($cle, $this->donnees)) {
			$this->donnees[$cle] = $valeur;
		}else {
			if (substr($cle, 0, 7) != "encarts") {	// on écrase l'ancienne valeur
				$this->donnees[$cle] = $valeur;
			}else {									// on garde la(les) ancienne(s) valeur(s) qu'on positionne dans un tableau avec la nouvelle valeur
				$val = $this->donnees[$cle];
				unset($this->donnees[$cle]);
				if (!is_array($val)) {				// si initialement il y avait une valeur "simple", on génère alors un tableau de 2 éléments composé de l'ancienne valeur ET de la nouvelle valeur
					$this->donnees[$cle][] = $val;
				}else {								// si initialement il y avait déjà un tableau, on ajoute alors la nouvelle valeur au tableau déjà existant
					$this->donnees[$cle] = $val;
				}
				$this->donnees[$cle][] = $valeur;
			}
		}
		
		
	
	}
	/*
	public function __set($cle,$valeur){
	    if(substr($cle,0,7) != "encarts"){
	        $this->donnees[$cle] = $valeur;
	    }else {
	        $this->donnees[$cle][] = $valeur;
	    }
	}
	*/
	
	public function __set($cle,$valeur){
	  	  $this->donnees[$cle] = $valeur;
	 }
	
	
	
	private function getChemin($unFichier){
	    if (strpos($unFichier, '.css') == true) {
	        return "<link rel='stylesheet' type='text/css' href='./css/"+$unFichier+"' />\n";
	    }elseif (strpos($unFichier, '') == ".js"){
	        return "";
	        
	    }
	}
	
	/**
	 * ajoute au tableau Donnee les encart x encoarts a afficher 
	 * @param integer : nombre d'encart(s) a afficher
	 * @author Loris Fariello
	 * @version 1.1
	 * @copyright Loris Fariello - octobre 2019
	 * @return ...
	 */
	    public function getEncart($nbEncart){
	        $lesEncarts = scandir("./texte/encart/");
	        for ($i = 0; $i < $nbEncart; $i++) {
// 	            do {
	                $nbAlea = rand(2, count($lesEncarts) -1);
	                $listeNbEncart[] = $nbAlea;
// 	            } while (in_array($nbAlea, $listNbEncart));
	            $listEncart[] = $lesEncarts[$nbAlea];
	        }
	       return $listEncart;
	    }
	
	   
	
	
} // class

?>

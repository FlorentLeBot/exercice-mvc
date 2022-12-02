<?php
require_once "Constantes.php";
require_once "metier/Adresse.php";

/**
 * 
*Classe permettant d'acceder en bdd pour inserer supprimer modifier
 * selectionner l'objet Adresse
 * @author pascal Lamy
 *
 */
class AdresseDB 
{
	private $db; // Instance de PDO
        public $last_id;
	
	public function __construct($db)
	{
		$this->db=$db;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Adresse en base de donnee
	 * @param Adresse $a
         * @param id_pers id personne
	 */
	public function ajout(Adresse $a, $id_pers)
	{
	$q = $this->db->prepare('INSERT INTO adresse(numero,rue,codepostal,ville,id_pers) values(:num,:rue,:cp,:v,:idp)');

	$q->bindValue(':num',$a->getNumero());
	$q->bindValue(':rue',$a->getRue());
	$q->bindValue(':cp',$a->getCodePostal());
	$q->bindValue(':v',$a->getVille());
	$q->bindValue(':idp',$id_pers);
		$q->execute();	
              $this->last_id=$this->db->lastInsertId();
		$q->closeCursor();
		$q = NULL;
	}
    /**
     * 
     * fonction de Suppression de l'objet Adresse
     * @param Adresse $a
     */
	public function suppression(Adresse $a){
	$q = $this->db->prepare('delete from adresse where id=:ident');
	$q->bindValue(':ident',$a->getId());
	$res=$q->execute();	
        
	$q->closeCursor();
	$q = NULL;
        return $res;
	}
/** 
	 * Fonction de modification d'une adresse
	 * @param Adresse $a
	 * @throws Exception
	 */
public function update(Adresse $a)
	{
		try {
		$q = $this->db->prepare('UPDATE adresse set numero=:n,rue=:r,codepostal=:c,ville=:v where id=:i');
		$q->bindValue(':i', $a->getId());	
		$q->bindValue(':n', $a->getNumero());	
		$q->bindValue(':r', $a->getRue());	
		$q->bindValue(':c', $a->getCodePostal());	
		$q->bindValue(':v', $a->getVille());	
		$q->execute();	
		$q->closeCursor();
		$q = NULL;
		}
		catch(Exception $e){
			throw new Exception(Constantes::EXCEPTION_DB_PERS_UP); 
			
		}
	}
	/**
	 * 
	 * Fonction qui retourne toutes les adresses
	 * @throws Exception
	 */
	public function selectAll(){
		
	$query = 'SELECT  id,numero,rue,codepostal,ville,id_pers FROM adresse';
		$q = $this->db->prepare($query);
		$q->execute();
		
		$arrAll = $q->fetchAll(PDO::FETCH_ASSOC);
		
		//si pas dadresse , on leve une exception
		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE);
		}
		
		$result=$arrAll;		
		//Clore la requ�te pr�par�e
		$q->closeCursor();
		$q = NULL;
		//retour du resultat
		return $result;
	}	
		/**
	 * 
	 * Fonction qui retourne l'adresse en fonction de son id
	 * @throws Exception
	 * @param $id
	 */
	public function selectAdresse($id){
		$query = 'SELECT id,numero,rue,codepostal,ville,id_pers FROM adresse  WHERE id= :id ';
		$q = $this->db->prepare($query);

	
		$q->bindValue(':id',$id);
	
		$q->execute();
		
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		//si pas d'e personne'adresse , on leve une exception

		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_ADRESSE); 
		
		}
		
		$result=$arrAll;		
	
		$q->closeCursor();
		$q = NULL;
		//conversion du resultat de la requete en objet adresse
		$res= $this->convertPdoAdr($result);
		//retour du resultat
		return $res;
	}	
	/**
	 * 
	 * Fonction qui convertie un PDO Adresse en objet Adresse
	 * @param $pdoAdr
	 * @throws Exception
	 */

	public function convertPdoAdr($pdoAdr){
	if(empty($pdoAdr)){
		throw new Exception(Constantes::EXCEPTION_DB_CONVERT_PERS);
	}
	//conversion du pdo en objet
	try {
	$obj=(object)$pdoAdr;
	$i= (int)$obj->id;
	$n= (int)$obj->numero;
	$c= (int) $obj->codepostal;
	//conversion de l'objet en objet adresse
	$adr=new Adresse($i,$n,$obj->rue,$c,$obj->ville);
	//affectation de l'id pers
	$adr->setId($obj->id);
	 	return $adr;	 
	}catch(Exception $e){
		throw new Exception(Constantes::EXCEPTION_DB_ADR_CONVERT); 
		
	}
}
        
    public function selectAdresseIdPers($id_pers){
		try {
		$query = 'SELECT id,numero,rue,codepostal,ville,id_pers FROM adresse  WHERE id_pers= :id ';
		$q = $this->db->prepare($query);

		$q->bindValue(':id',$id_pers);
	
		$q->execute();
		
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		//si pas d'e personne'adresse , on leve une exception
			if($arrAll==null){
				throw new Exception(Constantes::EXCEPTION_DB_ADR_UP);
			}
		
	
		$q->closeCursor();
		$q = NULL;
		//conversion du resultat de la requete en objet adresse
		$res= $this->convertPdoAdr($arrAll);
		//retour du resultat
		return $res;
	}catch(Exception $e){
		throw new Exception(Constantes::EXCEPTION_DB_ADR_UP); 
		
	}
	}	
        
}
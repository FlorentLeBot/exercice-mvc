<?php
require_once "Mediatheque.php";
/**
 * 
 * Classe metier definissant l'objet livre
 * @author pascal
 *
 */
class Livre extends Mediatheque{
	
	
	/**id du livre*/
	private $id;
	/**tite du livre*/
	private $titre;
	/**edition  du livre*/
	private $edition;
	/**information*/
	private $information;
	/**auteur*/
	private $auteur;
	//constructeur
	public function __construct($tit,$edi,$info,$aut){
		$this->auteur=$aut;
		$this->information=$info;
		$this->edition=$edi;
		$this->titre=$tit;
	}
	//getteurs
	public function getId(){
		return $this->id;
	}
	public function getTitre(){
		return $this->titre;
	}
	public function getEdition(){
		return $this->edition;
	}
	public function getInformation(){
		return $this->information;
	}
	public function getAuteur(){
		return $this->auteur;
	}
	//setteurs
	public function setId($i){
		$this->id=$i;
	}
	public function setTitre($t){
		$this->titre=$t;
	}
	public function setEdition($e){
		$this->edition=$e;
	}
	public function setInformation($i){
		$this->information=$i;
	}
	public function setAuteur($a){
		$this->auteur=$a;
	}
	//methode toString
public function __toString(){
		return '[' .$this->getId().', '
		.$this->getTitre(). ','
		.$this->getEdition(). ','
		.$this->getInformation(). ','
		.$this->getAuteur(). ']';
		
	}
}
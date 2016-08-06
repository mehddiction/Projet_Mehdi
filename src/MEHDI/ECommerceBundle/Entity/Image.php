<?php

namespace MEHDI\ECommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 *@ORM\HasLifecycleCallbacks()
 */
class Image
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $alt;

	/**
	*	@Assert\File(
	*	maxSize="6144k",
	*	)
	*/
	private $file;
	
	private $tempFileName;
	
	public function getWebPath(){
		return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
	}
	
	public function getUploadDir(){
		return 'images';
	}
	
	protected function getUploadRootDir(){
		return __DIR__.'/../../../../web/'.$this->getUploadDir();
	}
	
    /**
     * Get id
     *
     * @return int
     */
	 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
	
	public function getFile()
	{
		return $this->file;
	}
	
	public function setFile(UploadedFile $file){
		$this->file=$file;
		if(null!=$this->url){ //sert de vérifier s'il y'a une image pour le produit. Si oui, l'URL de l'ancienne image du produit est enregistré pour supprimer image plus tard
			$this->tempFileName=$this->url;
			$this->url=null;
			$this->alt=null;
		}
	}
	
	public function preUpload(){
		//Si absence de fichier
		if(null==$this->file){
			return;
		}
		//les deux fct en dessous appartiennent à Symfony 
		$this->url=$this->file->getExtension(); //initialisation du fichier par l'utilisation d'une fct où on récupère l'extension
		$this->alt=$this->file->getClientOriginalName(); //nom du fichier
	}
	
	public function upload(){
		if(null==$this->file){
			return;
		}
		if(null!=$this->tempFileName){ //s'il existe déjà une image, on la supprime (pour modifier l'image)
			$oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFileName;
			if(file_exists($oldFile)){
				unlink($oldFile);
			}
		}
		
		$this->file->move(
			$this->getUploadRootDir(), 	//Répertoire de destination
			$this->id.'.'.$this->url	//Nom du fichier à créer, ici "id.extension"
		); //copie l'image que le client vient de mettre
	}
	
	public function preRemoveUpload(){
		//Avant la suppression, on enregistre le nom complet du fichier
		$this->tempFileName=$this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
	}
	
	public function removeUpload(){
		//Suprression de l'image lors de la suppression du produit
		if(file_exists($this->tempFileName)){
			unlink($this->tempFileName);
		}
	}
	
	
}

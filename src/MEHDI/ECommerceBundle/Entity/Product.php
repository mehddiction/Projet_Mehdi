<?php

namespace MEHDI\ECommerceBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Product
  * @UniqueEntity("libelle")
 */
class Product
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $libelle;

    /**
     * @var string
     */
    private $prixUnitaire;

    /**
     * @var int
     */
    private $quantiteRestante;

    /**
     * @var \DateTime
     */
    private $dateAjout;

    /**
     * @var string
     */
    private $description;
	
	public function decreaseQty($qty){
		$this->quantiteRestante-=$qty;
	}
	
	
	public function __construct(){
		$this->dateAjout=new \DateTime();
		$this->quantiteRestante=0;
		$this->evaluation='0.0';
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Product
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set prixUnitaire
     *
     * @param string $prixUnitaire
     *
     * @return Product
     */
    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;

        return $this;
    }

    /**
     * Get prixUnitaire
     *
     * @return string
     */
    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    /**
     * Set quantiteRestante
     *
     * @param integer $quantiteRestante
     *
     * @return Product
     */
    public function setQuantiteRestante($quantiteRestante)
    {
        $this->quantiteRestante = $quantiteRestante;

        return $this;
    }

    /**
     * Get quantiteRestante
     *
     * @return int
     */
    public function getQuantiteRestante()
    {
        return $this->quantiteRestante;
    }

    /**
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     *
     * @return Product
     */
    public function setDateAjout($dateAjout)
    {
        $this->dateAjout = $dateAjout;

        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @var \MEHDI\ECommerceBundle\Entity\Image
     */
    private $image;

    /**
     * @var \MEHDI\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \MEHDI\ECommerceBundle\Entity\Category
     */
    private $category;


    /**
     * Set image
     *
     * @param \MEHDI\ECommerceBundle\Entity\Image $image
     *
     * @return Product
     */
    public function setImage(\MEHDI\ECommerceBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MEHDI\ECommerceBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set user
     *
     * @param \MEHDI\UserBundle\Entity\User $user
     *
     * @return Product
     */
    public function setUser(\MEHDI\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MEHDI\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \MEHDI\ECommerceBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\MEHDI\ECommerceBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \MEHDI\ECommerceBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}

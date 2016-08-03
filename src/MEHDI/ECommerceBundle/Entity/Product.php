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
    private $evaluation;

    /**
     * @var string
     */
    private $description;
	
	
	public function __construct(){
		$this->date=new \DateTime();
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
     * Set evaluation
     *
     * @param string $evaluation
     *
     * @return Product
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    /**
     * Get evaluation
     *
     * @return string
     */
    public function getEvaluation()
    {
        return $this->evaluation;
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
     * @var MEHDI\UserBundle\Entity\User
     */
    private $client;

    /**
     * @var MEHDI\ECommerceBundle\Entity\Category
     */
    private $category;

    /**
     * @var MEHDI\ECommerceBundle\Entity\Image
     */
    private $image;


    /**
     * Set client
     *
     * @param \MEHDI\UserBundle\Entity\User $client
     *
     * @return Product
     */
    public function setClient(\MEHDI\UserBundle\Entity\User $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \MEHDI\UserBundle\Entity\User
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set category
     *
     * @param \MEHDI\ECommerceBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\MEHDI\ECommerceBundle\Entity\Category $category)
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

    /**
     * Set image
     *
     * @param \MEHDI\ECommerceBundle\Entity\Image $image
     *
     * @return Product
     */
    public function setImage(\MEHDI\ECommerceBundle\Entity\Image $image)
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
}

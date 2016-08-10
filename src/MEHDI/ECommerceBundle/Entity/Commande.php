<?php

namespace MEHDI\ECommerceBundle\Entity;

/**
 * Commande
 */
class Commande
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateCommande;

    /**
     * @var string
     */
    private $montant;

    /**
     * @var int
     */
    private $quantiteChoisie;


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
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set montant
     *
     * @param string $montant
     *
     * @return Commande
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return string
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set quantiteChoisie
     *
     * @param integer $quantiteChoisie
     *
     * @return Commande
     */
    public function setQuantiteChoisie($quantiteChoisie)
    {
        $this->quantiteChoisie = $quantiteChoisie;

        return $this;
    }

    /**
     * Get quantiteChoisie
     *
     * @return int
     */
    public function getQuantiteChoisie()
    {
        return $this->quantiteChoisie;
    }
    /**
     * @var \MEHDI\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \MEHDI\ECommerceBundle\Entity\Product
     */
    private $product;


    /**
     * Set user
     *
     * @param \MEHDI\UserBundle\Entity\User $user
     *
     * @return Commande
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
     * Set product
     *
     * @param \MEHDI\ECommerceBundle\Entity\Product $product
     *
     * @return Commande
     */
    public function setProduct(\MEHDI\ECommerceBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \MEHDI\ECommerceBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}

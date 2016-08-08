<?php

namespace MEHDI\ECommerceBundle\Entity;

/**
 * Basket
 */
class Basket
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quantiteChoisie;

	public function __construct(){
		$this->quantiteChoisie=1;
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
     * Set quantiteChoisie
     *
     * @param integer $quantiteChoisie
     *
     * @return Basket
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
     * @return Basket
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
     * @return Basket
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

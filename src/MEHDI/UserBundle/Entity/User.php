<?php
// src/OC/UserBundle/Entity/User.php

namespace MEHDI\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 */
class User extends BaseUser
{
	/**
	*@var \DateTime
	* @ORM\Column(name="dateInscription", type="datetime")
	*
	*/
	private $dateInscription;
	
	/**
	*@var \String
	* @ORM\Column(name="adresse", type="string", length=255)
	*
	*/
	private $adresse;
	
	
/**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
   
  protected $id;

  public function __construct(){
	  parent::__construct();
	  $this->dateInscription=new \DateTime();
	  //correspond à la date système
	  
  }
  
    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return User
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return User
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}

<?php

namespace Kalkulator\KalkulatorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Kalkulator\KalkulatorBundle\Repository\DanieRepository")
 * @ORM\Table(name="danie")
 */
class Danie {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="smallint", length=4)
     * 
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 9999
     * )
     */
    private $gram;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Produkt"
     * )
     * @ORM\JoinColumn(
     *      name = "produkt_id",
     *      referencedColumnName = "id",
     *      onDelete = "SET NULL"
     * )
     */
    
    private $produkty;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Dzien",
     *	    inversedBy = "dania"
     * )
     * @ORM\JoinColumn(
     *      name = "dzien_id",
     *      referencedColumnName = "id",
     *      onDelete = "CASCADE"
     * )
     */

     private $dzien_id;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gram
     *
     * @param integer $gram
     * @return Danie
     */
    public function setGram($gram)
    {
        $this->gram = $gram;

        return $this;
    }

    /**
     * Get gram
     *
     * @return integer 
     */
    public function getGram()
    {
        return $this->gram;
    }

    /**
     * Set produkty
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Produkt $produkty
     * @return Danie
     */
    public function setProdukty(\Kalkulator\KalkulatorBundle\Entity\Produkt $produkty = null)
    {
        $this->produkty = $produkty;

        return $this;
    }

    /**
     * Get produkty
     *
     * @return \Kalkulator\KalkulatorBundle\Entity\Produkt 
     */
    public function getProdukty()
    {
        return $this->produkty;
    }

    /**
     * Set dzien
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Dzien $dzien
     * @return Danie
     */
    public function setDzien(\Kalkulator\KalkulatorBundle\Entity\Dzien $dzien = null)
    {
        $this->dzien = $dzien;

        return $this;
    }

    /**
     * Get dzien
     *
     * @return \Kalkulator\KalkulatorBundle\Entity\Dzien 
     */
    public function getDzien()
    {
        return $this->dzien;
    }

    /**
     * Set dzien_id
     *
     * @param \Kalkulator\KalkulatorBundle\Entity\Dzien $dzienId
     * @return Danie
     */
    public function setDzienId(\Kalkulator\KalkulatorBundle\Entity\Dzien $dzienId = null)
    {
        $this->dzien_id = $dzienId;

        return $this;
    }

    /**
     * Get dzien_id
     *
     * @return \Kalkulator\KalkulatorBundle\Entity\Dzien 
     */
    public function getDzienId()
    {
        return $this->dzien_id;
    }
}

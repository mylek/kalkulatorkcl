<?php

namespace Kalkulator\KalkulatorBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Kalkulator\KalkulatorBundle\Repository\ProduktRepository")
 * @ORM\Table(name="produkt")
 */
class Produkt {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 255
     * )
     */
    private $nazwa;
    
    /**
     * @ORM\Column(type="smallint", length=4)
     * 
     * @Assert\Range(
     *      max = 999,
     *      min = 0
     * )
     */
    private $porcja;
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * 
     * @Assert\Range(
     *      max = 999,
     *      min = 0
     * )
     */
    private $cena = 0;
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotBlank
     * 
     * @Assert\Range(
     *      max = 999,
     *      min = 0
     * )
     */
    private $kalorii;
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * 
     * @Assert\NotBlank
     * @Assert\Range(
     *      max = 999,
     *      min = 0
     * )
     */
    private $bialka;
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * 
     * @Assert\NotBlank
     * @Assert\Range(
     *      max = 999,
     *      min = 0
     * )
     */
    private $wegle;
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * 
     * @Assert\NotBlank
     * @Assert\Range(
     *      max = 999,
     *      min = 0
     * )
     */
    private $tluszcze;
    
    /**
     * @ORM\ManyToOne(
     *      targetEntity = "Common\UserBundle\Entity\User"
     * )
     * 
     * @ORM\JoinColumn(
     *      name = "user_id",
     *      referencedColumnName = "id",
     *	    onDelete = "CASCADE",
     *      nullable = true	
     * )
     */
    private $user;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\Length(
     *      max = 255
     * )
     */
    private $kategoria = 'Inne';
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $usun = 0;
    
    public function save() {
        $parametry = array('nazwa', 'porcja', 'cena', 'kalorii', 'bialka', 'wegle', 'tluszcze');
        $formData = array();
        foreach ($parametry as $dd => $nazwa) {
            $formData[$nazwa] = $this->{$nazwa};
        }
    }    

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
     * Set nazwa
     *
     * @param string $nazwa
     * @return Produkt
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }
    
    /**
     * Set $kategoria
     *
     * @param string $kategoria
     * @return Produkt
     */
    public function setKategoria($kategoria)
    {
        $this->kategoria = $kategoria;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }
    
    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getKategoria()
    {
        return $this->kategoria;
    }

    /**
     * Set porcja
     *
     * @param integer $porcja
     * @return Produkt
     */
    public function setPorcja($porcja)
    {
        $this->porcja = str_replace(',', '.', $porcja);

        return $this;
    }

    /**
     * Get porcja
     *
     * @return integer 
     */
    public function getPorcja()
    {
        return $this->porcja;
    }

    /**
     * Set cena
     *
     * @param string $cena
     * @return Produkt
     */
    public function setCena($cena)
    {
        $this->cena = str_replace(',', '.', $cena);

        return $this;
    }

    /**
     * Get cena
     *
     * @return string 
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set kalorii
     *
     * @param string $kalorii
     * @return Produkt
     */
    public function setKalorii($kalorii)
    {
        $this->kalorii = str_replace(',', '.', $kalorii);

        return $this;
    }

    /**
     * Get kalorii
     *
     * @return string 
     */
    public function getKalorii()
    {
        return $this->kalorii;
    }

    /**
     * Set bialka
     *
     * @param string $bialka
     * @return Produkt
     */
    public function setBialka($bialka)
    {
        $this->bialka = str_replace(',', '.', $bialka);

        return $this;
    }

    /**
     * Get bialka
     *
     * @return string 
     */
    public function getBialka()
    {
        return $this->bialka;
    }

    /**
     * Set wegle
     *
     * @param string $wegle
     * @return Produkt
     */
    public function setWegle($wegle)
    {
        $this->wegle = str_replace(',', '.', $wegle);

        return $this;
    }

    /**
     * Get wegle
     *
     * @return string 
     */
    public function getWegle()
    {
        return $this->wegle;
    }

    /**
     * Set tluszcze
     *
     * @param string $tluszcze
     * @return Produkt
     */
    public function setTluszcze($tluszcze)
    {
        $this->tluszcze = str_replace(',', '.', $tluszcze);

        return $this;
    }

    /**
     * Get tluszcze
     *
     * @return string 
     */
    public function getTluszcze()
    {
        return $this->tluszcze;
    }

    /**
     * Set usun
     *
     * @param boolean $usun
     * @return Produkt
     */
    public function setUsun($usun)
    {
        $this->usun = $usun;

        return $this;
    }

    /**
     * Get usun
     *
     * @return boolean 
     */
    public function getUsun()
    {
        return $this->usun;
    }

    /**
     * Set user
     *
     * @param \Common\UserBundle\Entity\User $user
     * @return Produkt
     */
    public function setUser(\Common\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Common\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}

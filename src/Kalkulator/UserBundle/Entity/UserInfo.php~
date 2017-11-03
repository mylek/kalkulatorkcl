<?php

namespace Rexi\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Common\UserBundle\Entity\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_info")
 */
class UserInfo {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Common\UserBundle\Entity\User", inversedBy="info")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $id_user;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $imie;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $nazwisko;
    
    /**
     * @ORM\Column(type="string", length = 16)
     */
    private $pesel;
    
    /**
     * @ORM\Column(type="string", length = 16)
     */
    private $nr_dowodu;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $imie_drugie;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $miasto;
    /**
     * @ORM\Column(type="string", length = 128)
     */
    private $ulica;
    
    /**
     * @ORM\Column(type="string", length = 8)
     */
    private $nr_domu;
    
    /**
     * @ORM\Column(type="string", length = 8)
     */
    private $nr_lokalu;
    
    /**
     * @ORM\Column(type="string", length = 16)
     */
    private $telefon;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $stanowisko;
    
    /**
     * @ORM\Column(type="string", length = 64)
     */
    private $funkcja;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $wyksztalcenie = null;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $imie_ojca;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $imie_matki;
    
    /**
     * @ORM\Column(name="data_urodzenia", type="date", nullable=true)
     */
    private $data_urodzenia;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $plec;
    
    /**
     * @ORM\Column(type="string", length = 6, nullable=true)
     */
    private $kod_pocztowy;
    
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $miejscowosc;
    
    /**
     * @ORM\Column(type="string", length = 6, nullable=true)
     */
    private $kod_pocztowy_zamieszkania;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $miasto_zamieszkania;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $miejscowosc_zamieszkania;
    
    /**
     * @ORM\Column(type="string", length = 128, nullable=true)
     */
    private $ulica_zamieszkania;
    
    /**
     * @ORM\Column(type="string", length = 8, nullable=true)
     */
    private $nr_domu_zamieszkania;
    
    /**
     * @ORM\Column(type="string", length = 8, nullable=true)
     */
    private $nr_lokalu_zamieszkania;
    
    /**
     * @ORM\Column(type="string", length = 6, nullable=true)
     */
    private $kod_pocztowy_korespondencji;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $miasto_korespondencji;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $miejscowosc_korespondencji;
    
    /**
     * @ORM\Column(type="string", length = 128, nullable=true)
     */
    private $ulica_korespondencji;
    
    /**
     * @ORM\Column(type="string", length = 8, nullable=true)
     */
    private $nr_domu_korespondencji;
    
    /**
     * @ORM\Column(type="string", length = 8, nullable=true)
     */
    private $nr_lokalu_korespondencji;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $miejsce_urodzenia;
    
    /**
     * @ORM\Column(name="data_wydania_dowodu", type="date", nullable=true)
     */
    private $data_wydania_dowodu;
    
    /**
     * @ORM\Column(name="data_waznosci_dowodu", type="date", nullable=true)
     */
    private $data_waznosci_dowodu;
    
    /**
     * @ORM\Column(type="string", length = 64, nullable=true)
     */
    private $organizacja_wydajaca_dowodu;
    


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
     * Set imie
     *
     * @param string $imie
     * @return UserInfo
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string 
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     * @return UserInfo
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string 
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Set id_user
     *
     * @param \Common\UserBundle\Entity\User $idUser
     * @return UserInfo
     */
    public function setIdUser(\Common\UserBundle\Entity\User $idUser = null)
    {
        $this->id_user = $idUser;

        return $this;
    }

    /**
     * Get id_user
     *
     * @return \Common\UserBundle\Entity\User 
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Set pesel
     *
     * @param string $pesel
     * @return UserInfo
     */
    public function setPesel($pesel)
    {
        $this->pesel = $pesel;

        return $this;
    }

    /**
     * Get pesel
     *
     * @return string 
     */
    public function getPesel()
    {
        return $this->pesel;
    }

    /**
     * Set nr_dowodu
     *
     * @param string $nrDowodu
     * @return UserInfo
     */
    public function setNrDowodu($nrDowodu)
    {
        $this->nr_dowodu = $nrDowodu;

        return $this;
    }

    /**
     * Get nr_dowodu
     *
     * @return string 
     */
    public function getNrDowodu()
    {
        return $this->nr_dowodu;
    }

    /**
     * Set imie_drugie
     *
     * @param string $imieDrugie
     * @return UserInfo
     */
    public function setImieDrugie($imieDrugie)
    {
        $this->imie_drugie = $imieDrugie;

        return $this;
    }

    /**
     * Get imie_drugie
     *
     * @return string 
     */
    public function getImieDrugie()
    {
        return $this->imie_drugie;
    }

    /**
     * Set miasto
     *
     * @param string $miasto
     * @return UserInfo
     */
    public function setMiasto($miasto)
    {
        $this->miasto = $miasto;

        return $this;
    }

    /**
     * Get miasto
     *
     * @return string 
     */
    public function getMiasto()
    {
        return $this->miasto;
    }

    /**
     * Set ulica
     *
     * @param string $ulica
     * @return UserInfo
     */
    public function setUlica($ulica)
    {
        $this->ulica = $ulica;

        return $this;
    }

    /**
     * Get ulica
     *
     * @return string 
     */
    public function getUlica()
    {
        return $this->ulica;
    }

    /**
     * Set nr_domu
     *
     * @param integer $nrDomu
     * @return UserInfo
     */
    public function setNrDomu($nrDomu)
    {
        $this->nr_domu = $nrDomu;

        return $this;
    }

    /**
     * Get nr_domu
     *
     * @return integer 
     */
    public function getNrDomu()
    {
        return $this->nr_domu;
    }

    /**
     * Set nr_lokalu
     *
     * @param integer $nrLokalu
     * @return UserInfo
     */
    public function setNrLokalu($nrLokalu)
    {
        $this->nr_lokalu = $nrLokalu;

        return $this;
    }

    /**
     * Get nr_lokalu
     *
     * @return integer 
     */
    public function getNrLokalu()
    {
        return $this->nr_lokalu;
    }

    /**
     * Set telefon
     *
     * @param string $telefon
     * @return UserInfo
     */
    public function setTelefon($telefon)
    {
        $this->telefon = $telefon;

        return $this;
    }

    /**
     * Get telefon
     *
     * @return string 
     */
    public function getTelefon()
    {
        return $this->telefon;
    }

    /**
     * Set stanowisko
     *
     * @param string $stanowisko
     * @return UserInfo
     */
    public function setStanowisko($stanowisko)
    {
        $this->stanowisko = $stanowisko;

        return $this;
    }

    /**
     * Get stanowisko
     *
     * @return string 
     */
    public function getStanowisko()
    {
        return $this->stanowisko;
    }

    /**
     * Set funkcja
     *
     * @param string $funkcja
     * @return UserInfo
     */
    public function setFunkcja($funkcja)
    {
        $this->funkcja = $funkcja;

        return $this;
    }

    /**
     * Get funkcja
     *
     * @return string 
     */
    public function getFunkcja()
    {
        return $this->funkcja;
    }

    /**
     * Set wyksztalcenie
     *
     * @param integer $wyksztalcenie
     * @return UserInfo
     */
    public function setWyksztalcenie($wyksztalcenie)
    {
        $this->wyksztalcenie = $wyksztalcenie;

        return $this;
    }

    /**
     * Get wyksztalcenie
     *
     * @return integer 
     */
    public function getWyksztalcenie()
    {
        return $this->wyksztalcenie;
    }

    /**
     * Set imie_ojca
     *
     * @param string $imieOjca
     * @return UserInfo
     */
    public function setImieOjca($imieOjca)
    {
        $this->imie_ojca = $imieOjca;

        return $this;
    }

    /**
     * Get imie_ojca
     *
     * @return string 
     */
    public function getImieOjca()
    {
        return $this->imie_ojca;
    }

    /**
     * Set imie_matki
     *
     * @param string $imieMatki
     * @return UserInfo
     */
    public function setImieMatki($imieMatki)
    {
        $this->imie_matki = $imieMatki;

        return $this;
    }

    /**
     * Get imie_matki
     *
     * @return string 
     */
    public function getImieMatki()
    {
        return $this->imie_matki;
    }

    /**
     * Set data_urodzenia
     *
     * @param \DateTime $dataUrodzenia
     * @return UserInfo
     */
    public function setDataUrodzenia($dataUrodzenia)
    {
        $this->data_urodzenia = $dataUrodzenia;

        return $this;
    }

    /**
     * Get data_urodzenia
     *
     * @return \DateTime 
     */
    public function getDataUrodzenia()
    {
        return $this->data_urodzenia;
    }

    /**
     * Set plec
     *
     * @param integer $plec
     * @return UserInfo
     */
    public function setPlec($plec)
    {
        $this->plec = $plec;

        return $this;
    }

    /**
     * Get plec
     *
     * @return integer 
     */
    public function getPlec()
    {
        return $this->plec;
    }

    /**
     * Set kod_pocztowy
     *
     * @param string $kodPocztowy
     * @return UserInfo
     */
    public function setKodPocztowy($kodPocztowy)
    {
        $this->kod_pocztowy = $kodPocztowy;

        return $this;
    }

    /**
     * Get kod_pocztowy
     *
     * @return string 
     */
    public function getKodPocztowy()
    {
        return $this->kod_pocztowy;
    }

    /**
     * Set miejscowosc
     *
     * @param string $miejscowosc
     * @return UserInfo
     */
    public function setMiejscowosc($miejscowosc)
    {
        $this->miejscowosc = $miejscowosc;

        return $this;
    }

    /**
     * Get miejscowosc
     *
     * @return string 
     */
    public function getMiejscowosc()
    {
        return $this->miejscowosc;
    }

    /**
     * Set kod_pocztowy_zamieszkania
     *
     * @param string $kodPocztowyZamieszkania
     * @return UserInfo
     */
    public function setKodPocztowyZamieszkania($kodPocztowyZamieszkania)
    {
        $this->kod_pocztowy_zamieszkania = $kodPocztowyZamieszkania;

        return $this;
    }

    /**
     * Get kod_pocztowy_zamieszkania
     *
     * @return string 
     */
    public function getKodPocztowyZamieszkania()
    {
        return $this->kod_pocztowy_zamieszkania;
    }

    /**
     * Set miasto_zamieszkania
     *
     * @param string $miastoZamieszkania
     * @return UserInfo
     */
    public function setMiastoZamieszkania($miastoZamieszkania)
    {
        $this->miasto_zamieszkania = $miastoZamieszkania;

        return $this;
    }

    /**
     * Get miasto_zamieszkania
     *
     * @return string 
     */
    public function getMiastoZamieszkania()
    {
        return $this->miasto_zamieszkania;
    }

    /**
     * Set miejscowosc_zamieszkania
     *
     * @param string $miejscowoscZamieszkania
     * @return UserInfo
     */
    public function setMiejscowoscZamieszkania($miejscowoscZamieszkania)
    {
        $this->miejscowosc_zamieszkania = $miejscowoscZamieszkania;

        return $this;
    }

    /**
     * Get miejscowosc_zamieszkania
     *
     * @return string 
     */
    public function getMiejscowoscZamieszkania()
    {
        return $this->miejscowosc_zamieszkania;
    }

    /**
     * Set ulica_zamieszkania
     *
     * @param string $ulicaZamieszkania
     * @return UserInfo
     */
    public function setUlicaZamieszkania($ulicaZamieszkania)
    {
        $this->ulica_zamieszkania = $ulicaZamieszkania;

        return $this;
    }

    /**
     * Get ulica_zamieszkania
     *
     * @return string 
     */
    public function getUlicaZamieszkania()
    {
        return $this->ulica_zamieszkania;
    }

    /**
     * Set nr_domu_zamieszkania
     *
     * @param string $nrDomuZamieszkania
     * @return UserInfo
     */
    public function setNrDomuZamieszkania($nrDomuZamieszkania)
    {
        $this->nr_domu_zamieszkania = $nrDomuZamieszkania;

        return $this;
    }

    /**
     * Get nr_domu_zamieszkania
     *
     * @return string 
     */
    public function getNrDomuZamieszkania()
    {
        return $this->nr_domu_zamieszkania;
    }

    /**
     * Set nr_lokalu_zamieszkania
     *
     * @param string $nrLokaluZamieszkania
     * @return UserInfo
     */
    public function setNrLokaluZamieszkania($nrLokaluZamieszkania)
    {
        $this->nr_lokalu_zamieszkania = $nrLokaluZamieszkania;

        return $this;
    }

    /**
     * Get nr_lokalu_zamieszkania
     *
     * @return string 
     */
    public function getNrLokaluZamieszkania()
    {
        return $this->nr_lokalu_zamieszkania;
    }

    /**
     * Set kod_pocztowy_korespondencji
     *
     * @param string $kodPocztowyKorespondencji
     * @return UserInfo
     */
    public function setKodPocztowyKorespondencji($kodPocztowyKorespondencji)
    {
        $this->kod_pocztowy_korespondencji = $kodPocztowyKorespondencji;

        return $this;
    }

    /**
     * Get kod_pocztowy_korespondencji
     *
     * @return string 
     */
    public function getKodPocztowyKorespondencji()
    {
        return $this->kod_pocztowy_korespondencji;
    }

    /**
     * Set miasto_korespondencji
     *
     * @param string $miastoKorespondencji
     * @return UserInfo
     */
    public function setMiastoKorespondencji($miastoKorespondencji)
    {
        $this->miasto_korespondencji = $miastoKorespondencji;

        return $this;
    }

    /**
     * Get miasto_korespondencji
     *
     * @return string 
     */
    public function getMiastoKorespondencji()
    {
        return $this->miasto_korespondencji;
    }

    /**
     * Set miejscowosc_korespondencji
     *
     * @param string $miejscowoscKorespondencji
     * @return UserInfo
     */
    public function setMiejscowoscKorespondencji($miejscowoscKorespondencji)
    {
        $this->miejscowosc_korespondencji = $miejscowoscKorespondencji;

        return $this;
    }

    /**
     * Get miejscowosc_korespondencji
     *
     * @return string 
     */
    public function getMiejscowoscKorespondencji()
    {
        return $this->miejscowosc_korespondencji;
    }

    /**
     * Set ulica_korespondencji
     *
     * @param string $ulicaKorespondencji
     * @return UserInfo
     */
    public function setUlicaKorespondencji($ulicaKorespondencji)
    {
        $this->ulica_korespondencji = $ulicaKorespondencji;

        return $this;
    }

    /**
     * Get ulica_korespondencji
     *
     * @return string 
     */
    public function getUlicaKorespondencji()
    {
        return $this->ulica_korespondencji;
    }

    /**
     * Set nr_domu_korespondencji
     *
     * @param string $nrDomuKorespondencji
     * @return UserInfo
     */
    public function setNrDomuKorespondencji($nrDomuKorespondencji)
    {
        $this->nr_domu_korespondencji = $nrDomuKorespondencji;

        return $this;
    }

    /**
     * Get nr_domu_korespondencji
     *
     * @return string 
     */
    public function getNrDomuKorespondencji()
    {
        return $this->nr_domu_korespondencji;
    }

    /**
     * Set nr_lokalu_korespondencji
     *
     * @param string $nrLokaluKorespondencji
     * @return UserInfo
     */
    public function setNrLokaluKorespondencji($nrLokaluKorespondencji)
    {
        $this->nr_lokalu_korespondencji = $nrLokaluKorespondencji;

        return $this;
    }

    /**
     * Get nr_lokalu_korespondencji
     *
     * @return string 
     */
    public function getNrLokaluKorespondencji()
    {
        return $this->nr_lokalu_korespondencji;
    }

    /**
     * Set miejsce_urodzenia
     *
     * @param string $miejsceUrodzenia
     * @return UserInfo
     */
    public function setMiejsceUrodzenia($miejsceUrodzenia)
    {
        $this->miejsce_urodzenia = $miejsceUrodzenia;

        return $this;
    }

    /**
     * Get miejsce_urodzenia
     *
     * @return string 
     */
    public function getMiejsceUrodzenia()
    {
        return $this->miejsce_urodzenia;
    }

    /**
     * Set data_wydania_dowodu
     *
     * @param \DateTime $dataWydaniaDowodu
     * @return UserInfo
     */
    public function setDataWydaniaDowodu($dataWydaniaDowodu)
    {
        $this->data_wydania_dowodu = $dataWydaniaDowodu;

        return $this;
    }

    /**
     * Get data_wydania_dowodu
     *
     * @return \DateTime 
     */
    public function getDataWydaniaDowodu()
    {
        return $this->data_wydania_dowodu;
    }

    /**
     * Set data_waznosci_dowodu
     *
     * @param \DateTime $dataWaznosciDowodu
     * @return UserInfo
     */
    public function setDataWaznosciDowodu($dataWaznosciDowodu)
    {
        $this->data_waznosci_dowodu = $dataWaznosciDowodu;

        return $this;
    }

    /**
     * Get data_waznosci_dowodu
     *
     * @return \DateTime 
     */
    public function getDataWaznosciDowodu()
    {
        return $this->data_waznosci_dowodu;
    }

    /**
     * Set organizacja_wydajaca_dowodu
     *
     * @param string $organizacjaWydajacaDowodu
     * @return UserInfo
     */
    public function setOrganizacjaWydajacaDowodu($organizacjaWydajacaDowodu)
    {
        $this->organizacja_wydajaca_dowodu = $organizacjaWydajacaDowodu;

        return $this;
    }

    /**
     * Get organizacja_wydajaca_dowodu
     *
     * @return string 
     */
    public function getOrganizacjaWydajacaDowodu()
    {
        return $this->organizacja_wydajaca_dowodu;
    }
}

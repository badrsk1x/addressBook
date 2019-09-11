<?php
declare(strict_types=1);
namespace AppBundle\Entity;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Entity;

/**
* @ORM\Entity
* @ORM\Table(name="addressbook")
*/
class AddressBook
{
    /**
      * @var int
      *
      * @ORM\Column(name="rowid", type="integer",nullable=false)
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="IDENTITY")
      */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    private $firstname;


    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255,  nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="street_and_number", type="string", length=255, nullable=false)
     */
    private $streetAndNumber;

    /**
     * @var int
     *
     * @ORM\Column(name="zip", type="integer", nullable=false)
     */
    private $zip;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=false)
     */
    private $country;


    /**
     * @var string
     *
     * @ORM\Column(name="phonenumber", type="string", length=24, nullable=false)
     */
    private $phonenumber;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime", nullable=false)
     */
    private $birthday;


    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=500, nullable=true)
     *
     * @Assert\Image
     * @Assert\File(maxSize = "2M")
     */

    private $picture;


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
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Set email
     *
     * @param string $email
     *
     * @return AddressBook
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }



    /**
     * Set streetAndNumber
     *
     * @param string $streetAndNumber
     *
     * @return string
     */
    public function setStreetAndNumber($streetAndNumber)
    {
        $this->streetAndNumber = $streetAndNumber;

        return $this;
    }

    /**
     * Get $streetAndNumber
     *
     * @return string
     */
    public function getStreetAndNumber()
    {
        return $this->streetAndNumber;
    }


    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     *
     * @return string
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     *
     * @return string
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }




    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     *
     * @return string
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return string
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return string
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * @param string $phonenumber
     *
     * @return string
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param \DateTime $birthday
     *
     * @return \DateTime
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }



    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return string
     */
    public function setPicture($picture=null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}

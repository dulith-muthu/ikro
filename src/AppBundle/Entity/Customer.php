<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="nic", type="string", length=255)
     */
    private $nic;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=255)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="fixed", type="string", length=255)
     */
    private $fixed;

    /**
     * @ORM\OneToMany(targetEntity="Debt", mappedBy="customer")
     */

    private $debt;

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
     * Set name
     *
     * @param string $name
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set nic
     *
     * @param string $nic
     * @return Customer
     */
    public function setNic($nic)
    {
        $this->nic = $nic;

        return $this;
    }

    /**
     * Get nic
     *
     * @return string 
     */
    public function getNic()
    {
        return $this->nic;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Customer
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set fixed
     *
     * @param string $fixed
     * @return Customer
     */
    public function setFixed($fixed)
    {
        $this->fixed = $fixed;

        return $this;
    }

    /**
     * Get fixed
     *
     * @return string 
     */
    public function getFixed()
    {
        return $this->fixed;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->debt = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add debt
     *
     * @param \AppBundle\Entity\Debt $debt
     * @return Customer
     */
    public function addDebt(\AppBundle\Entity\Debt $debt)
    {
        $this->debt[] = $debt;

        return $this;
    }

    /**
     * Remove debt
     *
     * @param \AppBundle\Entity\Debt $debt
     */
    public function removeDebt(\AppBundle\Entity\Debt $debt)
    {
        $this->debt->removeElement($debt);
    }

    /**
     * Get debt
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDebt()
    {
        return $this->debt;
    }
}

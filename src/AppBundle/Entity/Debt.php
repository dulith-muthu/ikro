<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Debt
 *
 * @ORM\Table(name="debt")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DebtRepository")
 */
class Debt
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime")
     */
    private $dateTime;

    /**
     * @var string
     *
     * @ORM\Column(name="firstPayment", type="string", length=255)
     */
    private $firstPayment;

    /**
     * @var float
     *
     * @ORM\Column(name="interest", type="float")
     */
    private $interest;

    /**
     * @var float
     *
     * @ORM\Column(name="isClosed", type="integer")
     */
    private $isClosed;

    /**
     * @ORM\OneToMany(targetEntity="Installment", mappedBy="debt")
     */

    private $installment;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="debt")
     * @ORM\JoinColumn(name="customer", referencedColumnName="id")
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity="DebtSale", mappedBy="debt")
     */

    private $debtSale;

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
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Debt
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime 
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set firstPayment
     *
     * @param string $firstPayment
     * @return Debt
     */
    public function setFirstPayment($firstPayment)
    {
        $this->firstPayment = $firstPayment;

        return $this;
    }

    /**
     * Get firstPayment
     *
     * @return string 
     */
    public function getFirstPayment()
    {
        return $this->firstPayment;
    }

    /**
     * Set interest
     *
     * @param float $interest
     * @return Debt
     */
    public function setInterest($interest)
    {
        $this->interest = $interest;

        return $this;
    }

    /**
     * Get interest
     *
     * @return float 
     */
    public function getInterest()
    {
        return $this->interest;
    }

    /**
     * Set isClosed
     *
     * @param integer $isClosed
     * @return Debt
     */
    public function setIsClosed($isClosed)
    {
        $this->isClosed = $isClosed;

        return $this;
    }

    /**
     * Get isClosed
     *
     * @return integer 
     */
    public function getIsClosed()
    {
        return $this->isClosed;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->installment = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add installment
     *
     * @param \AppBundle\Entity\Installment $installment
     * @return Debt
     */
    public function addInstallment(\AppBundle\Entity\Installment $installment)
    {
        $this->installment[] = $installment;

        return $this;
    }

    /**
     * Remove installment
     *
     * @param \AppBundle\Entity\Installment $installment
     */
    public function removeInstallment(\AppBundle\Entity\Installment $installment)
    {
        $this->installment->removeElement($installment);
    }

    /**
     * Get installment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     * @return Debt
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}

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
}

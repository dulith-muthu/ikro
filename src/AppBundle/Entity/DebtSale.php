<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DebtSale
 *
 * @ORM\Table(name="debt_sale")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DebtSaleRepository")
 */
class DebtSale
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
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="debtSale")
     * @ORM\JoinColumn(name="item", referencedColumnName="id")
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="Debt", inversedBy="debtSale")
     * @ORM\JoinColumn(name="debt", referencedColumnName="id")
     */
    private $debt;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="soldPrice", type="float")
     */
    private $soldPrice;


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
     * @return DebtSale
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
     * Set quantity
     *
     * @param integer $quantity
     * @return DebtSale
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set soldPrice
     *
     * @param float $soldPrice
     * @return DebtSale
     */
    public function setSoldPrice($soldPrice)
    {
        $this->soldPrice = $soldPrice;

        return $this;
    }

    /**
     * Get soldPrice
     *
     * @return float 
     */
    public function getSoldPrice()
    {
        return $this->soldPrice;
    }

    /**
     * Set item
     *
     * @param \AppBundle\Entity\Item $item
     * @return DebtSale
     */
    public function setItem(\AppBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \AppBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set debt
     *
     * @param \AppBundle\Entity\Debt $debt
     * @return DebtSale
     */
    public function setDebt(\AppBundle\Entity\Debt $debt = null)
    {
        $this->debt = $debt;

        return $this;
    }

    /**
     * Get debt
     *
     * @return \AppBundle\Entity\Debt 
     */
    public function getDebt()
    {
        return $this->debt;
    }
}

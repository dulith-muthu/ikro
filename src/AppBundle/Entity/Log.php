<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Log
 *
 * @ORM\Table(name="log")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LogRepository")
 */
class Log
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTime", type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\ManyToOne(targetEntity="LogAction", inversedBy="log")
     * @ORM\JoinColumn(name="action_id", referencedColumnName="id")
     */
    private $action;

    /**
     * @ORM\ManyToOne(targetEntity="LogType", inversedBy="log")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="loggedId", type="string", length=255)
     */
    private $loggedId;

    /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="log")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user_id;

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
     * Set description
     *
     * @param string $description
     * @return Log
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Log
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
     * Set action
     *
     * @param string $action
     * @return Log
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set loggedId
     *
     * @param string $loggedId
     * @return Log
     */
    public function setLoggedId($loggedId)
    {
        $this->loggedId = $loggedId;

        return $this;
    }

    /**
     * Get loggedId
     *
     * @return string 
     */
    public function getLoggedId()
    {
        return $this->loggedId;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\LogType $type
     * @return Log
     */
    public function setType(\AppBundle\Entity\LogType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\LogType 
     */
    public function getType()
    {
        return $this->type;
    }

    

    /**
     * Set user_id
     *
     * @param \AppBundle\Entity\Users $userId
     * @return Log
     */
    public function setuser_Id(\AppBundle\Entity\Users $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return \AppBundle\Entity\Users 
     */
    public function getuser_Id()
    {
        return $this->user_id;
    }

    /**
     * Set user_id
     *
     * @param \AppBundle\Entity\Users $userId
     * @return Log
     */
    public function setUserId(\AppBundle\Entity\Users $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return \AppBundle\Entity\Users 
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}

<?php

/**
 * Created by PhpStorm.
 * User: shan
 * Date: 2/1/17
 * Time: 11:10 PM
 */

namespace AppBundle\Services\Log;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Log;

class LogService
{

    protected $em;
    protected $user;
    public function __construct(EntityManager $entityManager, $securityContext) {
        $this->em = $entityManager;
        $this->user = $securityContext->getToken()->getUser();
    }

    private function getRepository($class)
    {
        return $this->em->getRepository('AppBundle:'.$class);
    }

    public function addLog($logType,$description,$action,$loggedId)
    {
        $log = new Log();
        $logType = $this->getRepository('LogType')->findOneBy(array('metacode'=>$logType));
        $action = $this->getRepository('LogAction')->findOneBy(array('metacode'=>$action));
        $log->setDescription($description);
        $log->setDateTime(new \DateTime());
        $log->setType($logType);
        $log->setAction($action);
        $log->setLoggedId($loggedId);

        $this->insert($log);
    }

    private function insert($log){
        $this->em->persist($log);
        $this->em->flush();
    }
}

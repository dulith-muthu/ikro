<?php
/**
 * Created by PhpStorm.
 * User: ashan
 * Date: 2/6/2017
 * Time: 3:48 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Form\CustomerType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class LogController extends BaseController
{
    /**
     * @Route("/admin/log/list", name="logList")
     */

    public function logListAction(Request $request)
    {


        $logTypeReceived = $request->get('logType');
        $logType = $this->getRepository('LogType')->findOneBy(array('metacode'=>$logTypeReceived));
        $logActionReceived = $request->get('logAction');
        $logAction = $this->getRepository('LogAction')->findOneBy(array('metacode'=>$logActionReceived));
        $userReceived = $request->get('user');
        $startDateReceived = $request->get('startDate');
        $endDateReceived = $request->get('endDate');
        $user = null;
        if($userReceived!=null){
            $user = $this->getRepository('Users')->find($userReceived);
        }


        if($logTypeReceived != null || $logActionReceived!= null || $userReceived!= null || $startDateReceived!= null || $endDateReceived!= null){
            $logs = $this->getRepository('Log')->search($logAction,$logType,$user,$startDateReceived,$endDateReceived);
        }
        else{
            $logs = $this->getRepository('Log')->findAll();
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $logs, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );


        return $this->render('log/logList.html.twig',array(
            'logs'=>$pagination,
            'logTypes'=>($this->getRepository('LogType')->findAll()),
            'selectedLogType'=>$logTypeReceived,
            'logActions'=>($this->getRepository('LogAction')->findAll()),
            'selectedLogAction'=>$logActionReceived,
            'userList'=>($this->getRepository('Users')->findAll()),
            'selectedStartDate'=>$startDateReceived,
            'selectedEndDate'=>$endDateReceived,
            'selectedUser'=>$userReceived,
            'tab'=>$this->log
        ));
    }
}
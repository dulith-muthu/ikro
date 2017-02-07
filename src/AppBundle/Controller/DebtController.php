<?php
/**
 * Created by PhpStorm.
 * User: ashan
 * Date: 2/7/2017
 * Time: 11:47 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Customer;
use AppBundle\Form\CustomerType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DebtController extends BaseController
{
    /**
     * @Route("/admin/debt/list", name="debtList")
     */

    public function debtListAction(Request $request)
    {


        $isClosedReceived = $request->get('isClosed');
        $customerIdReceived = $request->get('customerId');
        $customer = $this->getRepository('Customer')->findOneBy(array('nic'=>$customerIdReceived));

        $startDateReceived = $request->get('startDate');
        $endDateReceived = $request->get('endDate');




        $debts = $this->getRepository('Debt')->search($isClosedReceived,$customer,$startDateReceived,$endDateReceived);


        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $debts, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );


        return $this->render('debt/debtList.html.twig',array(
            'debts'=>$pagination,
            'selectedCustomerId'=>$customerIdReceived,
            'selectedStartDate'=>$startDateReceived,
            'selectedEndDate'=>$endDateReceived,
            
            'tab'=>'DEBT'
        ));
    }
}
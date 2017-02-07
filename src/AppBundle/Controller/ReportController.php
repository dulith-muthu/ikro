<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends BaseController
{
    /**
     * @Route("/admin/report/salesPurchaseReport")
     */
    public function salesPurchaseReportAction(Request $request){
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $item = $request->get('item');


        if($startDate != null || $endDate!= null || $item!= null){
            $sales = $this->getRepository('Invoice')->search(new \DateTime($startDate),new \DateTime($endDate),$item);
        }
        else{
            $sales = $this->getRepository('Invoice')->findAll();
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $sales, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('report/salesPurchaseReport',array(
            'sales'=>$sales,
            'startDate'=>$startDate,
            'endDate' =>$endDate
        ));

    }
}

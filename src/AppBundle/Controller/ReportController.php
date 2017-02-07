<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends BaseController
{
    /**
     * @Route("/admin/report/salesPurchaseReport", name="salesPurchaseReport")
     */
    public function salesPurchaseReportAction(Request $request){
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $item = $request->get('item');


        if($startDate != null || $endDate!= null || $item!= null){
            $startDate = new \DateTime($startDate);
            $endDate = new \DateTime($endDate);
            $invoices = $this->getRepository('Invoice')->search($startDate,$endDate);
        }
        else{
            $startDate = new \DateTime('first day of this month');
            $endDate = new \DateTime('last day of this month');
            $invoices = $this->getRepository('Invoice')->search($startDate,$endDate);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $invoices, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('report/salesPurchaseReport.html.twig',array(
            'invoices'=>$pagination,
            'startDate'=>$startDate,
            'endDate' =>$endDate,
            'tab'=>$this->report,
            'subTab'=> $this->salesPurchaseReport
        ));

    }
}

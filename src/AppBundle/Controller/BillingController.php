<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 1/30/17
 * Time: 6:39 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class BillingController extends BaseController
{
    /**
     * @Route("/admin/bill", name="adminBill")
     */

    public function billingAction(Request $request){
        return $this->render('billing/billing.html.twig',array(
            'tab'=>$this->bill
        ));

    }

    /**
     * @Route("/admin/bill/purchase" ,name="billPurchase")
     */

    public function billingPurchaseAction(Request $request){

        $dataArray = $this->generateInvoice($request->get('bill'));


        return $this->render('billing/invoicePrintPurchase.html.twig',array(
            'customer' =>$dataArray[0],
            'invoice' =>$dataArray[1],
            'tab'=>$this->bill
        ));
    }

    /**
     * @Route("/admin/bill/quotation", name="billQuotation")
     */

    public function billingQuotationAction(Request $request){

        $dataArray = $this->generateInvoice($request->get('bill'));

        return $this->render('billing/invoicePrintQuotation.html.twig',array(
           'customer' =>$dataArray[0],
            'invoice' =>$dataArray[1],
            'tab'=>$this->bill
        ));

    }

    private function generateInvoice($data){
        $data = $this->objectDeserialize($data);
        $invoice = [];

        $customer = $data->customer;
        foreach ($data->data as $row){
            $tempObj = new \stdClass();
            $tempObj->itemCode = $row->itemCode;
            $tempObj->itemName = $row->itemName;
            $tempObj->quantity = $row->qty;
            $tempObj->price = $row->price;
            $discountType = $row->discType;
            $discount = $row->disc;

            if($discountType == 1){
                $tempObj->soldPrice = ((double)$row->price - (double)($row->price * $discount)/100);
                $tempObj->discount = $discount." %";
            }
            else{
                $tempObj->soldPrice = ($row->price - $discount);
                $tempObj->discount = $discount;
            }

            $tempObj->totalPrice = $tempObj->soldPrice * $tempObj->quantity;
            $invoice [] = $tempObj;

        }

        return array($customer,$invoice);
    }

}
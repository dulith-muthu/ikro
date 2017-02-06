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
        $data = $this->objectDeserialize($request->get('bill'));
        $invoice = [];

        $customer = $data->customer;
        var_dump($customer);

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

        return $this->render('billing/invoicePrintPurchase.html.twig',array(
            'customer' =>$customer,
            'invoice' =>$invoice,
            'tab'=>$this->purchaseBill
        ));
    }

}
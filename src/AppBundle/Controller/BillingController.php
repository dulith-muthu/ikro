<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 1/30/17
 * Time: 6:39 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Invoice;
use AppBundle\Entity\Sale;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


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


        $dataArray = $this->generateInvoice($request->get('data'));
        $stringifyArray = $this->objectSerialize($dataArray);



        return $this->render('billing/invoicePrintPurchase.html.twig',array(
            'customer' =>$dataArray[0],
            'invoice' =>$dataArray[1],
            'stringifyArray' =>$stringifyArray,
            'tab'=>$this->purchaseBill
        ));
    }

    /**
     * @Route("/admin/bill/purchase/save", name="billPurchaseSave")
     */

    public function billPurchaseSaveAction(Request $request){
        $dataArray = $this->objectDeserialize($request->get('invoice'));
        $customer = $dataArray[0];
        $invoiceSales = $dataArray[1];

        $em = $this->getDoctrine()->getManager();

        $dateTime = new \DateTime('now');

        $invoice = new Invoice();
        $invoice->setCustomerName($customer->name);
        $invoice->setCustomerAddress($customer->address);
        $invoice->setCustomerNic($customer->nic);
        $invoice->setCustomerPhone($customer->mobile);
        $invoice->setDateTime($dateTime);
        //Todo add total price of the invoice
        $this->insert($invoice);
        foreach ($invoiceSales as $saleItem){
            $sale = new Sale();
            $sale->setDateTime($dateTime);
            $sale->setQuantity($saleItem->quantity);
            $sale->setSoldPrice($saleItem->soldPrice);
            $sale->setDiscount($saleItem->discount);
            $item = $this->getRepository('Item')->findOneBy(array('itemCode'=>$saleItem->itemCode));
            $sale->setItem($item);
            $sale->setInvoice($invoice);


            $em->persist($sale);
        }
        $em->flush();

        $response = new \stdClass();
        $response->status = true;
        return new Response($response);
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
//        $data = $this->objectDeserialize($data);
//        $invoice = [];
//
//        $customer = $data->customer;
//        foreach ($data->data as $row){
//            $tempObj = new \stdClass();
//            $tempObj->itemCode = $row->itemCode;
//            $tempObj->itemName = $row->itemName;
//            $tempObj->quantity = $row->qty;
//            $tempObj->price = $row->price;
//            $discountType = $row->discType;
//            $discount = $row->disc;
//
//            if($discountType == 1){
//                $tempObj->soldPrice = ((double)$row->price - (double)($row->price * $discount)/100);
//                $tempObj->discount = $discount." %";
//            }
//            else{
//                $tempObj->soldPrice = ($row->price - $discount);
//                $tempObj->discount = $discount;
//            }
//
//            $tempObj->totalPrice = $tempObj->soldPrice * $tempObj->quantity;
//            $invoice [] = $tempObj;
//
//        }
        $customer = new \stdClass();
        $customer->name = "shan";
        $customer->nic = "943321205v";
        $customer->mobile="0712418805";
        $customer->home = "0413415456";
        $customer->address ="141/2";
        $invoice[0] = new \stdClass();
        $invoice[0]->itemCode ="101";
        $invoice[0]->itemName ="Chair";
        $invoice[0]->quantity =5;
        $invoice[0]->price = 1500;
        $invoice[0]->soldPrice = 1400;
        $invoice[0]->discount = 100;
        $invoice[0]->totalPrice = 7000;




        return array($customer,$invoice);
    }

}
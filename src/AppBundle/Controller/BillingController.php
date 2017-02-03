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
     * @Route("/admin/bill", name="bill")
     */

    public function billingAction(Request $request){
        return $this->render('billing/billing.html.twig');

    }

    /**
     * @Route("/bill/purchase" ,name="billPurchase")
     */

    public function billingPurchaseAction(Request $request){
        $data = $this->objectDeserialize($request->get('bill'));
        var_dump($data);
        exit;
    }

}
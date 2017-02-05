<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 1/30/17
 * Time: 7:23 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends BaseController
{
    /**
     * @Route("/", name="adminLogin")
     */
    public function loginAction(Request $request)
    {

        $auth_checker = $this->get('security.authorization_checker');


        $token = $this->get('security.token_storage')->getToken();

        $user = $token->getUser();



        $isRoleAdmin = $auth_checker->isGranted('ROLE_ADMIN');
        if($isRoleAdmin)
        {
            return $this->redirect(
                $this->generateUrl("adminDashboard")
            );
        }


        $authenticationUtils = $this->get('security.authentication_utils');

        $error =$authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUserName();
        return $this->render('default/login.html.twig',array(
            'last_username' =>$lastUsername,
            'error'=>$error
        ));
    }

    /**
     * @Route("/admin/dashboard", name="adminDashboard")
     */
    public function dashboardAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig');
    }


    /**
     * @Route("/admin/bill/customer/getSuggestionsByNic", name="getSuggestionsByNic")
     */
    public function userGetSuggestionsByNic(Request $request)
    {
        //Todo Move to the correct controller
        $nic = $request->get('nic');
        $customers = $this->getRepository('Customer')->getsuggestion($nic);
        $response = new \stdClass();
        $dataArray = [];

        if(count($customers)!= 0){
            $response->status = true;
            foreach ($customers as $customer){
                $tempObject = new \stdClass();
                $tempObject->name = $customer->getName();
                $tempObject->address = $customer->getAddress();
                $tempObject->nic = $customer->getNic();
                $tempObject->mobile = $customer->getMobile();
                $tempObject->fixed = $customer->getFixed();
                $dataArray[] = $tempObject;
            }
            $response->data = $dataArray;

        }else{
            $response->status = false;
        }

        return new Response($this->objectSerialize($response));
    }
}
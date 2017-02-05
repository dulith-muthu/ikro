<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Customer;
use AppBundle\Form\CustomerType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class CustomerController extends BaseController
{
    /**
     * @Route("/admin/customer/add", name="customerAdd")
     */

    public function customerAddAction(Request $request)
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() & $form->isValid()) {
            $this->insert($customer);

            $this->addFlash(
                'success',
                'Customer successfully added'
            );

            return $this->redirectToRoute('customerList');
        }

        return $this->render('customer/customerAdd.html.twig',array(
            'form' =>$form->createView()
        ));
    }


    /**
     * @Route("/admin/customer/edit/{id}", name="customerEdit")
     */

    public function customerEditAction(Request $request,$id)
    {
        $customer = $this->getRepository('Customer')->find($id);
        if($customer == null){
            $this->addFlash(
                'error',
                'Invalid customer!'
            );
            return $this->redirectToRoute('customerAdd');
        }
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() & $form->isValid()) {
            $this->insert($customer);

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            $this->get('app.log')->addLog('TYPE_CUSTOMER','customer added','ACTION_ADD',$customer->getId());


            return $this->redirectToRoute('customerList');
        }

        return $this->render('customer/customerEdit.html.twig',array(
            'form' =>$form->createView()
        ));
    }

    /**
     * @Route("/admin/customer/list", name="customerList")
     */

    public function customerListAction(Request $request)
    {
        $name = $request->get('name');
        $address = $request->get('address');
        $nic = $request->get('nic');
        $mobile = $request->get('mobile');
        $fixed = $request->get('fixed');


        if($name != null || $address!= null || $nic!= null || $mobile!= null || $fixed!= null){
            $customers = $this->getRepository('Customer')->search($name,$address,$nic,$mobile,$fixed);
        }
        else{
            $customers = $this->getRepository('Customer')->findAll();
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $customers, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('customer/customerList.html.twig',array(
           'customers'=>$pagination,
            'name'=>$name,
            'address'=>$address,
            'nic'=>$nic,
            'mobile'=>$mobile,
            'fixed'=>$fixed
        ));
    }


}

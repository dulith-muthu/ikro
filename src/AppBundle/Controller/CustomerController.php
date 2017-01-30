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
                'notice',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('customerAdd');
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
                'success',
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

            return $this->redirectToRoute('customerEdit');
        }

        return $this->render('customer/customerEdit.html.twig',array(
            'form' =>$form->createView()
        ));
    }
}

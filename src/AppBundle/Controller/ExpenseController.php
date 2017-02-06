<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 1/31/17
 * Time: 9:19 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Expense;
use AppBundle\Form\ExpenseType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ExpenseController extends BaseController
{
    /**
     * @Route("/admin/expense/add", name="expenseAdd")
     */

    public function expenseAddAction(Request $request){

        $expense = new Expense();
        $form = $this->createForm(ExpenseType::class, $expense);
        $form->handleRequest($request);


        if($form->isSubmitted() & $form->isValid()){
            $date = new \DateTime('now');

            $expense->setDateTime($date);
            $this->insert($expense);

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('expenseList');
        }

        return $this->render('expense/expenseAdd.html.twig',array(
            'form' => $form->createView(),
            'tab' =>$this->expense,
            'subTab'=>$this->expenseAdd
        ));

    }


    /**
     * @Route("/admin/expense/edit/{id}", name="expenseEdit")
     */

    public function expenseEditAction(Request $request,$id)
    {
        $expense = $this->getRepository('Expense')->find($id);
        if($expense == null){
            $this->addFlash(
                'success',
                'Invalid expense!'
            );
            return $this->redirectToRoute('expenseAdd');
        }
        $form = $this->createForm(ExpenseType::class, $expense);
        $form->handleRequest($request);
        if ($form->isSubmitted() & $form->isValid()) {
            $this->insert($expense);

            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('expenseList');
        }

        return $this->render('expense/expenseEdit.html.twig',array(
            'form' =>$form->createView(),
            'tab' =>$this->expense
        ));
    }

    /**
     * @Route("/admin/expense/list", name="expenseList")
     */

    public function expenseListAction(Request $request){
        $description = $request->get('description');
        $amount = $request->get('amount');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');


        if($description != null || $amount!= null || $startDate!= null || $endDate!= null ){
            $expenses = $this->getRepository('Expense')->search($description,$amount,$startDate,$endDate);
        }else{
            $expenses = $this->getRepository('Expense')->findAll();
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $expenses, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('expense/expenseList.html.twig',array(
            'expenses'=>$pagination,
            'description'=>$description,
            'amount'=>$amount,
            'startDate'=>$startDate,
            'endDate'=>$endDate,
            'tab' =>$this->expense,
            'subTab'=>$this->expenseList
        ));

    }
}
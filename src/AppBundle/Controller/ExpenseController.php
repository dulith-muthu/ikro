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

            return $this->redirectToRoute('expenseAdd');
        }

        return $this->render('expense/expenseAdd.html.twig',array(
            'form' => $form->createView()
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

            return $this->redirectToRoute('expenseEdit');
        }

        return $this->render('expense/expenseEdit.html.twig',array(
            'form' =>$form->createView()
        ));
    }
}
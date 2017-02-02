<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Item;
use AppBundle\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends BaseController
{
    /**
     * @Route("admin/item/add", name="itemAdd")
     */

    public function itemAddAction(Request $request)
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() & $form->isValid()) {
            $this->insert($item);

            $this->addFlash(
                'success',
                'Item successfully added'
            );

            return $this->redirectToRoute('itemList');

        }

        return $this->render('item/itemAdd.html.twig',array(
            'form' =>$form->createView()
        ));
    }


    /**
     * @Route("admin/item/edit/{id}", name="itemEdit")
     */

    public function itemEditAction(Request $request,$id)
    {
        $item = $this->getRepository('Item')->find($id);
        if($item == null){
            $this->addFlash(
                'error',
                'Invalid Item!'
            );

            return $this->redirectToRoute('itemAdd');

        }
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() & $form->isValid()) {
            $this->insert($item);

            $this->addFlash(
                'success',
                'Item successfully updated'
            );

            return $this->redirectToRoute('itemList');

        }

        return $this->render('item/itemEdit.html.twig',array(
            'form' =>$form->createView()
        ));
    }


    /**
     * @Route("/admin/item/list", name="itemList")
     */

    public function customerListAction(Request $request)
    {
        return new Response('Item List');
    }

}

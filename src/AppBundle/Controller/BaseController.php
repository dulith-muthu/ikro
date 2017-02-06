<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    public $expense = 'expense';
    public $bill = 'bill';
    public $customer = 'customer';




    public $customerAdd = 'customerAdd';
    public $customerList = 'customerList';

    public $expenseAdd = 'expenseAdd';
    public $expenseList = 'expenseList';


    protected function getRepository($class)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AppBundle:'.$class);
        return $repo;
    }

    protected function insert($object)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();
    }

    protected function remove($object)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();
    }

    protected function objectSerialize($object){
        //some encoding here
        return json_encode($object);
    }

    protected function objectDeserialize($text){
        // some decoding here
        return json_decode($text);
    }

    protected function apiSendResponse($object){
        $response =  new Response($this->objectSerialize($object));
        $responseHeaders = $response->headers;
        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $responseHeaders->set('Access-Control-Allow-Origin', '*');
        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }
}

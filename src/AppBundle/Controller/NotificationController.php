<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NotificationController extends BaseController
{
    /**
     * @Route("admin/notification/list", name="notificationList")
     */
    public function notificationListAction(Request $request){
        return new Response("notification List");
    }


}

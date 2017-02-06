<?php
/**
 * Created by PhpStorm.
 * User: shan
 * Date: 1/30/17
 * Time: 6:45 PM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class StockController extends BaseController
{
    /**
     * @Route("/admin/stock", name="adminStock")
     */

    public function stockAction(Request $request)
    {
        return $this->render('stock/stock.html.twig', array(
            'tab' => $this->stock
        ));

    }

}
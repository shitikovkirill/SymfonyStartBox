<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CallOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    /**
     * @Route("/order", name="order")
     */
    public function indexAction(Request $request)
    {
        $order = new CallOrder();
        $order->setPhone($request->get('tel'));
        $order->setIpAddress($request->getClientIp());
        $order->setBrowser($request->headers->get('User-Agent'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager -> persist($order);
        $entityManager -> flush();

        $response = new JsonResponse(['status'=>'ok', 'message'=>'Order added.']);
        $response->headers->setCookie(new Cookie('send_order', $order->getId()));
        return $response;
    }
}

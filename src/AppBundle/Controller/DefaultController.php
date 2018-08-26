<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use AppBundle\Entity\SecondSection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $entityManager = $this->container->get('doctrine.orm.default_entity_manager');
        $pageRep = $entityManager->getRepository(Page::class);
        $page = $pageRep ->findOneBy(['slug'=>'main']);

        return $this->render(
            'default/index.html.twig',
            [
                'page' => $page,
            ]
        );
    }
}

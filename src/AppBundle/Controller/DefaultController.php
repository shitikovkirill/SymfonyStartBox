<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Header;
use AppBundle\Entity\OurWorksCategory;
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
        $entityManager = $this->getDoctrine()->getManager();
        $ourWorksCategoryRep = $entityManager->getRepository(OurWorksCategory::class);
        $ourWorksCategories = $ourWorksCategoryRep->findAll();

        return $this->render(
            'default/index.html.twig',
            ['categories' => $ourWorksCategories]
        );
    }

    /**
     * @Route("our-work/{id}", name="our_work_item")
     */
    public function itemAction(Request $request, OurWorksCategory $category)
    {
        return $this->render(
            'default/our-work.html.twig',
            ['category' => $category]
        );
    }
}

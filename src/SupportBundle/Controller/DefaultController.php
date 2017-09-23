<?php

namespace SupportBundle\Controller;

use SupportBundle\Entity\Category;
use SupportBundle\Entity\Support;
use SupportBundle\Forms\FormCategory;
use SupportBundle\Forms\FormMakros;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/support")
 *
 * @Security("has_role('ROLE_EMPLOYEE')")
 *
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="support")
     */
    public function supportAction()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);

        $category = $repository->findAll();

        return $this->render('SupportBundle:Default:index.html.twig', array('category'=>$category,));
    }

}

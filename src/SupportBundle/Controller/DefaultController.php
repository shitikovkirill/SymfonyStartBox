<?php

namespace SupportBundle\Controller;

use SupportBundle\Entity\Category;
use SupportBundle\Entity\Support;
use SupportBundle\Forms\FormCategory;
use SupportBundle\Forms\FormMakros;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/support")
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

        $repository2 = $this->getDoctrine()->getRepository(Support::class);

        $makros = $repository2->findAll();

        $count = count($makros);

        return $this->render('SupportBundle:Default:index.html.twig', array('category'=>$category,
                                            'makros'=>$makros,
                                            'count'=>$count
        ));
    }


    /**
     * @Route("/add-category", name="add_category")
     */
    public function addAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(FormCategory::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('support');
        }

        return $this->render('SupportBundle:Default:addcategory.html.twig', array(
            'form_add_category' => $form->createView()
        ));
    }

    /**
     * @Route("/add-makros", name="add_makros")
     */
    public function addmakrosAction(Request $request)
    {
        $makros = new Support();
        $form = $this->createForm(FormMakros::class, $makros);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($makros);
            $em->flush();
            return $this->redirectToRoute('support');
        }

        return $this->render('SupportBundle:Default:addmakros.html.twig', array(
            'form_add_makros' => $form->createView()
        ));
    }

    /**
     *
     * @Route("/edit/{id}", name="edit_makroses", requirements={"id" = "\d+"})
     */
    public function editmakrosAction($id, Request $request)
    {
        $em = $this->getDoctrine();
        $makros = $em->getRepository(Support::class)->find($id);
        if(!$makros)
        {
            throw $this->createAccessDeniedException('You cannot access this page!');
        }
        $form = $this->createForm( FormMakros::class, $makros );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($makros);
            $em->flush();
            return $this->redirectToRoute('support');
        }
        return $this->render('SupportBundle:Default:editmakros.html.twig', array(
            'form_edit_makros' => $form->createView()
        ));

    }


    /**
     *
     * @Route("/delete/{id}", name="delete_makroses", requirements={"id" = "\d+"})
     */
    public function deletemakrosAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $makros = $em->getRepository(Support::class)->find($id);
        $em->remove($makros);
        $em->flush();
        return $this->redirectToRoute('support');
    }

    /**
     *
     * @Route("/delete/category/{id}", name="delete_category", requirements={"id" = "\d+"})
     */
    public function deletecategoryAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('support');
    }

}

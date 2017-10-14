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
        $categories = $repository->findBy(array('user' => null));
        return $this->render('SupportBundle:Default:index.html.twig', array('categories'=>$categories,
            'edit_able'=>false));
    }

    /**
     * @Route("/private", name="private")
     */
    public function privateAction()
    {
        $user = $this->getUser();
        $categories = $user->getCategories();
        

        return $this->render('SupportBundle:Default:index.html.twig', array('categories'=>$categories,
            'edit_able'=>true));
    }

    /**
     * @Route("/private/add-category", name="add_category")
     */
    public function addAction(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(FormCategory::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $category->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('private');
        }

        return $this->render('SupportBundle:Default:addcategory.html.twig', array(
            'form_add_category' => $form->createView()
        ));
    }

    /**
     * @Route("/private/add-makros/{id}", name="add_makros")
     */
    public function addMakrosAction(Category $category, Request $request)
    {
        $form = $this->createForm(FormMakros::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $support = new Support();
            $support ->setMakros($form->get('support')->getViewData());

            $category->addSupport($support);

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('private');
        }

        return $this->render('SupportBundle:Default:addmakros.html.twig', array(
            'form_add_makros' => $form->createView()
        ));
    }

    /**
     *
     * @Route("/private/edit/{id}", name="edit_makroses", requirements={"id" = "\d+"})
     */
    public function editMakrosAction(Support $support, Request $request)
    {
        if(!$support)
        {
            throw $this->createAccessDeniedException('You cannot access this page!');
        }
        $form = $this->createForm( FormMakros::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $support ->setMakros($form->get('support')->getViewData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($support);
            $em->flush();
            return $this->redirectToRoute('private');
        }
        return $this->render('SupportBundle:Default:editmakros.html.twig', array(
            'form_edit_makros' => $form->createView()
        ));

    }


    /**
     *
     * @Route("/private/delete/{id}", name="delete_makroses", requirements={"id" = "\d+"})
     */
    public function deleteMakrosAction(Support $support, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->executeQuery(
            'DELETE FROM category_supports WHERE support_id = :support_id',
            [   'support_id'   => $support->getId()]
        );
        $stmt->execute();
        $em->remove($support);
        $em->flush();
        return $this->redirectToRoute('private');
    }

    /**
     * @Route("/private/delete/category/{id}", name="delete_category", requirements={"id" = "\d+"})
     */
    public function deleteCategoryAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository(Category::class)->find($id);
        $em->remove($category);
        $em->flush();
        return $this->redirectToRoute('private');
    }

}

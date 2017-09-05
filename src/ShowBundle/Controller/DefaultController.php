<?php

namespace ShowBundle\Controller;

use ShowBundle\Entity\Shows;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShowBundle\Forms\FormType;
use ShowBundle\ShowBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Shows::class);

        $makro = $repository->findAll();
        return $this->render('ShowBundle:Default:index.html.twig', array('makro'=>$makro));
    }

    /**
     *
     * @Route("/edit/{id}", name="edit_makros", requirements={"id" = "\d+"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine();
        $makros = $em->getRepository(Shows::class)->find($id);
        if(!$makros)
        {
            throw $this->createAccessDeniedException('You cannot access this page!');
        }
        $form = $this->createForm( FormType::class, $makros );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($makros);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('ShowBundle:Default:edit.html.twig', array(
            'form_edit_makros' => $form->createView()
        ));

    }

    /**
     *
     * @Route("/delete/{id}", name="delete_makros", requirements={"id" = "\d+"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $makros = $em->getRepository(Shows::class)->find($id);
        $em->remove($makros);
        $em->flush();
        return $this->redirectToRoute('home');
    }



    /**
     * @Route("/add", name="add")
     */
    public function addAction(Request $request)
    {
        $makros = new Shows();
        $form = $this->createForm( FormType::class, $makros );
        $form->handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($makros);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('ShowBundle:Default:create.html.twig', array(
            'form_add_makros' => $form->createView()
        ));
    }
}

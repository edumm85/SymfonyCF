<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\formCreateNoticia;
use App\Entity\Noticia;

class NoticiaController extends AbstractController
{
    public function create(Request $request)
    {
        $noticia = new Noticia();
        $form=$this->createForm(formCreateNoticia::class,$noticia);
        
        
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $fechaActual= (new \DateTime('now'));
            $noticia->setFecha($fechaActual);
            $em=$this->getDoctrine()->getManager();
            $em->persist($noticia);
            $em->flush();
            return $this->redirectToRoute('listadonoticias');
        }
        
        return $this->render('noticia/create.html.twig', [
            'formu' => $form->createView(),
        ]);
    }

    public function listado()
    {
        $noticiasRep = $this->getDoctrine()->getRepository(Noticia::class);
        $noticias=$noticiasRep->findAll();

        return $this->render('noticia/listado.html.twig', [
            'noticias' => $noticias
        ]);
    }

    public function delete(Noticia $noticia)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($noticia);
        $em->flush();
        return $this->redirectToRoute('listadonoticias');
    }

    public function update(Request $request,Noticia $noticia)
    {
        $form=$this->createForm(formCreateNoticia::class,$noticia);
        

        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($noticia);
            $em->flush();
            return $this->redirectToRoute('listadonoticias');
        }

        return $this->render('noticia/create.html.twig', [
            'formu' => $form->createView(),
        ]);
    }

    public function detail(Noticia $noticia)
    {
        $noticiasRep = $this->getDoctrine()->getRepository(Noticia::class);
        $not=$noticiasRep->findById($noticia);

        return $this->render('noticia/detail.html.twig', [
            'noticia' => $not
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Seminario;
use App\Form\SeminarioType;
use App\Repository\SeminarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seminario")
 */
class SeminarioController extends AbstractController
{
    /**
     * @Route("/", name="seminario_index", methods={"GET"})
     */
    public function index(SeminarioRepository $seminarioRepository): Response
    {
        return $this->render('seminario/index.html.twig', [
            'seminarios' => $seminarioRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="seminario_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seminario = new Seminario();
        $form = $this->createForm(SeminarioType::class, $seminario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seminario);
            $entityManager->flush();

            return $this->redirectToRoute('seminario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seminario/new.html.twig', [
            'seminario' => $seminario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seminario_show", methods={"GET"})
     */
    public function show(Seminario $seminario): Response
    {
        return $this->render('seminario/show.html.twig', [
            'seminario' => $seminario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seminario_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seminario $seminario): Response
    {
        $form = $this->createForm(SeminarioType::class, $seminario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seminario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('seminario/edit.html.twig', [
            'seminario' => $seminario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seminario_delete", methods={"POST"})
     */
    public function delete(Request $request, Seminario $seminario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seminario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seminario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seminario_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Form\EventoType;
use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/evento")
 */
class EventoController extends AbstractController
{
    /**
     * @Route("/{year}", name="evento_index", methods={"GET"}, requirements={"year"="\d+"})
     */
    public function index(EventoRepository $eventoRepository, $year = ''): Response
    {

        if($year == '')
                $year = date("Y");
        $eventos = $eventoRepository->findAllbyYear($year);

        return $this->render('evento/index.html.twig', [
            //'eventos' => $eventoRepository->findAll(),
            'eventos' => $eventos,
        ]);
    }

    /**
     * @Route("/semana", name="evento_semana", methods={"GET"})
     */
    public function semana(EventoRepository $eventoRepository): Response
    {
        $eventos = $eventoRepository->findByWeek();

        return $this->render('evento/index.html.twig', [
            //'eventos' => $eventoRepository->findAll(),
            'eventos' => $eventos,
        ]);
    }

    /**
     * @Route("/new", name="evento_new", methods={"GET","POST"})
     */
    public function new(\Swift_Mailer $mailer, Request $request): Response
    {
        $evento = new Evento();
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $evento->setResponsables($evento->getSeminario()->getResponsablesStr());
            $entityManager->persist($evento);
            $entityManager->flush();

            // Mail
           /* $message = (new \Swift_Message('Alta de evento'))
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo(array($evento->getEmails() ))
                //->setTo('gerardo@matmor.unam.mx')
                ->setBcc(array('gerardo@matmor.unam.mx'))
                ->setBody($this->renderView('emails/evento.txt.twig', array('evento' => $evento)));

            ;
            $mailer->send($message);*/

            $this->addFlash('success', 'El evento se agreg?? correctamente.');

            return $this->redirectToRoute('evento_show', ['slug' => $evento->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evento/new.html.twig', [
            'evento' => $evento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="evento_show", methods={"GET"})
     */
    public function show(Evento $evento): Response
    {
        return $this->render('evento/show.html.twig', [
            'evento' => $evento,
        ]);
    }

    /**
     * @Route("/{slug}/edit", name="evento_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Evento $evento): Response
    {
        $form = $this->createForm(EventoType::class, $evento);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'El evento se modific?? correctamente.');

            return $this->redirectToRoute('evento_show', ['slug' => $evento->getSlug()], Response::HTTP_SEE_OTHER);
//            return $this->redirectToRoute('evento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('evento/edit.html.twig', [
            'evento' => $evento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="evento_delete", methods={"POST"})
     */
    public function delete(Request $request, Evento $evento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evento->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($evento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evento_index', [], Response::HTTP_SEE_OTHER);
    }
}

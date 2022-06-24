<?php

namespace App\Controller;

use App\Entity\ProgrammLanguage;
use App\Form\ProgrammLanguageType;
use App\Repository\ProgrammLanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/programm_language")
 */
class ProgrammLanguageController extends AbstractController
{
    /**
     * @Route("/", name="app_programm_language_index", methods={"GET"})
     */
    public function index(ProgrammLanguageRepository $programmLanguageRepository): Response
    {
        return $this->render('programm_language/index.html.twig', [
            'programm_languages' => $programmLanguageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_programm_language_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProgrammLanguageRepository $programmLanguageRepository): Response
    {
        $programmLanguage = new ProgrammLanguage();
        $form = $this->createForm(ProgrammLanguageType::class, $programmLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmLanguageRepository->add($programmLanguage, true);

            return $this->redirectToRoute('app_programm_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('programm_language/new.html.twig', [
            'programm_language' => $programmLanguage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_programm_language_show", methods={"GET"})
     */
    public function show(ProgrammLanguage $programmLanguage): Response
    {
        return $this->render('programm_language/show.html.twig', [
            'programm_language' => $programmLanguage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_programm_language_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProgrammLanguage $programmLanguage, ProgrammLanguageRepository $programmLanguageRepository): Response
    {
        $form = $this->createForm(ProgrammLanguageType::class, $programmLanguage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $programmLanguageRepository->add($programmLanguage, true);

            return $this->redirectToRoute('app_programm_language_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('programm_language/edit.html.twig', [
            'programm_language' => $programmLanguage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_programm_language_delete", methods={"POST"})
     */
    public function delete(Request $request, ProgrammLanguage $programmLanguage, ProgrammLanguageRepository $programmLanguageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$programmLanguage->getId(), $request->request->get('_token'))) {
            $programmLanguageRepository->remove($programmLanguage, true);
        }

        return $this->redirectToRoute('app_programm_language_index', [], Response::HTTP_SEE_OTHER);
    }
    
}

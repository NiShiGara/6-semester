<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Form\PicturesType;
use App\Repository\PicturesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/pictures")
 */
class PicturesController extends AbstractController
{
    /**
     * @Route("/", name="app_pictures_index", methods={"GET"})
     */
    public function index(PicturesRepository $picturesRepository): Response
    {
        return $this->render('pictures/index.html.twig', [
            'pictures' => $picturesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pictures_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PicturesRepository $PicturesRepository,
                        SluggerInterface $slugger): Response
    {
        $picture = new Pictures();
        $form = $this->createForm(PicturesType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
                $file->move(
                    'pictures',
                    $newFilename
                );
                $picture->setFile($newFilename);
                $PicturesRepository->add($picture, true);
            }

            return $this->redirectToRoute('app_pictures_index');
        }

        return $this->renderForm('pictures/new.html.twig', [
            'form' => $form,
        ]);
    }
}

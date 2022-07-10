<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Form\Type\AchatType;
use App\Repository\AchatRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourseController extends AbstractController
{
    private AchatRepository $achatRepository;

    public function __construct(AchatRepository $achatRepository)
    {
        $this->achatRepository = $achatRepository;
    }

    #[Route('/', name: 'liste_courses')]
    public function liste(): Response
    {   
        return $this->render('courses/liste.html.twig', [
            'achats' => $this->achatRepository->findAll()
        ]);
    }

    #[Route('/nouveau')]
    public function nouveau(Request $request, ManagerRegistry $doctrine): Response
    {   
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $achat = $form->getData();
            $achat->setPris(false);

            $entityManager = $doctrine->getManager();
            $entityManager->persist($achat);
            $entityManager->flush();

            return $this->redirectToRoute('liste_courses');
        }
        
        return $this->renderForm('courses/nouveau.html.twig', [
            'form' => $form,
        ]);
    }
}

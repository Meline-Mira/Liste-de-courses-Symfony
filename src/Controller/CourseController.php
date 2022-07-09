<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Form\Type\AchatType;
use App\Repository\AchatRepository;
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

    #[Route('/')]
    public function liste(): Response
    {   
        return $this->render('courses/liste.html.twig', [
            'achats' => $this->achatRepository->findAll()
        ]);
    }

    #[Route('/nouveau')]
    public function nouveau(Request $request): Response
    {   
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);

        return $this->renderForm('courses/nouveau.html.twig', [
            'form' => $form,
        ]);
    }
}

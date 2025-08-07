<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Wish;
use App\Form\UserType;
use App\Form\WishType;
use App\Repository\WisheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/wish', name: 'wish_')]
final class WishController extends AbstractController
{
    #[Route('/', name: 'list', methods: ['GET'])]
    public function list(WisheRepository $wisheRepository): Response
    {
       //$wishes = $wisheRepository->findAll();
       $wishes = $wisheRepository->findByCreateDate();

        return $this->render('wish/list.html.twig', compact('wishes'));
    }

    #[Route('/{id}', name: 'detail', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function detail(Wish $wish): Response
    {
        return $this->render('wish/detail.html.twig', compact('wish'));
    }

    #[Route('/creat', name: 'creat', methods: ['GET', 'POST'])]
    public function creat(Request $request, EntityManagerInterface $em): Response

    {
        $wish = new Wish();
        $form = $this->createForm(WishType::class, $wish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($wish);

            $wish->setDateCreated(new \DateTimeImmutable("now"));
            $wish->setIsPublished(true);

            $em->persist($wish);

            $em->flush();

            $this->addFlash("success", "Le souhait a été enregistré avec succès !");

            // Rediriger sur l'accueil
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);

        }

        return $this->render('wish/creat.html.twig', [
            'wishForm' => $form->createView(),
        ]);
    }


}

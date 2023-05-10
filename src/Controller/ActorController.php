<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Service\CacheServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActorController extends AbstractController
{
    /**
     * @Route("/actors", name="actors_list")
     */
    public function list(Request $request, PaginatorInterface $paginator, CacheServiceInterface $imageHelper, EntityManagerInterface $entityManager)
    {


        $actors = $entityManager->getRepository(Actor::class)->findAll();

        $pagination = $paginator->paginate(
            $actors,
            $request->query->getInt('page', 1),
            10 // items per page
        );

        return $this->render('showcase/list.html.twig', [
            'pagination' => $pagination,
            'imageHelper' => $imageHelper,
        ]);
    }
}
<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\{JsonResponse, Request};
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{



    public function list(Request $request, LoggerInterface $logger){
        $title = $request->get('title', 'Alegria');
        $logger->info('List action Calledc 2');
    }
    /**
     * @Route("book/create", name="create_book")
     */
    public function createBook(Request $request, EntityManagerInterface $em ){
        $book = new Book();
        $book->setTitle('Nuevo Libro');
        $book->setImage(null);
        $em->persist($book);
        $em->flush();
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $book->getId(),
                    'Title' => $book->setTitle(),
                    'image' =>$book->getImage()
                ]
            ]
        ]);
        return $response;
    }
}
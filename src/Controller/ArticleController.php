<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    public function homepage()
    {
        return new Response('Test msg!');
    }

    public function show($slug)
    {
        $comments = [
            'First comment',
            'Second comment',
            'Third comment'
            ];

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments
        ]);
    }
}
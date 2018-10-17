<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    public function homepage()
    {
        return $this->render('article/homepage.html.twig', []);
    }

    public function show($slug)
    {
        $comments = [
            'First comment',
            'Second comment',
            'Third comment'
            ];
        dump($slug, $this);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
            'slug' => $slug
        ]);
    }

    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article is being liked!');
        return $this->json(['hearts' => rand(5,20)]);
    }
}
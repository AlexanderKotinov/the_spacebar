<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleAdminController extends AbstractController
{
    public function index(EntityManagerInterface $em)
    {
        $rep = $em->getRepository(Article::class);
        $articles = $rep->findAll();

        return $this->render('article_admin/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    public function new(EntityManagerInterface $em)
    {
        $article = new Article();
        $title = 'Article title new '.(rand(1,500));
        $article->setTitle( $title )
            ->setContent('Some article content')
            ->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))))
            ->setSlug(strtolower(str_replace(' ', '-', $title) ))
            ->setHeartCount(rand(1, 40))
            ->setImageFilename('asteroid.jpeg')
            ->setAuthor('AlexK');
        $em->persist($article);
        $em->flush();

        return $this->json('');
    }
}

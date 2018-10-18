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
        $article->setTitle('Article title '.(rand(1,500)))
            ->setContent('Some article content')
            ->setPublishedAt(new \DateTime(sprintf('-%d days', rand(1, 100))))
            ->setSlug('Some slug here');
        $em->persist($article);
        $em->flush();
    }
}

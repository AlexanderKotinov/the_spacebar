<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    public function homepage(ArticleRepository $repository)
    {
        $articles = $repository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig', [
            'articles' => $articles
        ]);
    }

    public function show(Article $article, MarkdownHelper $markdownHelper, SlackClient $slack)
    {
//        if ($slug == 'aaa') {
//            $slack->sendMessage('Alex', 'new message');
//        }

        dump($article);
        $comments = [
            'First comment',
            'Second comment',
            'Third comment'
            ];

        $articleContent = <<<EOF
Spicy jalapeno **bacon** ipsum **dolor** amet veniam shank in dolore. Ham hock nisi landjaeger cow,
lorem proident beef ribs aute enim veniam ut cillum pork chuck picanha. Dolore reprehenderit
labore minim pork belly spare ribs cupim short loin in. [Elit exercitation](https://google.com) eiusmod dolore cow
turkey shank eu pork belly meatball non cupim.
EOF;

        return $this->render('article/show.html.twig', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function toggleArticleHeart(Article $article, LoggerInterface $logger, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush();

        $logger->info('Article is being liked!');
        return $this->json(['hearts' => $article->getHeartCount()]);
    }
}
<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use App\Service\SlackClient;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    public function homepage()
    {
        return $this->render('article/homepage.html.twig', []);
    }

    public function show($slug, MarkdownHelper $markdownHelper, SlackClient $slack)
    {
        if ($slug == 'aaa') {
            $slack->sendMessage('Alex', 'new message');
        }

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

        $articleContent = $markdownHelper->parse($articleContent);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'comments' => $comments,
            'slug' => $slug,
            'articleContent' => $articleContent
        ]);
    }

    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        $logger->info('Article is being liked!');
        return $this->json(['hearts' => rand(5,20)]);
    }
}
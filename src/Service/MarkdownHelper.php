<?php

namespace App\Service;


use Michelf\MarkdownInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Security\Core\Security;

class MarkdownHelper
{
    private $cache;

    private $markdown;

    private $security;

    private $logger;

    public function __construct(AdapterInterface $cache,
                                MarkdownInterface $markdown,
                                Security $security,
                                LoggerInterface $logger)
    {
        $this->cache = $cache;
        $this->markdown = $markdown;
        $this->security = $security;
        $this->logger = $logger;
    }

    public function parse(string $source): string
    {
        $item = $this->cache->getItem('markdown_'.md5($source));

        if (stripos($source, 'provident') !== false) {
            $this->logger->info('They are talking about bacon again!', [
                'user' => $this->security->getUser()
            ]);
        }

        if (!$item->isHit()) {
            $item->set($this->markdown->transform($source));
            $this->cache->save($item);
        }

        return $item->get();
    }
}
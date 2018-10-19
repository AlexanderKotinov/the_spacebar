<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class ArticleFixtures extends Fixture
{
    /**
     * @var Generator
     */
    protected $faker;

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $this->faker = Factory::create();

        for ($i=0; $i<=10; $i++) {
            $article = new Article();
            $title = $this->faker->text(30);
            $article->setTitle( $title )
                ->setContent($this->faker->text(100))
                ->setPublishedAt($this->faker->dateTimeBetween('-100 days', '-1 days'))
                ->setSlug($this->faker->slug)
                ->setHeartCount($this->faker->numberBetween('1', '200'))
                ->setImageFilename('asteroid.jpeg')
                ->setAuthor($this->faker->name('male'));
            $manager->persist($article);
            $manager->flush();
        }
    }
}

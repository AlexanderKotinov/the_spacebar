<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_user', function ($i) use ($manager){
            $user = new User();
            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);
            $user->setEmail(sprintf('email%d@mail.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            if ($this->faker->boolean) {
                $user->setTwitterUsername($this->faker->userName);
            }

            return $user;
        });

        $this->createMany(3, 'admin_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@mail.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;
        });

        $this->createMany(3, 'admin_users_article', function($i) {
            $user = new User();
            $user->setEmail(sprintf('adminArticle%d@mail.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN_ARTICLE']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;
        });

        $this->createMany(3, 'admin_users_comment', function($i) {
            $user = new User();
            $user->setEmail(sprintf('adminComment%d@mail.com', $i));
            $user->setFirstName($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN_COMMENT']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));

            return $user;
        });


        $manager->flush();
    }
}

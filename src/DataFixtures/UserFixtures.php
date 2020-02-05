<?php

namespace App\DataFixtures;

use App\Entity\User;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\String\Slugger\AsciiSlugger;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $slugger = new AsciiSlugger();

        $user = new User();
        $user->setEmail("admin@webforce.com")
        ->setPassword($this->passwordEncoder->encodePassword($user, "webforce"))
        ->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
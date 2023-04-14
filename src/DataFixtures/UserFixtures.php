<?php

namespace App\DataFixtures;


use App\Entity\UserPhp;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    /**
     * UserFixtures constructor.
     * @param UserPasswordHasherInterface
     */
    private UserPasswordHasherInterface $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new UserPhp();
        $user->setUserName('test');
        $user->setPassword($this->encoder->hashPassword($user, 'test'));
        $manager->persist($user);
        $manager->flush();
    }
}

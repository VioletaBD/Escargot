<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $password)
    {
        $this->password = $password;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setName('Simon');
        $user->setLastName('Toto');
        $user->setEmail('user@email.com');
        $user->setRoles(['ROLE_USER']);
        $password = $this->password->hashPassword(
            $user,
            'toto123'
        );
        $user->setPassword($password);
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail('admin@email.com');
        $admin->setName('Vio');
        $admin->setLastName('BD');
        $admin->setRoles(['ROLE_ADMIN']);
        $password = $this->password->hashPassword(
            $admin,
            'admin123'
        );
        $admin->setPassword($password);
        $manager->persist($admin);

        $manager->flush();
    }
}

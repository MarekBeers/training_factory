<?php

namespace App\DataFixtures;

use App\Entity\user;
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
        for ($i = 1; $i <= 2; $i++) {
            $manager->persist($this->user($i));
        }
        $manager->flush();
    }

    public function user($i)
    {
        $user = new user();
        $user->setEmail(sprintf('tester%d@gmail.com', $i));
        $user->setLoginname(sprintf('tester%d', $i));
        $user->setLastname(sprintf('tester%d', $i));
        $user->setFirstname(sprintf('tester%d', $i));
        $user->setDateofbirth(sprintf('tester%d', $i));
        $user->setGender(sprintf('tester%d', $i));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'wachtwoord'
        ));
        if ($i >= 2) {
            $role = array('ROLE_USER');
        } else {
            $role = array('ROLE_ADMIN');
        }
        $user->setRoles($role);
        return $user;
    }
}

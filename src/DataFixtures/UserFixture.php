<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends BaseFixture
{
    private $passwordEncoder;
    /** @var ObjectManager */
    private $manager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function loadData(ObjectManager $manager)
    {
//        $this->createMany(User::class, 1, function (User $user, $count) {
//            $user = new User();
//            $user->setEmail(sprintf('tester%d@gmail.com', $count));
//            $user->setFirstName(sprintf('tester%d', $count));
//            $user->setPassword($this->passwordEncoder->encodePassword(
//                $user,
//                'wachtwoord'
//            ));
//            $role = array('role_user');
//            $user->setRoles($role);
//            return $user;
//        });
//----------------------------------------------------------------------------------------------
//        $user = new User();
//        $user->setEmail(sprintf('tester%d@gmail.com', 1));
//        $user->setFirstname(sprintf('tester%d', 1));
//        $user->setPassword($this->passwordEncoder->encodePassword(
//            $user,
//            'wachtwoord'
//        ));
//        $role = array('role_user');
//        $user->setRoles($role);
//
//        $manager->persist($user);
        for ($i = 1; $i <= 10; $i++) {
            $manager->persist($this->user($i));
        }

        $manager->flush();
    }

    public function user($i)
    {

        $user = new User();
        $user->setEmail(sprintf('tester%d@gmail.com', $i));
        $user->setFirstname(sprintf('tester%d', $i));
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'wachtwoord'
        ));
        if ($i >= 2){
            $role = array('ROLE_USER');
        }else{
            $role = array('ROLE_ADMIN');
        }
        $user->setRoles($role);

        return $user;

    }
}

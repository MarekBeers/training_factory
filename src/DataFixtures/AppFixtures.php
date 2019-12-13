<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function($i) {
            $user = new User();
            $user->setEmail(sprintf('test%d@gmail.com', $i));
            $user->setFirstName($this->faker->firstName);

            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'wachtwoord'
            ));

            return $user;
        });

        $manager->flush();
    }

    /**
     * Load data fixtures with the passed EntityManager
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WiishFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++){
            $wish = new Wish();
            $wish->setTitle($faker->word);
            $wish->setDescription($faker->text);
            $wish->setAuthor($faker->name);
            $wish->setIsPublished($faker->boolean);
            $date = $faker->dateTimeBetween('-30 days', '-1 days');
            $wish->setDateCreated(\DateTimeImmutable::createFromMutable( $date));

            $manager->persist($wish);
        }


        dump($wish);

        $manager->flush();
    }
}

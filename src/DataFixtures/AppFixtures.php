<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker;
use App\Entity\Country;
use App\Entity\Beer;
use App\Entity\Client;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        // Créer 4 pays Country
        // $count = 4;
        // while ($count > 0){
        //     $country = new Country();
        //     $country->setName($faker->country);
        //     $country->setAddress($faker->address);
        //     $country->setEmail($faker->safeEmail);

        //     $manager->persist($country);
        //     $count--;
        // }

        // $manager->flush();

        // Les assigner aléatoirement parmi les bières
        // $repoCountry = $manager->getRepository(Country::class);
        // $countries = $repoCountry->findAll();
        // // "$beer->setCountry($countries[rand(0,3)]);" juste en dessous

        // $count = 10;
        // while ($count > 0){
        //     $beer = new Beer();
        //     $beer->setName($faker->company);
        //     $beer->setPublishedAt(new \DateTime());
        //     $beer->setDescription($faker->catchPhrase);
        //     $beer->setRating(rand(0, 10));
        //     $beer->setStatus(rand(0, 1) ? "available" : "unavailable");
        //     $beer->setDegree($faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 50)); // 48.8932
        //     $beer->setCountry($countries[rand(0,3)]);

        //     $manager->persist($beer);
        //     $count --;
        // }

        // $manager->flush();

        // $repoBeer = $manager->getRepository(Beer::class);
        // $beers = $repoBeer->findAll();

        // foreach ($beers as $beer){
        //     $beer->setPrice($faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 100.01));

        //     $manager->persist($beer);
        // }

        // $manager->flush();

        $count = 5;
        while($count > 0){
            $client = new Client();
            $client->setName($faker->name);
            $client->setEmail($faker->email);
            $client->setConso(rand(0, 10000));
            $manager->persist($client);
            $count--;
        }

        $manager->flush();
    }
}
    
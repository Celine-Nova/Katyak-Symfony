<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;

use App\Entity\Type;
use App\Entity\User;
use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Category;

use Faker\ORM\Doctrine\Populator;
use Doctrine\Persistence\ObjectManager;
// use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)

    {
        // je crée un utilisateur
        $admin = new User();
        $admin->setEmail('admin@katyak.com');
        $admin->setUsername('admin');
        $admin->setRoles(['ROLE_ADMIN']);
        $encodedPassword = $this->passwordEncoder->encodePassword($admin, 'admin1234');
        $admin->setPassword($encodedPassword);
        
        $manager->persist($admin);

        $motor = new Type();
        $motor->setName('A moteur');
        $motor->setPicture('/uploads/pictures/motor_boat_2-604a25a484557');
        $manager->persist($motor);

        $sail = new Type();
        $sail->setName('A voile');
        $sail->setPicture('/pictures/type/sailing_ship_type.jpg');
        $manager->persist($sail);

        $sea = new Type();
        $sea->setName('De mer');
        $sea->setPicture('/pictures/type/sea_kayak.jpg');
        $manager->persist($sea);

        $river = new Type();
        $river->setName('De rivière');
        $river->setPicture('/pictures/type/kayak_river.jpg');
        $manager->persist($river);

        $typeNull = new Type();
        $typeNull->setName('Aucun');
        $typeNull->setPicture('/uploads/pictures/motor_boat_2-604a25a484557');
        $manager->persist($typeNull);

        $boat = new Category();
        $boat->setName('Bâteau');
        $boat->setDescription('Un bateau est une construction humaine capable de flotter sur l\'eau et de s\'y déplacer, dirigé par ses occupants. Il répond aux besoins du transport maritime');
        $boat->setPicture('/uploads/pictures/motor_boat_2-604a25a484557');
        $manager->persist($boat);
        
        $boatBrand = new Brand();
        $boatBrand->setName('Bâteau');
        $boatBrand->setPicture('/uploads/pictures/motor_boat_2-604a25a484557');
        $manager->persist($boatBrand);
        // Fixture avec Faker
        // $generator = Factory::create('fr_FR');

        //Je créée une classe en utilsant "$generator"comme paramètre cf https://github.com/fzaninotto/Faker
      
        // $populator = new Faker\ORM\Doctrine\Populator($generator, $manager);
        
        // $populator->addEntity(Type::class, 5);
        // $populator->addEntity(Category::class, 5);
        // $populator->addEntity(Brand::class, 5);

        // $populator->addEntity(Type::class, 4, array(
        //     'name' => function() use ($generator) { return $generator->word(); },
        //     'picture' => function() use ($generator) { return $generator->imageUrl($width = 60, $height = 80); }
        // ));      
        
        // $populator->addEntity(Category::class, 12, array(
        //     'name' => function() use ($generator) { return $generator->words($nb = 3, $asText = true); },
        //     'description'=> function() use ($generator) { return $generator->sentence($nbWords = 10, $variableNbWords = true); },
        //     'picture' => function() use ($generator) { return $generator->imageUrl($width = 640, $height = 480); },  // 'http://lorempixel.com/640/480/'
        // ));
        
        // $populator->addEntity(Brand::class, 24, array(
        //     'name' => function() use ($generator) { return $generator->company(); },
        //     'picture' => function() use ($generator) { return $generator->imageUrl($width = 120, $height = 120, 'cats'); },  
        // ));

        // $populator->addEntity(Product::class, 24, array(
        //     'name' => function() use ($generator) { return $generator->lastName(); },
        //     'description'=> function() use ($generator) { return $generator->sentence($nbWords = 30, $variableNbWords = true); },
        //     'picture' => function() use ($generator) { return $generator->imageUrl($width = 780, $height = 520, 'cats', true, 'Faker', true); },
        //     'price' => function() use ($generator) { return $generator->RandomNumber(4); },
        //     'createdAt' => function () use ($generator) { return $generator->unique()->dateTime($max = 'now', $timezone = null); },
        //     'updatedAt' => function () use ($generator) { return $generator->unique()->dateTime($max = 'now', $timezone = null); },
        // ));

        // $populator->execute();
        $manager->flush();
    }
}

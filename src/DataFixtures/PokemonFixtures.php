<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PokemonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
      $pokemonsData = [
        [
          'name' => 'Bulbasaur',
          'type' => 'Grass',
        ],
        [
          'name' => 'Charmander',
          'type' => 'Fire',
        ],
        [
          'name' => 'Squirtle',
          'type' => 'Water',
        ],
        [
          'name' => 'Pikachu',
          'type' => 'Electric',
        ]
      ];

      foreach ($pokemonsData as $data) {
        $pokemon = new Pokemon();
        $pokemon->setName($data['name']);
        $pokemon->setType($data['type']);
        $manager->persist($pokemon);
      }

      $manager->flush();
    }
}

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
        ],
        [
          'name' => 'Jigglypuff',
          'type' => 'Normal',
        ],
        [
          'name' => 'Meowth',
          'type' => 'Normal',
        ],
        [
          'name' => 'Psyduck',
          'type' => 'Water',
        ],
        [
          'name' => 'Snorlax',
          'type' => 'Normal',
        ],
        [
          'name' => 'Magikarp',
          'type' => 'Water',
        ],
        [
          'name' => 'Eevee',
          'type' => 'Normal',
        ],
        [
          'name' => 'Pidgey',
          'type' => 'Normal',
        ],
        [
          'name' => 'Rattata',
          'type' => 'Normal',
        ],
        [
          'name' => 'Zubat',
          'type' => 'Poison',
        ],
        [
          'name' => 'Geodude',
          'type' => 'Rock',
        ],
        [
          'name' => 'Gastly',
          'type' => 'Ghost',
        ],
        [
          'name' => 'Onix',
          'type' => 'Rock',
        ],
        [
          'name' => 'Drowzee',
          'type' => 'Psychic',
        ],
        [
          'name' => 'Krabby',
          'type' => 'Water',
        ],
        [
          'name' => 'Voltorb',
          'type' => 'Electric',
        ],
        [
          'name' => 'Cubone',
          'type' => 'Ground',
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

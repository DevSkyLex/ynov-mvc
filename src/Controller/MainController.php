<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
  #[Route('/', name: 'app_home')]
  public function index(PokemonRepository $pokemonRepository): Response {
    $pokemons = $pokemonRepository->findAll();

    return $this->render('main/index.html.twig', [
      'pokemons' => $pokemons,
    ]);
  }
}

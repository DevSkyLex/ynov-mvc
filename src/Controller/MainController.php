<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
  /**
   * Méthode index
   * 
   * Route renvoyant vers la liste des pokémons
   * 
   * @access public
   * 
   * @return Response La réponse HTTP
   */
  #[Route(path: '/', name: 'app_home')]
  public function index(): Response {
    return $this->redirectToRoute(route: 'app_pokemon_list');
  }
}

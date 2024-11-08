<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Form\PokemonType;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/pokemon')]
class PokemonController extends AbstractController
{
  //#region Méthodes
  /**
   * Méthode new
   * 
   * Gère la page "/pokemon/pages/new" qui permet de créer 
   * un nouveau Pokémon
   * 
   * @access public
   * 
   * @return Response La réponse HTTP
   */
  #[Route(path: '/new', name: 'app_pokemon_new')]
  public function new(
    Request $request,
    EntityManagerInterface $entityManagerInterface
  ): Response {
    $pokemon = new Pokemon();

    $form = $this->createForm(
      type: PokemonType::class,
      data: $pokemon
    );

    $form->handleRequest(request: $request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManagerInterface->persist(object: $pokemon);
      $entityManagerInterface->flush();

      return $this->redirectToRoute(route: 'app_pokemon_list');
    }

    return $this->render(
      view: 'pokemon/pages/new.html.twig',
      parameters: ['form' => $form->createView()]
    );
  }

  /**
   * Méthode edit
   * 
   * Gère la page "/pokemon/pages/{id}/edit" qui permet de modifier 
   * un Pokémon existant
   * 
   * @access public
   * 
   * @param Pokemon $pokemon Le Pokémon à modifier
   * 
   * @return Response La réponse HTTP
   */
  #[Route(path: '/{id}/edit', name: 'app_pokemon_edit')]
  public function edit(
    Pokemon $pokemon,
    Request $request,
    EntityManagerInterface $entityManagerInterface
  ): Response {
    $form = $this->createForm(
      type: PokemonType::class,
      data: $pokemon
    );

    $form->handleRequest(request: $request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManagerInterface->flush();

      return $this->redirectToRoute(route: 'app_pokemon_list');
    }

    return $this->render(
      view: 'pokemon/pages/edit.html.twig',
      parameters: [
        'form' => $form->createView(),
        'pokemon' => $pokemon
      ]
    );
  }

  /**
   * Méthode delete
   * 
   * Gère la page "/pokemon/pages/{id}/delete" qui permet de supprimer 
   * un Pokémon existant
   * 
   * @access public
   * 
   * @param Pokemon $pokemon Le Pokémon à supprimer
   * 
   * @return Response La réponse HTTP
   */
  #[Route(path: '/{id}/delete', name: 'app_pokemon_delete')]
  public function delete(
    Pokemon $pokemon,
    EntityManagerInterface $entityManagerInterface
  ): Response {
    $entityManagerInterface->remove(object: $pokemon);
    $entityManagerInterface->flush();

    return $this->redirectToRoute(route: 'app_pokemon_list');
  }

  /**
   * Méthode show
   * 
   * Gère la page "/pokemon/pages/{id}" qui permet d'afficher 
   * un Pokémon existant
   * 
   * @access public
   * 
   * @param Pokemon $pokemon Le Pokémon à afficher
   * 
   * @return Response La réponse HTTP
   */
  #[Route(path: '/{id}', name: 'app_pokemon_show')]
  public function show(Pokemon $pokemon): Response
  {
    // Si le Pokémon n'existe pas on renvois sur la page list
    if (!$pokemon) {
      return $this->redirectToRoute(route: 'app_pokemon_list');
    }

    return $this->render(
      view: 'pokemon/pages/show.html.twig',
      parameters: ['pokemon' => $pokemon]
    );
  }

  /**
   * Méthode list
   * 
   * Gère la page "/pokemon" qui permet d'afficher 
   * la liste des Pokémon
   * 
   * @access public
   * 
   * @param PokemonRepository $pokemonRepository Le dépôt des Pokémon
   * 
   * @return Response La réponse HTTP
   */
  #[Route(path: '', name: 'app_pokemon_list')]
  public function list(
    PokemonRepository $pokemonRepository,
    #[MapQueryParameter(options: ['min_range' => 10, 'max_range' => 100])] int $limit = 10,
    #[MapQueryParameter(options: ['min_range' => 1])] int $page = 1
  ): Response {
    $pagination = $pokemonRepository->findPaginated(
      page: $page,
      limit: $limit
    );

    $totalItems = $pagination->count();
    $totalPages = ceil($totalItems / $limit);
    $hasPreviousPage = $page > 1;
    $hasNextPage = $page < $totalPages;

    return $this->render(
      view: 'pokemon/pages/list.html.twig',
      parameters: [
        'pagination'      => $pagination,
        'page'            => $page,
        'totalPages'      => $totalPages,
        'hasPreviousPage' => $hasPreviousPage,
        'hasNextPage'     => $hasNextPage,
        'limit'           => $limit,
        'limitOptions'    => [10, 25, 50, 100]
      ]
    );
  }
  //#endregion
}

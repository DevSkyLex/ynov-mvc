<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<Pokemon>
 */
class PokemonRepository extends ServiceEntityRepository
{
  //#region Constructeur
  /**
   * Constructeur
   * 
   * Initialise une nouvelle instance 
   * de la classe
   * 
   * @access public
   * 
   * @param ManagerRegistry $registry Le gestionnaire d'entités
   */
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct(
      registry: $registry, 
      entityClass: Pokemon::class
    );
  }
  //#endregion

  //#region Méthodes
  /**
   * Méthode findPaginated
   * 
   * Permet de récupérer une liste paginée de Pokémon
   * 
   * @access public
   * 
   * @param int $page Le numéro de la page (1 par défaut)
   * @param int $limit Le nombre d'éléments par page (10 par défaut)
   * 
   * @return Paginator La liste paginée de Pokémon
   */
  public function findPaginated(int $page = 1, int $limit = 10): Paginator
  {
    $query = $this->createQueryBuilder(alias: 'p')
                  ->getQuery()
                  ->setFirstResult(firstResult: ($page - 1) * $limit)
                  ->setMaxResults(maxResults: $limit);

    return new Paginator(
      query: $query, 
      fetchJoinCollection: true
    );
  }
  //#endregion
}

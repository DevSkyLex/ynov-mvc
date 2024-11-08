<?php

namespace App\Entity;

use App\Repository\PokemonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Classe Pokemon
 * 
 * Entité Pokémon permettant de gérer les 
 * données des Pokémon dans la base de données
 * 
 * @author Valentin FORTIN <contact@valentin-fortin.pro>
 */
#[ORM\Entity(repositoryClass: PokemonRepository::class)]
#[UniqueEntity(fields: ['name'], message: 'Ce nom de Pokémon est déjà dans la base de données')]
class Pokemon
{
  //#region Propriétés
  /**
   * Propriété id
   * 
   * L'identifiant du Pokémon
   * 
   * @access private
   * 
   * @var int|null $id L'identifiant du Pokémon
   */
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  /**
   * Propriété name
   * 
   * Le nom du Pokémon
   * 
   * @access private
   * 
   * @var string|null $name Le nom du Pokémon
   */
  #[ORM\Column(length: 255, unique: true)]
  #[Assert\NotBlank(message: 'Le nom du Pokémon est obligatoire')]
  #[Assert\Length(
    max: 255, 
    maxMessage: 'Le nom du Pokémon ne doit pas dépasser {{ limit }} caractères',
    min: 3,
    minMessage: 'Le nom du Pokémon doit contenir au moins {{ limit }} caractères'
  )]
  private ?string $name = null;

  /**
   * Propriété type
   * 
   * Le type du Pokémon (eau, feu, plante, etc.)
   * 
   * @access private
   * 
   * @var string|null $type Le type du Pokémon
   */
  #[ORM\Column(length: 255)]
  #[Assert\NotBlank(message: 'Le type du Pokémon est obligatoire')]
  #[Assert\Length(
    max: 255, 
    maxMessage: 'Le type du Pokémon ne doit pas dépasser {{ limit }} caractères',
    min: 3,
    minMessage: 'Le type du Pokémon doit contenir au moins {{ limit }} caractères'
  )]
  private ?string $type = null;
  //#endregion

  //#region Méthodes
  /**
   * Méthode getId
   * 
   * Retourne l'identifiant du Pokémon
   * 
   * @access public
   * 
   * @return int|null L'identifiant du Pokémon
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Méthode getName
   * 
   * Retourne le nom du Pokémon
   * 
   * @access public
   * 
   * @return string|null Le nom du Pokémon
   */
  public function getName(): ?string
  {
    return $this->name;
  }

  /**
   * Méthode setName
   * 
   * Définit le nom du Pokémon
   * 
   * @access public
   * 
   * @param string $name Le nom du Pokémon
   * 
   * @return static $this L'instance actuelle de la classe
   */
  public function setName(string $name): static
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Méthode getType
   * 
   * Retourne le type du Pokémon
   * 
   * @access public
   * 
   * @return string|null Le type du Pokémon
   */
  public function getType(): ?string
  {
    return $this->type;
  }

  /**
   * Méthode setType
   * 
   * Définit le type du Pokémon
   * 
   * @access public
   * 
   * @param string $type Le type du Pokémon
   * 
   * @return static $this L'instance actuelle de la classe
   */
  public function setType(string $type): static
  {
    $this->type = $type;

    return $this;
  }
  //#endregion
}

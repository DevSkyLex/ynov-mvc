<?php

namespace App\Form;

use App\Entity\Pokemon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

/**
 * Classe PokemonType
 * 
 * Gère le formulaire de création d'un Pokémon
 */
class PokemonType extends AbstractType
{
  /**
   * Méthode buildForm
   * 
   * Construit le formulaire pour la création d'un Pokémon
   * 
   * @access public
   * 
   * @param FormBuilderInterface $builder Le constructeur de formulaire
   * @param array $options Les options du formulaire
   * 
   * @return void - Ne retourne rien
   */
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add(
        child: 'name',
        type: TextType::class,
        options: [
          'label' => 'Nom du Pokémon',
          'attr' => [
            'placeholder' => 'Nom du Pokémon',
            'class' => 'input-field',
          ],
          'row_attr' => [
            'class' => 'form__row',
          ],
          'label_attr' => [
            'class' => 'form__label',
          ],
          'required' => true,
        ]
      )
      ->add(
        child: 'type',
        type: TextType::class,
        options: [
          'label' => 'Type du Pokémon',
          'attr' => [
            'placeholder' => 'Type du Pokémon',
            'class' => 'input-field',
          ],
          'row_attr' => [
            'class' => 'form__row',
          ],
          'label_attr' => [
            'class' => 'form__label',
          ],
          'required' => true,
        ]
      )
      ->add(
        child: 'submit',
        type: SubmitType::class,
        options: [
          'label' => 'Enregistrer',
          'attr' => [
            'class' => 'btn btn--primary',
          ],
          'row_attr' => [
            'class' => 'form__btns',
          ],
        ]
      )
    ;
  }

  /**
   * Méthode configureOptions
   * 
   * Configure les options du formulaire
   * 
   * @access public
   * 
   * @param OptionsResolver $resolver Le résolveur d'options
   * 
   * @return void - Ne retourne rien
   */
  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults(defaults: [
      'data_class' => Pokemon::class,
    ]);
  }
}

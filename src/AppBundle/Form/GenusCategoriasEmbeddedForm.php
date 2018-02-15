<?php

namespace AppBundle\Form;

use AppBundle\Entity\GenusCategoria;
use AppBundle\Entity\Categoria;
use AppBundle\Repository\CategoriaRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class GenusCategoriasEmbeddedForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add( 'categoria', EntityType::class, [
                   'class' => Categoria::class,
                   'choice_label' => 'name',
                   'label' => 'Nome da Categoria',
                   'query_builder' => function(CategoriaRepository $repo) {
                    return $repo->getCategoriasQueryBuilder();
                }
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GenusCategoria::class
        ]);
    }
}
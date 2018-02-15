<?php


namespace AppBundle\Form;

use AppBundle\Entity\Assinatura;
use AppBundle\Entity\AssinaturaCategoria;
use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusCategoria;
use AppBundle\Entity\Categoria;
use AppBundle\Repository\AssinaturaRepository;
use AppBundle\Repository\CategoriaRepository;
use AppBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenusAssinaturasEmbeddedForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'minha assinatura'
            ])
            ->add('assinaturaCategorias', EntityType::class, [
                'placeholder' => 'Choose a Category',
                'class' => Categoria::class,
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Assinatura::class
        ]);
    }

}
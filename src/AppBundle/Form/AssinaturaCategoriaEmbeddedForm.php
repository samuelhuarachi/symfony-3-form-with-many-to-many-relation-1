<?php


namespace AppBundle\Form;

use AppBundle\Entity\Assinatura;
use AppBundle\Entity\AssinaturaCategoria;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\GenusScientist;
use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AssinaturaCategoriaEmbeddedForm
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'choice_label' => 'name'
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AssinaturaCategoria::class
        ]);
    }

}
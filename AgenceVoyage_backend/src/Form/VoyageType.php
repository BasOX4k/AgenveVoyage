<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Destination;
use App\Entity\User;
use App\Entity\Voyage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('dateDepart', null, [
                'widget' => 'single_text',
            ])
            ->add('dateRetour', null, [
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('Categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'pays',
                'multiple' => true,
                'choice_label' => 'evenement',
                'multiple' => true,
                
            ])
            
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'nom',
        
            ->add('destination', EntityType::class, [
                'class' => Destination::class,
                'choice_label' => 'nom',
            ])
            ->add('image', null)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}

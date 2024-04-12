<?php

namespace App\Form;

use App\Entity\Config;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mondayOpen', TimeType::class, [
                "label" => "Ouverture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('mondayClose', TimeType::class, [
                "label" => "Fermeture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('tuesdayOpen', TimeType::class, [
                "label" => "Ouverture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('tuesdayClose', TimeType::class, [
                "label" => "Fermeture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('wednesdayOpen', TimeType::class, [
                "label" => "Ouverture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('wednesdayClose', TimeType::class, [
                "label" => "Fermeture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('thursdayOpen', TimeType::class, [
                "label" => "Ouverture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('thursdayClose', TimeType::class, [
                "label" => "Fermeture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('fridayOpen', TimeType::class, [
                "label" => "Ouverture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('fridayClose', TimeType::class, [
                "label" => "Fermeture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('saturdayOpen', TimeType::class, [
                "label" => "Ouverture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('saturdayClose', TimeType::class, [
                "label" => "Fermeture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('sundayOpen', TimeType::class, [
                "label" => "Ouverture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('sundayClose', TimeType::class, [
                "label" => "Fermeture",
                "mapped" => false,
                "attr" => [
                    "class" => "form-control mt-2"
                ]
            ])
            ->add('is_open_holidays', CheckboxType::class, [
                "label" => "Je suis ouvert les jours fériés",
                "label_attr" => ["class" => "form-check-label"],
                "mapped" => false,
                "attr" => [
                    "class" => "form-check-input"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Config::class,
        ]);
    }
}

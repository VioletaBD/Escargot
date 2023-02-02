<?php

namespace App\Form;

use App\Entity\Outing;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class Outing1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('outingFile', VichFileType::class, [
                'label' => 'Image',
                'required'      => true,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ])

            ->add('dateTime', null, [
                'label' => 'timedate'
            ])
            ->add('inscription', null, )



            ->add('dateTime', DateTimeType::class, [
                'dateTime' => 'Date'
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outing::class,
        ]);
    }
}

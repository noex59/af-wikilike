<?php

namespace App\Form;

use App\Entity\Exemple;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class SendExempleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('code')
            ->add('video', FileType::class, [
				'mapped' => false,
				'required' => false,
	            'constraints' => [
					new File([
						'maxSize' => '4000000k',
						'mimeTypes' => [
							'video/mp4'
						],
						'mimeTypesMessage' => 'Le format mp4 est obligatoire'
					])
	            ],
            ])
            ->add('technologies')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exemple::class,
        ]);
    }
}

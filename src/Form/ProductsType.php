<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Products;
use Doctrine\DBAL\Types\ArrayType;
use SebastianBergmann\Type\MixedType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints as Assert;


class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameProduct',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Name',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('description',TextareaType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank()
                ]
            ])
            ->add('price', MoneyType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prix',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive()
                ]
            ])
            ->add('image',VichImageType::class, [
                'attr' => [
                    'class' => 'mt-4 mb-4 '
                ],
                'label' => 'Image Produit',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])
            ->add('category',EntityType::class,[
                'class' => Categories::class,
                'attr' => [
                    'class' => ' mb-4 form-select'
                ],
                'label' => 'Category Produit',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]  
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}

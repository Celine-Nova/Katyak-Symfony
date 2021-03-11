<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Brand;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('picture', FileType::class, [
                'data_class'=> null,
                'label' => 'format (jpeg, jpg, png)',

            ])
            ->add('price')
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => 'name'

            ])

            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',

            ])

            ->add('brand', Entitytype::class, [
                'class' => Brand::class,
                'choice_label' => 'name'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

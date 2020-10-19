<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\SubCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand', EntityType::class, [
                'label' => 'Brand',
                'class' => Brand::class,
                'choice_label' => 'name'
            ])
            ->add('category', EntityType::class, [
                'label' => 'Category',
                'class' => Category::class,
                'choice_label' => 'name'
            ])
            ->add('subCategory', EntityType::class, [
                'label' => 'Sub Category',
                'class' => SubCategory::class,
                'choice_label' => 'name'
            ])
            ->add('name', TextType::class, [
                'label' => 'Name'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Price',
                'divisor' => 100,
                'scale' => 2,
                'grouping' => true
            ])
            ->add('quantityAvailable', NumberType::class, [
                'label' => 'Quantity Available'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('tags', TextType::class, [
                'label' => 'Tags',
                'attr' => ['class' => 'tags-input']
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

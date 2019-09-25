<?php

namespace App\Form;

use App\BindingModel\Product\CreateProductBindingModel;
use App\DataTransformer\CategoryToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateProductType extends AbstractType
{
    /**
     * @var CategoryToIdTransformer
     */
    private $categoryTransformer;

    public function __construct(CategoryToIdTransformer $categoryToIdTransformer)
    {
        $this->categoryTransformer = $categoryToIdTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('barcode', TextType::class)
            ->add('bgTitle', TextType::class)
            ->add('enTitle', TextType::class)
            ->add('price', NumberType::class)
            ->add('importPrice', NumberType::class)
            ->add('bgDescription', TextType::class)
            ->add('enDescription', TextType::class)
            ->add('quantity', IntegerType::class)
            ->add('enabled', CheckboxType::class)
            ->add('category', TextType::class);

        $builder->get('category')->addModelTransformer($this->categoryTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateProductBindingModel::class
        ]);
    }
}
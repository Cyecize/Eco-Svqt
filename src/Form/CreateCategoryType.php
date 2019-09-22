<?php

namespace App\Form;

use App\BindingModel\Product\CreateCategoryBindingModel;
use App\DataTransformer\CategoryToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateCategoryType extends AbstractType
{
    /**
     * @var CategoryToIdTransformer
     */
    private $categoryTransformer;

    public function __construct(CategoryToIdTransformer $categoryTransformer)
    {
        $this->categoryTransformer = $categoryTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentCategory', NumberType::class)
            ->add('bgTitle', TextType::class)
            ->add('enTitle', TextType::class);

        $builder->get('parentCategory')->addModelTransformer($this->categoryTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CreateCategoryBindingModel::class
        ]);
    }
}
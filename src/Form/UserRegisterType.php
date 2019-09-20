<?php

namespace App\Form;

use App\BindingModel\User\UserRegisterBindingModel;
use App\DataTransformer\CurrencyToStringTransformer;
use App\DataTransformer\LanguageToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegisterType extends AbstractType
{
    /**
     * @var CurrencyToStringTransformer
     */
    private $currencyTransformer;

    /**
     * @var LanguageToStringTransformer
     */
    private $languageTransformer;

    public function __construct(LanguageToStringTransformer $languageTransformer, CurrencyToStringTransformer $currencyTransformer)
    {
        $this->currencyTransformer = $currencyTransformer;
        $this->languageTransformer = $languageTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', TextType::class)
            ->add('confPassword', TextType::class)
            ->add('language', TextType::class)
            ->add('currency', TextType::class);

        $builder->get('language')->addModelTransformer($this->languageTransformer);
        $builder->get('currency')->addModelTransformer($this->currencyTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'data_class' => UserRegisterBindingModel::class
        ]);
    }
}
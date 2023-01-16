<?php

namespace Jinber\Bundle\ShareThisBundle\Form\Type;

use Jinber\Bundle\ShareThisBundle\Entity\ShareThisSettings;
use Oro\Bundle\LocaleBundle\Form\Type\LocalizedFallbackValueCollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShareThisSettingsType extends AbstractType
{
    const BLOCK_PREFIX = 'jinber_share_this_setting_type';

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('displayInline')
            ->add('propertyId');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShareThisSettings::class
        ]);
    }

    public function getBlockPrefix()
    {
        return self::BLOCK_PREFIX;
    }
}
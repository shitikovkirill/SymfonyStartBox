<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PrivilegeAdmin
 */
class PrivilegeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add(
                'translations',
                TranslationsType::class
            )
            ->add(
                'icon',
                'choice',
                array(
                    'choices' => array(
                        'Icon 1' => 'services-best-plumbers',
                        'Icon 2' => 'services-quick',
                        'Icon 3' => 'services-reliable',
                        'Icon 4' => 'services-best_result',
                    ))
            )
        ;
    }
}

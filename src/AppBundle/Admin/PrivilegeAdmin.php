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
                    'attr'=>[
                        'class'=>'icon-select',
                        'data-sonata-select2' => false,
                    ],
                    'choices' => array(
                        'services-best-plumbers' => 'services-best-plumbers',
                        'services-quick' => 'services-quick',
                        'services-reliable' => 'services-reliable',
                        'services-best_result' => 'services-best_result',
                        'help-request' => 'help-request',
                        'help-fast' => 'help-fast',
                        'help-working' => 'help-working',
                        'help-payment' => 'help-payment',
                    ))
            )
        ;
    }
}

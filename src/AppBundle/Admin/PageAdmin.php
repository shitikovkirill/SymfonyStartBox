<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslatedEntityType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PageAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('slug');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('slug')
            ->add('description');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('slug')
            ->add('topImage')
            ->add(
                'translations',
                TranslationsType::class
            );
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('slug');
    }
}

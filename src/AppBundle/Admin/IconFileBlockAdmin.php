<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class IconFileBlockAdmin extends IconBlockAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        $formMapper -> add(
            'tmpFile',
            'file',
            [
                'required' => false,
                'attr' =>
            ['accept'=> 'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf'],
            ]
        )
        ->add('order');
    }
}

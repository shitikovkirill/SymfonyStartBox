<?php

namespace AppBundle\Admin;

use AppBundle\Entity\IconFileBlock;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class IconFileBlockAdmin extends IconBlockAdmin
{
    /** @var UploaderHelper $vichUploader Vich uploader */
    protected $vichUploader;

    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);
        /** @var IconFileBlock $page */
        $page = $this->getSubject();
        $options = [
            'required' => false,
            'label' => 'File',
            'attr' => ['accept'=> 'application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf'],
        ];

        if ($page && !empty($page->getFile())) {
            $path = $this->vichUploader->asset($page, 'tmpFile');
            $options['help'] = '<a href="'.$path.'" target="_blank">'.$page->getFile().'</a>';
        }

        $formMapper -> add(
            'tmpFile',
            'file',
            $options
        )
        ->add('order');
    }

    /**
     * @param UploaderHelper $vichHelper
     */
    public function setVichUploader(UploaderHelper $vichHelper)
    {
        $this->vichUploader = $vichHelper;
    }
}

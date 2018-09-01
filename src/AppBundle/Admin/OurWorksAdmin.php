<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use AppBundle\Entity\OurWorks;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class OurWorksAdmin extends AbstractAdmin
{
    /** @var UploaderHelper $vichUploader Vich uploader */
    protected $vichUploader;

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('image')
            ->add('order')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var OurWorks $page
         */
        $page = $this->getSubject();
        $imageFieldOptions = [
            'required' => false,
            'label' => 'Image',
            'attr' => ['accept'=> 'image/*'],
        ];

        if ($page && !empty($page->getImage())) {
            $path = $this->vichUploader->asset($page, 'file');
            $imageFieldOptions['help'] = '<img src="'.$path.'" class="admin-preview" style="max-width: 300px"/>';
        }

        $formMapper
            ->add('order', null, ['help'=>'Values are sorted in descending order.'])
            ->add('file', 'file', $imageFieldOptions)
            ->add(
                'translations',
                TranslationsType::class
            )
        ;
    }

    /**
     * @param UploaderHelper $vichHelper
     */
    public function setVichUploader(UploaderHelper $vichHelper)
    {
        $this->vichUploader = $vichHelper;
    }
}

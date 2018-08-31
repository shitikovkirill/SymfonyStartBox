<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use AppBundle\Entity\SecondSection;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ThirdSectionAdmin extends AbstractAdmin
{
    /** @var UploaderHelper $vichUploader Vich uploader */
    protected $vichUploader;

    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var SecondSection $page
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
            ->add('file', 'file', $imageFieldOptions)
            ->add(
                'translations',
                TranslationsType::class
            )
            ->add('iconBlocks',
                'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => true,
                    )
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                )
            )
        ;
    }

    public function configureListFields(ListMapper $list)
    {

        $list->addIdentifier('slug');
        $list->add('title');
    }

    /**
     * @param UploaderHelper $vichHelper
     */
    public function setVichUploader(UploaderHelper $vichHelper)
    {
        $this->vichUploader = $vichHelper;
    }
}

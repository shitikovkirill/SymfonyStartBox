<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use AppBundle\Entity\SecondSection;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class SecondSectionAdmin extends AbstractAdmin
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
        ];

        if ($page && !empty($page->getImage())) {
            $path = $this->vichUploader->asset($page, 'file');
            $imageFieldOptions['help'] = '<img src="'.$path.'" class="admin-preview" style="max-width: 300px"/>';
        }

        $formMapper
            ->with('Content', ['class' => 'col-md-8'])
                ->add(
                    'translations',
                    TranslationsType::class,
                    [
                        'fields' => [
                            'description' => [
                                'field_type' => CKEditorType::class,
                            ],
                        ]
                    ]
                )
            ->end()
            ->with('Image', ['class' => 'col-md-4'])
            ->add('file', 'file', $imageFieldOptions)
            ->add(
                'deleteImage',
                BooleanType::class,
                [
                    'choices' => [
                        'label_type_no' => BooleanType::TYPE_NO,
                        'label_type_yes' => BooleanType::TYPE_YES,
                    ],
                ],
                [
                    'translation_domain' => "SonataAdminBundle",
                    'help'=>'second_select_delete_image'
                ]
            )
            ->end()
            ->add('iconBlocks',
                'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => true,
                    ),
                    'required' => false,
                ),
                array(
                    'edit' => 'inline',
                    'inline' => 'table',
                    'sortable' => 'position',
                    'help' => IconBlockAdmin::getIcons()
                )
            )
        ;
    }

    public function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('title');
    }

    /**
     * @param UploaderHelper $vichHelper
     */
    public function setVichUploader(UploaderHelper $vichHelper)
    {
        $this->vichUploader = $vichHelper;
    }
}

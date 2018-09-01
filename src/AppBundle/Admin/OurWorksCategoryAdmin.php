<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use AppBundle\Entity\OurWorksCategory;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class OurWorksCategoryAdmin extends AbstractAdmin
{
    /** @var UploaderHelper $vichUploader Vich uploader */
    protected $vichUploader;

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('image')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var OurWorksCategory $page
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
            ->with('Image', ['class' => 'col-md-4'])
                ->add('file', 'file', $imageFieldOptions)
            ->end()
            ->with('Content', ['class' => 'col-md-8'])
                ->add(
                    'translations',
                    TranslationsType::class
                )
            ->end()

            ->with('')
            ->add('ourWorks',
                'sonata_type_collection',
                array(
                    'type_options' => array(
                        'delete' => true,
                    )
                )
            )
            ->end();
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

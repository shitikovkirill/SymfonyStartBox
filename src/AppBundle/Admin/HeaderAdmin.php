<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use AppBundle\Entity\Header;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class HeaderAdmin extends AbstractAdmin
{

    /** @var UploaderHelper $vichUploader Vich uploader */
    protected $vichUploader;

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('slug');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('slug')
            ->add('title');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Header $page
         */
        $page = $this->getSubject();
        $imageFieldOptions = [
            'required' => false,
            'label' => 'Image',
            'attr' => ['accept'=> 'image/*'],
        ];

        if ($page && !empty($page->getTopImage())) {
            $path = $this->vichUploader->asset($page, 'topImageFile');
            $imageFieldOptions['help'] = '<img src="'.$path.'" class="admin-preview" style="max-width: 300px"/>';
        }

        $mobileImageFieldOptions = [
            'required' => false,
            'label' => 'Image',
            'attr' => ['accept'=> 'image/*'],
        ];

        if ($page && !empty($page->getMobileImage())) {
            $path = $this->vichUploader->asset($page, 'mobileImageFile');
            $mobileImageFieldOptions['help'] = '<img src="'.$path.'" class="admin-preview" style="max-width: 300px"/>';
        }

        $iconsOptionsHelp = IconBlockAdmin::getIcons();

        $formMapper
            ->with('Top image', ['class' => 'col-md-6'])
                ->add('topImageFile', 'file', $imageFieldOptions)
            ->end()
            ->with('Top image mobile', ['class' => 'col-md-6'])
                ->add('mobileImageFile', 'file', $mobileImageFieldOptions)
            ->end()
            ->with('')
                ->add('slug')
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
                    'help' => $iconsOptionsHelp,
                )
            )
                ->add(
                    'translations',
                    TranslationsType::class
                )
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('slug');
    }

    /**
     * @param UploaderHelper $vichHelper
     */
    public function setVichUploader(UploaderHelper $vichHelper)
    {
        $this->vichUploader = $vichHelper;
    }
}

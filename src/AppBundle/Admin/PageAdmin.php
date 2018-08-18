<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslatedEntityType;
use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use AppBundle\Entity\Page;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class PageAdmin extends AbstractAdmin
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
            ->add('description');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Page $page
         */
        $page = $this->getSubject();
        $imageFieldOptions = [
            'required' => false,
            'label' => 'Image',
        ];

        if ($page && !empty($page->getTopImage())) {
            $path = $this->vichUploader->asset($page, 'topImageFile');
            $imageFieldOptions['help'] = '<img src="'.$path.'" class="admin-preview" style="max-width: 300px"/>';
        }

        $formMapper
            ->add('slug')
            ->add('topImageFile', 'file', $imageFieldOptions)
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

    /**
     * @param UploaderHelper $vichHelper
     */
    public function setVichUploader(UploaderHelper $vichHelper)
    {
        $this->vichUploader = $vichHelper;
    }
}

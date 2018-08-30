<?php

namespace AppBundle\Block;

use AppBundle\Entity\SecondSection;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Templating\EngineInterface;

/**
 * Class SecondSectionBlock
 */
class SecondSectionsBlock extends AbstractBlockService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * HeaderBlock constructor.
     * @param null $name
     * @param EngineInterface|null $templating
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        $name = null,
        EngineInterface $templating = null,
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        parent::__construct($name, $templating);
    }

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();
        if(empty($settings) || empty($settings['class'])){
            throw new \Exception('Need to define "class" parameter for SecondSectionsBlock.');
        }

        $pageRep = $this->entityManager->getRepository($settings['class']);

        $page1 = $pageRep ->findOneBy(['slug' => $this->getName().'_1']);

        if(empty($page1)){
            return $this->renderResponse(
                'Block/empty-content.html.twig',
                ['slug' => $this->getName().'_1', 'category' => $settings['category']]
            );
        }

        $page2 = $pageRep ->findOneBy(['slug' => $this->getName().'_2']);

        if(empty($page2)){
            return $this->renderResponse(
                'Block/empty-content.html.twig',
                ['slug' => $this->getName().'_2', 'category' => $settings['category']]
            );
        }

        $sections = [ $page1, $page2 ];

        return $this->renderResponse(
            $blockContext->getTemplate(),
            ['sections' => $sections],
            $response
        );
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => null,
            'category' => null,
            'template' => 'Block/second-sections.html.twig',
        ]);
    }
}
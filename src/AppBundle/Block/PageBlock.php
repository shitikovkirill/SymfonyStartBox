<?php

namespace AppBundle\Block;


use AppBundle\Entity\Header;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class HeaderBlock
 */
class PageBlock extends AbstractBlockService
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
        $page = $pageRep ->findOneBy(['slug' => $this->getName()]);

        if(empty($page)){
            return $this->renderResponse(
                'Block/empty-content.html.twig',
                ['slug' => $this->getName(), 'category' => $settings['category']]
            );
        }

        return $this->renderResponse(
          $blockContext->getTemplate(),
          ['page' => $page],
          $response
        );
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['class' => null, 'template' => 'Block/main.html.twig', 'category' => null]);
    }
}
<?php

namespace AppBundle\Block;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SecondSectionBlock
 */
class SectionsBlock extends AbstractBlockService
{
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();

        if(empty($settings['sections'])){
            return $this->renderResponse('Block/empty-content.html.twig');
        }

        return $this->renderResponse(
            $blockContext->getTemplate(),
            [
                'sections' => $settings['sections'],
            ],
            $response
        );
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'sections' => null,
            'template' => 'Block/empty-content.html.twig',
        ]);
    }
}
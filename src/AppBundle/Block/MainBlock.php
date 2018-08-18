<?php

namespace AppBundle\Block;


use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MainBlock extends AbstractBlockService
{

    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $settings = $blockContext->getSettings();

        return $this->renderResponse(
          $blockContext->getTemplate(),
          [
              'page' => $settings['page'],
          ],
          $response
        );
    }

    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'page' => null,
           'template' => 'Block/main.html.twig',
        ]);
    }
}
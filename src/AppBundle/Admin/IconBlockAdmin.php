<?php

namespace AppBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class IconBlockAdmin
 */
class IconBlockAdmin extends AbstractAdmin
{
    public static $icons = array(
        'work-prochistka'=>'work-prochistka',
        'work-ttheater'=>'work-ttheater',
        'work-hotfloor'=>'work-hotfloor',
        'work-washer'=>'work-washer',
        'work-heating'=>'work-heating',
        'work-bath'=>'work-bath',
        'work-heated_towel_rail'=>'work-heated_towel_rail',
        'work-shower'=>'work-shower',
        'work-plumber'=>'work-plumber',
        'work-water_tap'=>'work-water_tap',
        'work-water_pape'=>'work-water_pape',
        'work-toilet_bidet'=>'work-toilet_bidet',
        'work-boiler'=>'work-boiler',
        'work-sewerage'=>'work-sewerage',
        'logo'=>'logo',
        'help-payment'=>'help-payment',
        'help-working'=>'help-working',
        'help-fast'=>'help-fast',
        'help-request'=>'help-request',
        'services-best_result'=>'services-best_result',
        'services-reliable'=>'services-reliable',
        'services-quick'=>'services-quick',
        'services-best-plumbers'=>'services-best-plumbers',
        'soc-google'=>'soc-google',
        'soc-fb'=>'soc-fb',
        'soc-ok'=>'soc-ok',
        'soc-twi'=>'soc-twi',
        'soc-vk'=>'soc-vk',
        'star1'=>'star1',
        'star2'=>'star2',
        'check'=>'check',
        'icon-i_call2'=>'icon-i_call2',
        'phoneme'=>'phoneme',
        'phouse'=>'phouse',
        'building'=>'building',
        'combuild'=>'combuild',
        'tradebuild'=>'tradebuild',
        'work-filter'=>'work-filter',
        'calculation'=>'calculation',
        'checkpro'=>'checkpro',
        'guarantee'=>'guarantee',
        'tool'=>'tool',
        'time'=>'time',
        'discount'=>'discount',
        'professional'=>'professional',
        'deed'=>'deed',
        'discountsoc'=>'discountsoc',

    );

    public static function getIcons()
    {
        $icons = '';
        foreach (IconBlockAdmin::$icons as $icon) {
            $icons .= '<span class="icon-helper"><svg class="icon" width="50" height="50">
                    <use xlink:href="/assets/style/sprite.svg#'. $icon .'"></use>
                </svg>'. $icon .'</span>';
        }
        return '<div class="icon-help">'. $icons. '</div>';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {


        $iconsOptions['help'] = self::getIcons();


        $formMapper
            ->add(
                'translations',
                TranslationsType::class
            )
            ->add(
                'icon',
                'choice',
                array(
                    'attr'=>[
                        'class'=>'icon-select',
                        'data-sonata-select2' => false,
                    ],
                    'choices' => self::$icons
                ),
                $iconsOptions
            )
        ;
    }
}

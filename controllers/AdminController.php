<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 11.06.16
 * Time: 21:10
 */

namespace Bunch\Controllers;


class AdminController
{
    public function addOptionPage($options)
    {
        $options['title'] = __('Bunch', 'um_lang');
        $options['pages'] = array(
            __('Add points', 'um_lang'),
            __('Home Setting', 'um_lang'),
        );

        if (function_exists("register_field_group")) {
            register_field_group(array(
            'id' => 'add_points',
            'title' => 'Добавить кридиты к постам',
            'fields' => array(
                //TAB Agent Setting
                array(
                    'key' => 'add_points_tab',
                    'name' => '',
                    'type' => 'tab',
                    'label' => 'Agent Setting',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options-add-points',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array(
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array(),
            ),
            'menu_order' => 0,
        ));
        }
        return $options;
    }
}
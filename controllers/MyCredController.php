<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 14.06.16
 * Time: 11:41
 */

namespace Bunch\Controllers;


use Amostajo\LightweightMVC\Controller;

class MyCredController extends Controller
{
    public function registerMyCustomHook( $installed ){
        $installed['registration'] = array(
        'title'       => __( 'Заполнение данных профиля', 'bunch' ),
        'description' => __( 'Пользователю добавляются кредиты когда он заполняет свой профить', 'bunch' ),
        'callback'    => array( 'Bunch\Model\MyCred\Registration' )
        );
        $installed['my_custom_hook'] = array(
            'title'       => __( 'Registration', 'bunch' ),
            'description' => __( 'Add credits when user add data in ovn profile', 'bunch' ),
            'callback'    => array( 'Bunch\Model\MyCred\My_Custom_Hook' )
        );
        return $installed;
    }

    public function loadMyCustomHook(){
        require_once (__DIR__.'/../model/myCred/Registration.php');
        require_once (__DIR__.'/../model/myCred/MyCred.php');
    }

    public function savePointsInPost($post_ID, $post, $update){
        echo '<pre>';
        var_dump($post_ID, $post, $update); die; echo '</pre>';
    }

    public function addCreditForm(){
        $this->view->show('form/add-credit-form.php');
    }
}
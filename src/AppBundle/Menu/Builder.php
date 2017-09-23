<?php
namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'navbar-nav mr-auto');

        $menu->addChild('Home', array('route' => 'homepage'));

        if($this->container->get('security.authorization_checker')->isGranted(array('ROLE_EMPLOYEE'))) {
            $menu->addChild('Monitoring', array('route' => 'monitoring'));
            $menu->addChild('Support', array('route' => 'support'));
        }

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');




        if($this->container->get('security.authorization_checker')->isGranted(array('ROLE_ADMIN'))) {
            $menu->addChild('Admin', array('route' => 'sonata_admin_dashboard'));
        }
        if(!$this->container->get('security.authorization_checker')->isGranted(array('IS_AUTHENTICATED_FULLY'))) {
            $menu->addChild('Register', array('route' => 'fos_user_registration_register'));
            $menu->addChild('Log in', array('route' => 'fos_user_security_login'));
        }else {
            $menu->addChild('Profile', array('route' => 'fos_user_profile_show'));
            $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        }


        return $menu;
    }
}
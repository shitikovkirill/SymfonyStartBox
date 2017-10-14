<?php
/**
 * Created by PhpStorm.
 * User: igor.kryvoruchko
 * Date: 21.08.2017
 * Time: 15:34
 */

namespace SupportBundle\Forms;


use Doctrine\ORM\EntityRepository;
use SupportBundle\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormMakros extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('support', TextType::class)
            ->add('save', SubmitType::class);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: zhangxingz
 * Date: 2017/12/11
 * Time: 16:45
 */

namespace Custom\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Custom\AdminBundle\Entity\AppUsers'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'custom_adminbundle_users';
    }
}
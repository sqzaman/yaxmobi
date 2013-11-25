<?php

namespace Front\YxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('firstname', null, array('required' => true))
            ->add('lastname', null, array('required' => true))
            ->add('password', 'password', array('required' => true))
            ->add('mobilephone', null, array('required' => true))
            ->add('email')
            ->add('address')
            ->add('city')
            ->add('state')
            ->add('zip')
            ->add('country_id')
            ->add('gender')
            ->add('carrier')
            ;
    }

    //public function getDefaultOptions(array $options)
//{
//    return array(
//        'empty_data' => function (Options $options, $previousValue) {
//            return $options['multiple'] ? array() : $previousValue;
//        }
//    );
//}

    public function getDefaultOptions(array $options){
        return array(
            'data_class' => 'Front\YxBundle\Entity\Users',
        );
    }

    public function getName()
    {
        return 'user';
    }
}

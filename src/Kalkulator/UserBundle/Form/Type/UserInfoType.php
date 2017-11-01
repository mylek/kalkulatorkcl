<?php
namespace Kalkulator\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserInfoType extends AbstractType{
    
    public function getName() {
        return 'userInfo';
    }    
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('info');
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kalkulator\UserBundle\Entity\UserInfo'
        ));
    }
}

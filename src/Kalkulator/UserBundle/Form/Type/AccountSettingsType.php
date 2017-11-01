<?php

namespace Kalkulator\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;


class AccountSettingsType extends AbstractType{
    
    public function getName() {
        return 'accountSettings';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                /*->add('username', 'text', array(
                    'label' => 'Nick',
                    'required' => FALSE
                ))*/
                ->add('avatarFile', 'file', array(
                    'label' => 'Zmień avatar',
                    'required' => FALSE,
                    'constraints' => array(
                        new Assert\Image(array(
                            'minWidth' => 50,
                            'maxWidth' => 800,
                            'minHeight' => 50,
                            'maxHeight' => 800,
                            'maxSize' => "1M"
                            )
                        )
                    ),
                ))
                ->add('submit', 'submit', array(
                    'label' => 'Zapisz zmiany'
                ));
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Common\UserBundle\Entity\User'
        ));
    }
    
}
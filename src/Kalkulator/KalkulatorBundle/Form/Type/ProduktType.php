<?php

namespace Kalkulator\KalkulatorBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ProduktType extends AbstractType {
    
    public function getName() {
        return 'produkt_form';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nazwa', 'text', array(
                    'label' => 'Nazwa produktu',
                ))
                ->add('porcja', 'text', array(
                    'label' => 'Sugerowana porcja',
                    'row_attr' => array(
                        'class' => 'col-md-2'
                    )
                ))
                ->add('cena', 'text', array(
                    'label' => 'Cena',
                    'row_attr' => array(
                        'class' => 'col-md-2'
                    )
                ))
                ->add('kalorii', 'text', array(
                    'label' => 'Kalorii',
                    'row_attr' => array(
                        'class' => 'col-md-2'
                    )
                ))
                ->add('bialka', 'text', array(
                    'label' => 'Białka',
                    'row_attr' => array(
                        'class' => 'col-md-2'
                    )
                ))
                ->add('wegle', 'text', array(
                    'label' => 'Węglowodany',
                    'row_attr' => array(
                        'class' => 'col-md-2'
                    )
                ))
                ->add('tluszcze', 'text', array(
                    'label' => 'Tłuszcze',
                    'row_attr' => array(
                        'class' => 'col-md-2'
                    )
                ))
                ->add('zapisz', 'submit', array(
                    'label' => 'Zapisz',
                ));
    }
}
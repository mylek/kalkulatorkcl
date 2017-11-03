<?php
namespace Kalkulator\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kalkulator\UserBundle\Form\Type\UserInfoType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserType extends AbstractType{
    
    public function getName() {
        return 'userRegister';
    }    
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('email', 'email', array(
                'label' => 'E-mail',
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(array(
                         'max' => 128
                        )
                    )
                ),
            ))
            ->add('username', 'text', array(
                'label' => 'Login',
                'required'    => false,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array(
                         'min' => 3,
                         'max' => 20,
                        )
                    )
                ),
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array(
                    'label' => 'Hasło'
                ),
                'second_options' => array(
                    'label' => 'Powtórz hasło'
                ),
                'constraints' => array(
                    new Assert\NotBlank()
                )
            ))
            ->add('typ', 'choice', array(
                    'label' => 'Typ użytkownika',
                    'choices' => array(
                        '0' => 'Pracownik',
                        '1' => 'Klient',
                    ),
                    'attr' => array('disabled' => 'disabled', 'class' => 'star'),
                    'expanded' => true,
                ))
            ->add('imie', 'text', array(
                'attr' => array(
                        'class' => 'jq-register-form-typ'),
                'label' => 'Imię',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('imie_drugie', 'text', array(
                'label' => 'Drugie imie',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('nazwisko', 'text', array(
                'label' => 'Nazwisko',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('pesel', 'text', array(
                'label' => 'PESEL',
                'attr' => array(
                    'data-mask' => '99999999999',
                    'data-mask-placeholder' => '_'
                ),
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 16,
                        )
                    )
                ),
              ))
            ->add('nr_dowodu', 'text', array(
                'label' => 'Nr dowodu',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 16,
                        )
                    )
                ),
              ))
            ->add('miasto', 'text', array(
                'label' => 'Miasto',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('ulica', 'text', array(
                'label' => 'Ulica',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 128,
                        )
                    )
                ),
              ))
            ->add('nr_domu', 'text', array(
                'label' => 'Nr domu',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
              ))
            ->add('nr_lokalu', 'text', array(
                'label' => 'Nr lokalu',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 8,
                        )
                    )
                ),
              ))
            ->add('telefon', 'text', array(
                'label' => 'Telefon',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 16,
                        )
                    )
                ),
              ))
            ->add('stanowisko', 'text', array(
                'label' => 'Stanowisko',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('funkcja', 'text', array(
                'label' => 'Funkcja w firmie',
                'required'    => false,
                'constraints' => array(
                    new Assert\Length(array(
                         'max' => 64,
                        )
                    )
                ),
              ))
            ->add('wyksztalcenie', 'choice', array(
                'label' => 'Wykształcenie',
                'empty_value'   => false,
                'choices' => array(
                        '0' => '-- wybierz --',
                        '1' => 'wyższe',
                        '2' => 'średnie',
                        '3' => 'zasadnicze zawodowe',
                        '4' => 'gimnazjalne',
                        '5' => 'podstawowe',
                ),
              ))
            ->add('submit', 'submit', array(
                'label' => 'Zapisz'
            ));
    }
    
   /* public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Common\UserBundle\Entity\User',
            'validation_groups' => array('Default', 'Registration')
        ));
    }*/
}

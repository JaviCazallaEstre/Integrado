<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use function PHPSTORM_META\map;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'label' => 'Correo electrónico',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Este campo debe de estar relleno',
                    ]),
                ],
                'attr' => [
                    'class' => 'input-control'
                ]
            ])
            ->add('nombre', TextType::class,[
                'label' => 'Nombre',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'El campo de nombre debe de estar relleno'
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'El nombre no puede contener números',
                    ])
                ],
                'attr' => [
                    'class' => 'input-control'
                ]
            ])
            ->add('apellidos', TextType::class,[
                'label' => 'Apellidos',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'El campo de apellidos debe de estar relleno'
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'El campo apellidos no puede contener números',
                    ])
                ],
                'attr' => [
                    'class' => 'input-control'
                ]
            ])
            ->add('tipoVia', ChoiceType::class,[
                'choices' =>[
                    'Avenida' => 'Avenida',
                    'Calle' => 'Calle',
                    'Carretera' => 'Carretera',
                    'Plaza' => 'Plaza'
                ],
                'label' => 'Tipo vía',
                'required' => true,
                'placeholder' => 'Elige una opción',
                'attr' => [
                    'class'=>'input-control'
                ]

            ])
            ->add('nombreVia', TextType::class,[
                'label' => 'Nombre vía',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'El campo de nombre vía debe de estar relleno'
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'El campo de nombre vía no puede contener números',
                    ])
                ],
                'attr' => [
                    'class' => 'input-control'
                ]
            ])
            ->add('numeroVia', TextType::class,[
                'label' => 'Numero vía',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'El campo de numero via debe de estar relleno'
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]{1,3}$/',
                        'match'=>true,
                        'message' => 'El campo número vía debe de ser numérico y tener una longitud máxima de 3 dígitos'
                    ]),
                    new Length([
                        'min'=> 1,
                        'max'=> 3,
                        'minMessage'=>'El campo número vía mínimo debe de tener un dígito',
                        'maxMessage'=>'El campo número vía máximo debe de tener 3 dígitos'
                    ])
                ],
                'attr' => [
                    'class'=>'input-control'
                ]
            ])
            ->add('piso', TextType::class,[
                'label' => 'Piso',
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9]{0,2}$/',
                        'match'=>true,
                        'message' => 'El campo piso debe de ser numérico y tener una longitud máxima de 2'
                    ]),
                    new Length([
                        'max'=> 3,
                        'maxMessage'=>'El campo piso máximo debe de tener 2 dígitos'
                    ])
                ],
                'attr' => [
                    'class'=>'input-control'
                ]
            ])
            ->add('puerta', TextType::class,[
                'label'=>'Puerta',
                'required'=>false,
                'constraints'=>[
                    new Length([
                        'max'=>2,
                        'maxMessage'=>'El campo puerta máximo debe de tener 2 dígitos'
                    ])
                ],
                'attr' => [
                    'class'=>'input-control'
                ]
            ])
            ->add('bloque', TextType::class,[
                'label'=>'Bloque',
                'required'=>false,
                'constraints'=>[
                    new Length([
                        'max'=>2,
                        'maxMessage'=>'El campo bloque máximo debe de tener 2 dígitos'
                    ])
                ],
                'attr'=>[
                    'class'=>'input-control'
                ]
            ])
            ->add('escalera',TextType::class,[
                'label'=>'Escalera',
                'required'=>false,
                'constraints'=>[
                    new Length([
                        'max'=>1,
                        'maxMessage'=>'El campo escalera máximo debe de tener 1 dígito'
                    ])
                ]
            ])
            ->add('codigoPostal', IntegerType::class,[
                'label'=>'Código postal',
                'required'=>true,
                'constraints'=>[
                    new NotBlank([
                        'message'=>'El código postal debe de estar relleno'
                    ]),
                    new Length([
                        'min'=>5,
                        'max'=>5,
                        'maxMessage'=>'El código postal no puede tener más de 5 dígitos',
                        'minMessage'=>'El código postal no puede tener menos de 5 dígitos'
                    ])
                ]
            ])
            ->add('localidad', EntityType::class,[
                'label'=> 'Localidad',
                'required'=>true,
                'class'=> 'App\Entity\Localidad',
                'choice_label'=>'nombre'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label'=>'Acepto los términos',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debes de aceptar los términos.',
                    ]),
                ],
            ])
            /*->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])*/
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Deben coincidir las contraseñas.',
                'options' => ['attr' => ['class' => 'form-control']],
                'required' => true,
                'first_options' => ['label' => 'Contraseña'],
                'second_options' => ['label' => 'Repite la contraseña']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Registrar'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

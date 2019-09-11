<?php


namespace AppBundle\Form;

use AppBundle\Entity\AddressBook;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Intl\Intl;

class AddressBookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label'         => 'Firstname  ',
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'firstname'),
                'required'      => true,
            ))
            ->add('lastname', TextType::class, array(
                'label'         => 'Lastname  ',
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'lastname'),
                'required'      => true,
            ))
            ->add('streetAndNumber', TextType::class, array(
                'label'         => 'Street and number  ',
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'streetAndNumber'),
                'required'      => true,
            ))
            ->add('zip', NumberType::class, array(
                'label'         => 'Zip number',
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'zip'),
                'required'      => true,
            ))
            ->add('city', TextType::class, array(
                'label'         => 'City',
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'city'),
                'required'      => true,
            ))
            ->add('country', ChoiceType::class, array(
                'label'         => 'Country ',
                'choices'       => $this->getCountries(),
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'country'),
                'required'      => true,
            ))
            ->add('phonenumber', TelType::class, array(
                'label'         => 'Phonenumber ',
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'phonenumber'),
                'required'      => true,
            ))
            ->add('birthday', BirthdayType::class, array(
                'label'         => 'Birthday ',
                'label_attr'    => array('class' => 'is-required'),
                'attr'          => array( 'id' => 'datepicker'),
                'required'      => true,
                'widget'        => 'single_text',
                'html5'         => false,
            ))
            ->add('email', EmailType::class, array(
                'label'         => 'E-mail address  ',
                'label_attr'    => array('class' => 'Form-label is-required'),
                'attr'          => array('class' => 'Form-input', 'id' => 'email'),
                'required'      => true,
            ))
            ->add('picture', FileType::class, array(
                'label'         => 'Upload a picture ',
                'label_attr'    => array('class' => 'Form-label '),
                'attr'          => array('class' => 'Form-input', 'id' => 'picture'),
                'data_class'    => null ,
                'required'      => false,
            ))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => AddressBook::class,
        ));
    }

    public function getCountries()
    {
        $countries = array_flip(Intl::getRegionBundle()->getCountryNames());
        return $countries;
    }
}

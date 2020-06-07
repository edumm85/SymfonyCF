<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class formCreateNoticia extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $opciones)
    {
        $builder->add('titulo',TextType::class,array('label'=>'Titular de la noticia','attr'=>array('class'=>'form-control')))
        ->add('contenido',TextareaType::class,array('label'=>'Contenido de la noticia','attr'=>array('class'=>'form-control')))
        ->add('submit',SubmitType::class,array('label'=>'Guardar','attr'=>array('class'=>'btn btn-secondary mt-4')));
    }
}


?>
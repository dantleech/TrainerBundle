<?php

namespace DTL\TrainerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use DTL\TrainerBundle\Document\Route;
use Symfony\Component\Form\FormBuilderInterface;

class RouteType extends AbstractType
{
    public function getName()
    {
        return 'route';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('activity');
        $builder->add('measuredBy', 'choice', array(
            'choices' => Route::getMeasuredByChoices(),
        ));
        $builder->add('title');
        $builder->add('description');
        $builder->add('distance', 'distance');
        $builder->add('time', 'stopwatch');
        $builder->add('labels', 'csv');
    }
}

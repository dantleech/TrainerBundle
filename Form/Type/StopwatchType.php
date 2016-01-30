<?php
namespace DTL\TrainerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\FormView;
use DTL\TrainerBundle\Form\DataTransformer\StopwatchToSecondTransformer;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StopwatchType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addViewTransformer(new StopwatchToSecondTransformer())
            //->setAttribute('value', $options['value'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['value'] = $form->getViewData();
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array(
            'value' => '00:00:00',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'stopwatch';
    }
}


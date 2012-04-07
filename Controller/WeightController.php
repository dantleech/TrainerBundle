<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace DTL\TrainerBundle\Controller;
use DTL\TrainerBundle\Controller\Controller;
use DTL\TrainerBundle\Form\WeightType;
use DTL\TrainerBundle\Document\Weight;

class WeightController extends Controller
{
    public function indexAction()
    {
        $weight = new Weight;
        $weight->setDate(new \DateTime());
        $form = $this->createForm(new WeightType(), $weight);

        $rep = $this->getDm()->getRepository('DTLTrainerBundle:Weight');
        $weights = $rep->fetchAllOrdered();
        $weightPlots = $rep->getPlotsForPeriod('3 months');

        $this->processForm($form);

        return $this->render('DTLTrainerBundle:Weight:index.html.twig', array(
            'form' => $form->createView(),
            'weights' => $weights,
            'weightPlots' => $weightPlots,
        ));
    }

    public function deleteAction()
    {
        $weightId = $this->get('request')->get('weight_id');
        if ($weightId) {
            $rep = $this->getDm()->getRepository('DTLTrainerBundle:Weight');
            $weight = $rep->find($weightId);
            if ($weight) {
                $this->getDm()->remove($weight);
                $this->getDm()->flush();
            }
        }

        return $this->redirect($this->generateUrl('weight_index'));
    }
}



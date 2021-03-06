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
use DTL\TrainerBundle\Document\Route;
use DTL\TrainerBundle\Form\RouteType;
use DTL\TrainerBundle\Form\RouteSessionType;

class RouteController extends Controller
{
    protected function getRoute()
    {
        return $this->getDocumentFromRequest('DTLTrainerBundle:Route', 'route_id');
    }

    public function indexAction()
    {
        $qb = $this->getDm()
            ->createQueryBuilder('DTLTrainerBundle:Route');

        if ($filters = $this->getActiveFilters('label_route')) {
            $qb->field('labels')->in($filters);
        }

        if ($activities = $this->getActiveFilters('activity')) {
            $ids = array();
            foreach ($activities as $activity) {
                $ids[] = new \MongoId($activity);
            }
            $qb->field('activity.$id')->in($ids);
        }

        $qb->sort('title', 'asc');
        $routes = $qb->getQuery()->execute();

        return $this->render('DTLTrainerBundle:Route:index.html.twig', array(
            'routes' => $routes
        ));
    }

    public function newAction()
    {
        $route = new Route();
        $form = $this->createForm(new RouteType(), $route);

        if ($this->processForm($form)) {
            $this->notifySuccess('Route Added');
            return $this->redirect($this->generateUrl('route_view', array('route_id' => $route->getId())));
        }

        return $this->render('DTLTrainerBundle:Route:new.html.twig', array(
            'form' => $form->createView(),
            'route' => $route,
        ));
    }

    public function editAction()
    {
        $route = $this->getRoute();
        $form = $this->createForm(new RouteType(), $route);

        if ($this->processForm($form)) {
            $this->notifySuccess('Route Updated');
            return $this->redirect($this->generateUrl('route_view', array('route_id' => $route->getId())));
        }

        return $this->render('DTLTrainerBundle:Route:edit.html.twig', array(
            'form' => $form->createView(),
            'route' => $route,
        ));
    }

    public function copyAction()
    {
        $route = $this->getRoute();
        $newRoute = $route->copy();
        $newRoute->setTitle('Copy of ' . $route->getTitle());
        $this->getDm()->persist($newRoute);
        $this->getDm()->flush();

        return $this->redirect($this->generateUrl('route_view', array('route_id' => $newRoute->getId())));
    }


    public function viewAction()
    {
        $route = $this->getRoute();

        $session = $route->createSession();
        $form = $this->createForm(new RouteSessionType(), $session, array('route' => $route));

        if ($this->processForm($form)) {
            $this->notifySuccess('Session Created');
            return $this->redirect($this->generateUrl('route_view', array('route_id' => $route->getId())));
        }

        return $this->render('DTLTrainerBundle:Route:view.html.twig', array(
            'route' => $route,
            'form' => $form->createView(),
        ));
    }

    public function deleteAction()
    {
        $route = $this->getRoute();
        $this->getDm()->remove($route);
        $this->getDm()->flush();
        $this->notifySuccess('Route Deleted');
        return $this->redirect($this->generateUrl('routes'));
    }
}

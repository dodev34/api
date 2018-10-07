<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class OAuth2AccessTokenAdmin extends AbstractAdmin
{
    /**
     * @inheritdoc
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('edit');
    }

    /**
     * @inheritdoc
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('user');
        $datagridMapper->add('client.randomId');
        $datagridMapper->add('expiresAt');
    }

    /**
     * @inheritdoc
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->add('user');
        $listMapper->add('client.randomId', null, [
            'label' => 'label.client_id',
        ]);
        $listMapper->add('expiresAt');

        // You may also specify the actions you want to be displayed in the list
        $listMapper
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    //'edit' => [],
                    //'delete' => [],
                ]
            ]);
    }

    /**
     * @inheritdoc
     */
    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper->add('user');
        $showMapper->add('token');
        $showMapper->add('expiresAt');
    }
}
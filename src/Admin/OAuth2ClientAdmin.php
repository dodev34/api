<?php

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use OAuth2\OAuth2;

/**
 * Class OAuth2ClientAdmin
 *
 * @package AppBundle\Admin
 */
class OAuth2ClientAdmin extends AbstractAdmin
{
    /**
     * @inheritdoc
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $subject = $this->getSubject();

        // define group zoning
        $formMapper
            ->with('secret_informations', ['class' => 'col-md-6'])->end()
            ->with('allowed_grant_types', ['class' => 'col-md-6'])->end()
        ;

        $randomIdOptions['label'] = 'label.client_id';
        if (null !== $subject->getId()) {
            $randomIdOptions['help'] = 'public id : <strong>' . $subject->getPublicId().'</strong>';
        }

        $formMapper
            ->with('secret_informations')
            ->add('randomId', null, $randomIdOptions)
            ->add('secret', null, [
                'label' => 'label.secret_id',
            ])
            ->end()
            ->with('allowed_grant_types')
            ->add('allowedGrantTypes', ChoiceType::class, [
                'label' => false,
                'multiple' => true,
                'required' => true,
                'choices' => [
                    OAuth2::GRANT_TYPE_AUTH_CODE => OAuth2::GRANT_TYPE_AUTH_CODE,
                    OAuth2::GRANT_TYPE_USER_CREDENTIALS => OAuth2::GRANT_TYPE_USER_CREDENTIALS,
                    OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS => OAuth2::GRANT_TYPE_CLIENT_CREDENTIALS,
                    OAuth2::GRANT_TYPE_REFRESH_TOKEN => OAuth2::GRANT_TYPE_REFRESH_TOKEN,
                    OAuth2::GRANT_TYPE_EXTENSIONS => OAuth2::GRANT_TYPE_EXTENSIONS,
                ],
                'preferred_choices' => [
                    OAuth2::GRANT_TYPE_USER_CREDENTIALS,
                    OAuth2::GRANT_TYPE_REFRESH_TOKEN
                ],
            ])
            ->end()
        ;
    }

    /**
     * @inheritdoc
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
        $datagridMapper->add('randomId', null, [
            'label' => 'label.client_id',
        ]);
        $datagridMapper->add('secret', null, [
            'label' => 'label.secret_id',
        ]);
        $datagridMapper->add('allowedGrantTypes', null, [
            'label' => 'allowed_grant_types',
        ]);
    }

    /**
     * @inheritdoc
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id');
        $listMapper->addIdentifier('randomId', null, [
            'label' => 'label.client_id',
        ]);
        $listMapper->addIdentifier('allowedGrantTypes', null,[
            'label' => 'allowed_grant_types',
        ]);

        // You may also specify the actions you want to be displayed in the list
        $listMapper
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]
            ]);
    }

    /**
     * @inheritdoc
     */
    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->with('secret_informations')
            ->add('id')
            ->add('randomId', null, [
                'label' => 'label.client_id',
            ])
            ->add('secret')
            ->end()
            ->with('allowed_grant_types')
            ->add('allowedGrantTypes', null,[
                'label' => false,
            ])
            ->end()
            ->with('tokens')
            ->add('accessTokens', null,[
                'label' => false,
            ])
            ->end()
        ;
    }
}
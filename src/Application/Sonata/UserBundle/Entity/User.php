<?php

namespace App\Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ApiResource(attributes={"access_control"="is_granted('ROLE_ADMIN')"})
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Many Users have Many Groups.
     * ORM\ManyToMany(targetEntity="Group", inversedBy="users")
     * ORM\JoinTable(name="users_groups")
     */
    protected $groups;

    /**
     * @ORM\Column(name="enterprise", type="string", length=255, unique=true, nullable=true)
     */
    protected $enterprise;

    /**
     * @ORM\Column(name="siret", type="string", length=255, unique=true, nullable=true)
     */
    protected $siret;

    /**
     * Get id.
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set enterprise.
     *
     * @param string $enterprise
     *
     * @return User
     */
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;

        return $this;
    }

    /**
     * Get enterprise.
     *
     * @return string
     */
    public function getEnterprise()
    {
        return $this->enterprise;
    }

    /**
     * Set siret.
     *
     * @param string $siret
     *
     * @return User
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret.
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }
}

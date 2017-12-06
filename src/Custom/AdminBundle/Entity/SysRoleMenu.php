<?php

namespace Custom\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysRoleMenu
 *
 * @ORM\Table(name="sys_role_menu")
 * @ORM\Entity
 */
class SysRoleMenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="bigint", nullable=true)
     */
    private $roleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="menu_id", type="bigint", nullable=true)
     */
    private $menuId;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     *
     * @return SysRoleMenu
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set menuId
     *
     * @param integer $menuId
     *
     * @return SysRoleMenu
     */
    public function setMenuId($menuId)
    {
        $this->menuId = $menuId;

        return $this;
    }

    /**
     * Get menuId
     *
     * @return integer
     */
    public function getMenuId()
    {
        return $this->menuId;
    }
}

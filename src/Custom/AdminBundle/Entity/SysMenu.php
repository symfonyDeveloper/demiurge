<?php

namespace Custom\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysMenu
 *
 * @ORM\Table(name="sys_menu")
 * @ORM\Entity
 */
class SysMenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="menu_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $menuId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=true)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=200, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="perms", type="string", length=500, nullable=true)
     */
    private $perms;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=50, nullable=true)
     */
    private $icon;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_num", type="integer", nullable=true)
     */
    private $orderNum;



    /**
     * Get menuId
     *
     * @return integer
     */
    public function getMenuId()
    {
        return $this->menuId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return SysMenu
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return SysMenu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return SysMenu
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set perms
     *
     * @param string $perms
     *
     * @return SysMenu
     */
    public function setPerms($perms)
    {
        $this->perms = $perms;

        return $this;
    }

    /**
     * Get perms
     *
     * @return string
     */
    public function getPerms()
    {
        return $this->perms;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return SysMenu
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return SysMenu
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set orderNum
     *
     * @param integer $orderNum
     *
     * @return SysMenu
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * Get orderNum
     *
     * @return integer
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }


}

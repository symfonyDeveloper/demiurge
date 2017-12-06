<?php

namespace Custom\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SysRole
 *
 * @ORM\Table(name="sys_role")
 * @ORM\Entity
 */
class SysRole
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
     * @var string
     *
     * @ORM\Column(name="role_name", type="string", length=100, nullable=true)
     */
    private $roleName;

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="string", length=100, nullable=true)
     */
    private $remark;

    /**
     * @var integer
     *
     * @ORM\Column(name="create_user_id", type="bigint", nullable=true)
     */
    private $createUserId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_time", type="datetime", nullable=true)
     */
    private $createTime;


    /**
     * Get roleId
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }


    /**
     * Set roleName
     *
     * @param string $roleName
     *
     * @return SysRole
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * Set remark
     *
     * @param string $remark
     *
     * @return SysRole
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set createUserId
     *
     * @param integer $createUserId
     *
     * @return SysRole
     */
    public function setCreateUserId($createUserId)
    {
        $this->createUserId = $createUserId;

        return $this;
    }

    /**
     * Get createUserId
     *
     * @return integer
     */
    public function getCreateUserId()
    {
        return $this->createUserId;
    }

    /**
     * Set createTime
     *
     * @param \DateTime $createTime
     *
     * @return SysRole
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * Get createTime
     *
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }
}

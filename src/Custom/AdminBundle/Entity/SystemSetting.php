<?php

namespace Custom\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SystemSetting
 *
 * @ORM\Table(name="system_setting")
 * @ORM\Entity
 */
class SystemSetting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="param_id", type="string", length=15, nullable=false)
     */
    private $paramId;

    /**
     * @var string
     *
     * @ORM\Column(name="param_type", type="string", length=32, nullable=false)
     */
    private $paramType;

    /**
     * @var string
     *
     * @ORM\Column(name="param_key", type="string", length=50, nullable=true)
     */
    private $paramKey;

    /**
     * @var string
     *
     * @ORM\Column(name="param_value", type="string", length=1000, nullable=true)
     */
    private $paramValue;

    /**
     * @var string
     *
     * @ORM\Column(name="memo", type="string", length=100, nullable=true)
     */
    private $memo;



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
     * Set paramId
     *
     * @param string $paramId
     *
     * @return SystemSetting
     */
    public function setParamId($paramId)
    {
        $this->paramId = $paramId;

        return $this;
    }

    /**
     * Get paramId
     *
     * @return string
     */
    public function getParamId()
    {
        return $this->paramId;
    }

    /**
     * Set paramType
     *
     * @param string $paramType
     *
     * @return SystemSetting
     */
    public function setParamType($paramType)
    {
        $this->paramType = $paramType;

        return $this;
    }

    /**
     * Get paramType
     *
     * @return string
     */
    public function getParamType()
    {
        return $this->paramType;
    }

    /**
     * Set paramKey
     *
     * @param string $paramKey
     *
     * @return SystemSetting
     */
    public function setParamKey($paramKey)
    {
        $this->paramKey = $paramKey;

        return $this;
    }

    /**
     * Get paramKey
     *
     * @return string
     */
    public function getParamKey()
    {
        return $this->paramKey;
    }

    /**
     * Set paramValue
     *
     * @param string $paramValue
     *
     * @return SystemSetting
     */
    public function setParamValue($paramValue)
    {
        $this->paramValue = $paramValue;

        return $this;
    }

    /**
     * Get paramValue
     *
     * @return string
     */
    public function getParamValue()
    {
        return $this->paramValue;
    }

    /**
     * Set memo
     *
     * @param string $memo
     *
     * @return SystemSetting
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * Get memo
     *
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }
}

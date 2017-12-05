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
     * @return int
     */
    public function getId(): int
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
     * @return string
     */
    public function getParamId(): string
    {
        return $this->paramId;
    }

    /**
     * @param string $paramId
     */
    public function setParamId(string $paramId)
    {
        $this->paramId = $paramId;
    }

    /**
     * @return string
     */
    public function getParamType(): string
    {
        return $this->paramType;
    }

    /**
     * @param string $paramType
     */
    public function setParamType(string $paramType)
    {
        $this->paramType = $paramType;
    }

    /**
     * @return string
     */
    public function getParamKey(): string
    {
        return $this->paramKey;
    }

    /**
     * @param string $paramKey
     */
    public function setParamKey(string $paramKey)
    {
        $this->paramKey = $paramKey;
    }

    /**
     * @return string
     */
    public function getParamValue(): string
    {
        return $this->paramValue;
    }

    /**
     * @param string $paramValue
     */
    public function setParamValue(string $paramValue)
    {
        $this->paramValue = $paramValue;
    }

    /**
     * @return string
     */
    public function getMemo(): string
    {
        return $this->memo;
    }

    /**
     * @param string $memo
     */
    public function setMemo(string $memo)
    {
        $this->memo = $memo;
    }



}


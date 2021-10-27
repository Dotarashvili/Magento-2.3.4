<?php

namespace Devall\DavidOtarashvili\Model;

use Devall\DavidOtarashvili\Api\Data\CompanyInterface;
use Magento\Framework\Model\AbstractExtensibleModel;


class Company extends AbstractExtensibleModel implements CompanyInterface
{
    /**
     * @inheritDoc
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return parent::getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getCountry()
    {
        return parent::getData(self::COUNTRY);
    }


    /**
     * @param $country
     * @return Company|string
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * @inheritDoc
     */
    public function getStreet()
    {
        return $this->getData(self::STREET);
    }

    /**
     * @inheritDoc
     */
    public function setStreet($street)
    {
        return $this->setData(self::STREET, $street);
    }

    /**
     * @inheritDoc
     */
    public function getStreetNum()
    {
        return $this->getData(self::STREET_NUMBER);
    }

    /**
     * @inheritDoc
     */
    public function setStreetNum($street_number)
    {
        return $this->setData(self::STREET_NUMBER, $street_number);
    }

    /**
     * @inheritDoc
     */
    public function getSize()
    {
        return $this->getData(self::SIZE);
    }

    /**
     * @inheritDoc
     */
    public function setSize($size)
    {
        return $this->setData(self::SIZE, $size);
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Company::class);
    }
}

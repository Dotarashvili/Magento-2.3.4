<?php

namespace Devall\DavidOtarashvili\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CompanyInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const COUNTRY = 'country';
    const STREET = 'street';
    const STREET_NUMBER = 'street_number';
    const SIZE = 'size';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param $entityId
     * @return int
     */
    public function setId($entityId);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getCountry();

    /**
     * @param $country
     * @return string
     */
    public function setCountry($country);

    /**
     * @return string
     */
    public function getStreet();

    /**
     * @param $street
     * @return string
     */
    public function setStreet($street);

    /**
     * @return string
     */
    public function getStreetNum();

    /**
     * @param $street_number
     * @return string
     */
    public function setStreetNum($street_number);

    /**
     * @return int
     */
    public function getSize();

    /**
     * @param $size
     * @return int
     */
    public function setSize($size);
}

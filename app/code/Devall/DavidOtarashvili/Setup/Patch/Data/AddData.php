<?php

namespace Devall\DavidOtarashvili\Setup\Patch\Data;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Devall\DavidOtarashvili\Model\ResourceModel\Company;
use Devall\DavidOtarashvili\Model\CompanyFactory;

class AddData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    public $moduleDataSetup;
    /**
     * @var Company
     */
    public $companyResource;
    /**
     * @var CompanyFactory
     */
    public $companyFactory;

    /**
     * @param CompanyFactory $companyFactory
     * @param Company $companyResource
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        CompanyFactory $companyFactory,
        Company $companyResource,
        ModuleDataSetupInterface $moduleDataSetup
    )
    {
        $this->companyFactory = $companyFactory;
        $this->companyResource = $companyResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @throws AlreadyExistsException
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $companyDTO = $this->companyFactory->create();
        $companyDTO->setName('Test')->setCountry('USA')->setStreet('North Kierland Blvd')->
        setStreetNum('14')->setSize(4);
        $this->companyResource->save($companyDTO);
        $this->moduleDataSetup->endSetup();
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @return string
     */
    public static function getVersion(): string
    {
        return '1.0.1';
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }

}

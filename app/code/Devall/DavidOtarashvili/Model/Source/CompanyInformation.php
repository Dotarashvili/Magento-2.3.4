<?php

namespace Devall\DavidOtarashvili\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Devall\DavidOtarashvili\Block\Company\Edit;

class CompanyInformation extends AbstractSource
{
    /**
     * @var Edit
     */
    private $edit;

    /**
     * @param Edit $edit
     */
    public function __construct(
        Edit $edit
    )
    {
        $this->edit = $edit;
    }


    /**
     * @return array
     */
    public function getAllOptions()
    {
        $companyOptions = $this->edit->getCompanyOptions();
        $options = [];
        foreach ($companyOptions as $companyOption) {
            $options[] = ['value' => $companyOption->getId(), 'label' => __($companyOption->getName())];
        }
        return $options;
    }

    /**
     * @param int|string $value
     * @return false|mixed
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option)
        {
            if ($option['value'] == $value)
            {
                return $option['label'];
            }
        }
        return false;
    }
}

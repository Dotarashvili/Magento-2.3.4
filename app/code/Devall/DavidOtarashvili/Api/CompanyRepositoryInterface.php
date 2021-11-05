<?php

namespace Devall\DavidOtarashvili\Api;

use Devall\DavidOtarashvili\Api\Data\CompanyInterface;
use Devall\DavidOtarashvili\Api\Data\CompanySearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface CompanyRepositoryInterface
{
    /**
     * @param int $id
     * @return CompanyInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param CompanyInterface $company
     * @return CompanyInterface
     * @throws CouldNotSaveException
     */
    public function save(CompanyInterface $company);

    /**
     * @param CompanyInterface $company
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(CompanyInterface $company);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CompanySearchResultInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}

<?php

namespace Devall\DavidOtarashvili\Model;

use Devall\DavidOtarashvili\Api\CompanyRepositoryInterface;
use Devall\DavidOtarashvili\Api\Data\CompanyInterface;
use Devall\DavidOtarashvili\Api\Data\CompanySearchResultInterface;
use Devall\DavidOtarashvili\Model\ResourceModel\Company;
use Devall\DavidOtarashvili\Model\ResourceModel\Company\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Devall\DavidOtarashvili\Api\Data\CompanySearchResultInterfaceFactory;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var CompanyFactory
     */
    private $companyFactory;

    /**
     * @var Company
     */
    private $companyResource;

    /**
     * @var CompanyCollectionFactory
     */
    private $companyCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CompanySearchResultInterfaceFactory
     */
    private $companySearchResultInterfaceFactory;

    /**
     * @param CompanyFactory $companyFactory
     * @param Company $companyResource
     * @param CollectionFactory $companyCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CompanySearchResultInterfaceFactory $companySearchResultInterfaceFactory
     */
    public function __construct(
        CompanyFactory $companyFactory,
        Company $companyResource,
        CollectionFactory $companyCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        CompanySearchResultInterfaceFactory $companySearchResultInterfaceFactory
    ) {
        $this->companyFactory = $companyFactory;
        $this->companyResource = $companyResource;
        $this->companyCollectionFactory = $companyCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->companySearchResultInterfaceFactory = $companySearchResultInterfaceFactory;
    }

    /**
     * @param int $id
     * @return CompanyInterface|\Devall\DavidOtarashvili\Model\Company
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $company = $this->companyFactory->create();
        $this->companyResource->load($company, $id);
        if(!$company->getId()){
            throw new NoSuchEntityException(__('Unable to find company with ID "%1"', $id));
        }
        return $company;
    }

    /**
     * @param CompanyInterface $company
     * @return CompanyInterface
     * @throws AlreadyExistsException
     */
    public function save(CompanyInterface $company)
    {
        $this->companyResource->save($company);
        return $company;
    }

    /**
     * @param CompanyInterface $company
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(CompanyInterface $company)
    {
        try {
            $this->companyResource->delete($company);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete the entry: %1', $exception->getMessage())
            );
        }
        return true;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CompanySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->companyCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->companySearchResultInterfaceFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }
}

<?php

namespace Devall\DavidOtarashvili\Block\Company;

use Devall\DavidOtarashvili\Api\CompanyRepositoryInterface;
use Devall\DavidOtarashvili\Model\Company;
use Devall\DavidOtarashvili\Model\ResourceModel\Company\Collection;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Framework\Api\ExtensibleDataInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Devall\DavidOtarashvili\Model\ResourceModel\Company\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Devall\DavidOtarashvili\Api\Data\CompanyInterface;
use Devall\DavidOtarashvili\Model\CompanyRepository;



class Edit extends Template
{
    public $collection;
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @var array
     */
    private $data;
    /**
     * @var Context
     */
    private $context;
    /**
     * @var CompanyRepository
     */
    private $companyRepo;
    /**
     * @var CurrentCustomer
     */
    private $currentCustomer;

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param CompanyRepository $companyRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CompanyRepository $companyRepo
     * @param CurrentCustomer $currentCustomer
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        CompanyRepositoryInterface $companyRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CompanyRepository $companyRepo,
        CurrentCustomer $currentCustomer,
        array $data = []
    ) {
        $this->collection = $collectionFactory;
        parent::__construct($context, $data);
        $this->companyRepository = $companyRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->data = $data;
        $this->context = $context;
        $this->companyRepo = $companyRepo;
        $this->currentCustomer = $currentCustomer;
    }

    /**
     * @return Collection
     */
    public function getCollection()
    {
        return $this->collection->create();
    }

    /**
     * @return ExtensibleDataInterface[]
     */
    public function getCompanyOptions()
    {
        try {
            $searchCriteria = $this->searchCriteriaBuilder->create();
            $options = $this->companyRepository->getList($searchCriteria)->getItems();
        } catch (LocalizedException $e) {
        }
        return $options;
    }

    /**
     * @return CompanyInterface|Company|string
     */
    public function getCompanyInformation()
    {
        try {
            $companyId = $this->currentCustomer->getCustomer()->getCustomAttribute('company_information')->getValue();
            $company = $this->companyRepo->getById((int)$companyId);
        } catch (NoSuchEntityException $e) {
            return $this->escapeHtml(__('You have not set a default company.'));
        }

        if ($company) {
            return $company;
        } else {
            return $this->escapeHtml(__('You have not set a default company.'));
        }
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->_urlBuilder->getUrl(
            'company/company/editPost',
            ['_secure' => false, 'id' => $this->getCompanyInformation()->getId()]
        );
    }
}

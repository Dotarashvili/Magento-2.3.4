<?php

namespace Devall\DavidOtarashvili\Controller\Company;

use Devall\DavidOtarashvili\Api\CompanyRepositoryInterface;
use Devall\DavidOtarashvili\Api\Data\CompanyInterface;
use Devall\DavidOtarashvili\Model\CompanyRepository;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Customer\Model\Customer;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Devall\DavidOtarashvili\Block\Company\Edit;
use Magento\Customer\Model\ResourceModel\CustomerFactory as CustomerResourceFactory;



class EditPost extends Action implements HttpPostActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var CompanyInterface
     */
    public $companyInterface;
    /**
     * @var CompanyRepositoryInterface
     */
    public $companyRepository;
    /**
     * @var Edit
     */
    public $block;
    /**
     * @var CurrentCustomer
     */
    public $currentCustomer;
    /**
     * @var CompanyRepository
     */
    public $companyRepo;
    /**
     * @var Customer
     */
    public $customerModel;
    /**
     * @var CustomerResourceFactory
     */
    public $customerResourceFactory;


    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CompanyInterface $companyInterface
     * @param CompanyRepositoryInterface $companyRepository
     * @param Edit $block
     * @param CurrentCustomer $currentCustomer
     * @param CompanyRepository $companyRepo
     * @param Customer $customerModel
     * @param CustomerResourceFactory $customerResourceFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        CompanyInterface $companyInterface,
        CompanyRepositoryInterface $companyRepository,
        Edit $block,
        CurrentCustomer $currentCustomer,
        CompanyRepository $companyRepo,
        Customer $customerModel,
        CustomerResourceFactory $customerResourceFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->companyInterface = $companyInterface;
        $this->companyRepository = $companyRepository;
        $this->block = $block;
        $this->currentCustomer = $currentCustomer;
        $this->companyRepo = $companyRepo;
        $this->customerModel = $customerModel;
        $this->customerResourceFactory = $customerResourceFactory;
    }


    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        try {
            $option = $_POST['companies'] ?? false;
            if ($option){
                $customerId = $this->currentCustomer->getCustomer()->getId();
                $customerNew = $this->customerModel->load($customerId);
                $customerData = $customerNew->getDataModel();
                $customerData->setCustomAttribute('company_information', $option);
                $customerNew->updateData($customerData);

                $customerResource = $this->customerResourceFactory->create();
                $customerResource->saveAttribute($customerNew,'company_information');
                $this->_redirect('customer/account/');
            }
        }catch (\Exception $e){
            $this->messageManager->addExceptionMessage($e, __('We can\'t save the company.'));
        }
    }
}

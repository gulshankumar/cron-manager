<?php
/**
 * This file is part of GulshanDev_CronManager Module
 * 
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Controller\Adminhtml\Job;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use GulshanDev\CronManager\Model\ResourceModel\Job\CollectionFactory;

class MassDisable extends \GulshanDev\CronManager\Controller\Adminhtml\JobManager {

    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;


    /**
     * MassDisable constructor.
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(Action\Context $context,
                                Filter $filter, CollectionFactory $collectionFactory)
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * change job status
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute() {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $collectionSize = $collection->getSize();

            foreach ($collection as $job) {
                $job->disable();
            }

            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been disabled.', $collectionSize));
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/list');
    }

}

<?php /** @noinspection PhpUndefinedClassInspection */

/**
 * This file is part of GulshanDev_CronManager Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Controller\Adminhtml\Job;

use GulshanDev\CronManager\Controller\Adminhtml\JobManager;
use GulshanDev\CronManager\Model\JobConfig;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class RefreshList extends JobManager
{
    /**
     * @var JobConfig
     */
    private $jobConfig;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * MassDisable constructor.
     * @param Action\Context $context
     * @param JobConfig $jobConfig
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(Action\Context $context,
                                JobConfig $jobConfig,
                                \Psr\Log\LoggerInterface $logger)
    {
        parent::__construct($context);
        $this->jobConfig = $jobConfig;
        $this->logger = $logger;
    }

    /**
     * change job status
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        try {
            $this->jobConfig->refresh();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage(__('Something went wrong while doing list refresh.'));
        }

        $this->messageManager->addSuccessMessage(__('Job list refreshed successfully.'));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/list');
    }

}

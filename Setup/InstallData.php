<?php /** @noinspection PhpUndefinedClassInspection */

/**
 * This file is part of GulshanDev_CronManager Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Psr\Log\LoggerInterface;

/**
 * @codeCoverageIgnore
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var \GulshanDev\CronManager\Model\JobConfig
     */
    private $jobConfig;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * InstallData constructor.
     * @param \GulshanDev\CronManager\Model\JobConfig $jobConfig
     * @param LoggerInterface $logger
     */
    public function __construct(
        \GulshanDev\CronManager\Model\JobConfig $jobConfig,
        LoggerInterface $logger
    )
    {
        $this->jobConfig = $jobConfig;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @throws \Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->jobConfig->init();
    }

}

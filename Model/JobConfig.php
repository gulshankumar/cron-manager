<?php
/**
 * This file is part of GulshanDev_CronManager Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Model;


use GulshanDev\CronManager\Model\JobFactory;
use Magento\Cron\Model\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class JobConfig
{

    /**
     * @var ConfigInterface
     */
    private $config;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;
    /**
     * @var JobFactory
     */
    private $jobFactory;

    /**
     * JobConfig constructor.
     * @param ConfigInterface $config
     * @param ScopeConfigInterface $scopeConfig
     * @param JobFactory $jobFactory
     */
    public function __construct(ConfigInterface $config,
                                ScopeConfigInterface $scopeConfig,
                                JobFactory $jobFactory)
    {
        $this->config = $config;
        $this->scopeConfig = $scopeConfig;
        $this->jobFactory = $jobFactory;
    }

    /**
     * @throws \Exception
     */
    public function init()
    {
        $this->refresh();
    }

    /**
     *
     * @throws \Exception
     */
    public function refresh()
    {
        $jobGroupsRoot = $this->config->getJobs();
        foreach ($jobGroupsRoot as $groupId => $jobsRoot) {
            foreach ($jobsRoot as $jobCode => $jobConfig):
                /** @var Job $cronManagerJob */
                $cronManagerJob = $this->jobFactory->create();
                $cronManagerJob->load($jobCode, 'job_code');
                if ($cronManagerJob->getId()) {
                    if ($cronManagerJob->getCronExpression() != $this->getCronExpression($jobConfig)) {
                        $cronManagerJob->setCronExpression($this->getCronExpression($jobConfig))
                            ->save();
                    }
                } else {
                    $cronManagerJob->setJobCode($jobCode)
                        ->setJobGroup($groupId)
                        ->setCronExpression($this->getCronExpression($jobConfig))
                        ->setStatus(Job::STATUS_ACTIVE)
                        ->save();
                }
            endforeach;
        }
    }

    /**
     * @param array $jobConfig
     * @return mixed
     */
    protected function getConfigSchedule($jobConfig)
    {
        $cronExpr = $this->scopeConfig->getValue(
            $jobConfig['config_path'],
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        return $cronExpr;
    }

    /**
     * @param array $jobConfig
     * @return null|string
     */
    private function getCronExpression($jobConfig)
    {
        $cronExpression = null;
        if (isset($jobConfig['config_path'])) {
            $cronExpression = $this->getConfigSchedule($jobConfig) ?: null;
        }

        if (!$cronExpression) {
            if (isset($jobConfig['schedule'])) {
                $cronExpression = $jobConfig['schedule'];
            }
        }
        return $cronExpression;
    }
}
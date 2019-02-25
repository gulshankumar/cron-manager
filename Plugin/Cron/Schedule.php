<?php
/**
 * This file is part of GulshanDev_CronManager Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Plugin\Cron;


use GulshanDev\CronManager\Model\JobStatusProvider;

class Schedule
{

    /**
     * @var JobStatusProvider
     */
    private $jobStatusProvider;

    /**
     * Schedule constructor.
     * @param JobStatusProvider $jobStatusProvider
     */
    public function __construct(JobStatusProvider $jobStatusProvider)
    {
        $this->jobStatusProvider = $jobStatusProvider;
    }

    /**
     * @param \Magento\Cron\Model\Schedule $subject
     * @param \Closure $proceed
     * @return bool
     */
    public function aroundTrySchedule(\Magento\Cron\Model\Schedule $subject, \Closure $proceed) {
        $result = $proceed();
        return $result && $this->jobStatusProvider->isActive($subject->getJobCode());
    }

}
<?php
/**
 * This file is part of GulshanDev_CronManager Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Model;

use GulshanDev\CronManager\Model\ResourceModel\Job\CollectionFactory;

class JobStatusProvider
{
    private $jobStatuses = [];
    private $isLoaded = false;
    /**
     * @var ResourceModel\Job\CollectionFactory
     */
    private $jobCollectionFactory;

    /**
     * JobStatusProvider constructor.
     * @param CollectionFactory $jobCollectionFactory
     */
    public function __construct(CollectionFactory $jobCollectionFactory)
    {
        $this->jobCollectionFactory = $jobCollectionFactory;
    }

    /**
     * Check if job code available in db and status active
     * if job code not in db then that job treated as active by default
     * @param $jobCode
     * @return bool
     */
    public function isActive($jobCode) {
        $statuses = $this->getJobStatuses();
        return isset($statuses[$jobCode]) ? ($statuses[$jobCode] == Job::STATUS_ACTIVE) : true;
    }

    /**
     * Get Job Statuses
     * @return array
     */
    protected function getJobStatuses() {
        if (!$this->isLoaded) {
            echo 'called------'.date();
            /*@var \GulshanDev\CronManager\Model\ResourceModel\Job\Collection $jobCollection */
            $jobCollection = $this->jobCollectionFactory->create();

            /** @var Job $job */
            foreach ($jobCollection as $job):
                $this->jobStatuses[$job->getJobCode()] = $job->getStatus();
            endforeach;
            $this->isLoaded = true;
        }
        return $this->jobStatuses;
    }
}
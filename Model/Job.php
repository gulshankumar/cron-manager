<?php
/**
 * This file is part of GulshanDev_CronManager Module
 * 
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Model;
use GulshanDev\CronManager\Model\ResourceModel\Job as JobResource;

/**
 * Class Job
 * @package GulshanDev\CronManager\Model
 *
 * @method $this setStatus($status)
 * @method int getStatus()
 * @method string getJobCode()
 * @method $this setJobCode($string)
 * @method string getCronExpression()
 * @method $this setCronExpression($string)
 * @method $this setJobGroup($string)
 * @method string getJobGroup()
 */
class Job extends \Magento\Framework\Model\AbstractModel {
    
    const STATUS_ACTIVE = 1;

    const STATUS_INACTIVE = 2;
    
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(JobResource::class);
    }
    
    /**
     * @return array
     */
    public function getStatuses() {
        return [self::STATUS_ACTIVE => __('Enabled'), self::STATUS_INACTIVE => __('Disabled')];
    }
    
    /**
     * @return String
     */
    public function getStatusText() {
        $statuses = $this->getStatuses();
        return isset($statuses[$this->getStatus()]) ? $statuses[$this->getStatus()] : '';
    }

    /**
     * Disable Cron Job
     * @return $this
     * @throws \Exception
     */
    public function disable() {
        if($this->getId() && $this->getStatus() != self::STATUS_INACTIVE) {
            $this->setStatus(self::STATUS_INACTIVE)->save();
        }
        return $this;
    }

    /**
     * Enable Cron Job
     * @return $this
     * @throws \Exception
     */
    public function enable() {
        if($this->getId() && $this->getStatus() != self::STATUS_ACTIVE) {
            $this->setStatus(self::STATUS_ACTIVE)->save();
        }
        return $this;
    }
}

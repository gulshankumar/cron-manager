<?php

/**
 * This file is part of GulshanDev_CronManager Module
 * 
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Model\ResourceModel;

class Job extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct() {
        $this->_init('cron_schedule_jobs', 'row_id');
    }

}

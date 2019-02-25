<?php

/**
 * This file is part of GulshanDev_CronManager Module
 * 
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Model\ResourceModel\Job;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'row_id';

    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(\GulshanDev\CronManager\Model\Job::class, \GulshanDev\CronManager\Model\ResourceModel\Job::class);
    }
}

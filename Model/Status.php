<?php
/**
 * This file is part of GulshanDev_CronManager Module
 *
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Model;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * @var Job \GulshanDev\CronManager\Model\Job
     */
    protected $job;

    /**
     * Constructor
     *
     * @param \GulshanDev\CronManager\Model\Job $job
     */
    public function __construct(\GulshanDev\CronManager\Model\Job $job)
    {
        $this->job = $job;
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        $availableOptions = $this->job->getStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
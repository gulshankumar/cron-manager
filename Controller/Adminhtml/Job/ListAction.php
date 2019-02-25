<?php
/**
 * This file is part of GulshanDev_CronManager Module
 * 
 * @author Gulshan Kumar <gulshan.4dream@gmail.com>
 */

namespace GulshanDev\CronManager\Controller\Adminhtml\Job;

class ListAction extends \GulshanDev\CronManager\Controller\Adminhtml\JobManager
{
    /**
     * Display processes grid action
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('GulshanDev_CronManager::cron_manager');
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Enable/Disable Cron Job'));
        $this->_view->renderLayout();
    }
}

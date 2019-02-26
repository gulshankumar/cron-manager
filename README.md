# Magento 2 - Enable/Disable cron job
Magento has a number of cron jobs that always executes and we don't really need them. And they add a little load on the server.
Sometime we feel some cron job is creating overhead to the server and we need them to be disabled but we have no control over them.
With this extension you can easily enable/disable them from Magento admin.
- Easily enable/disable Magento cron jobs

## **Installation** 
1. Composer Installation
      - Go to your Magento root dir<br />
            `cd <path_to_the_magento_root_directory>`
      - Then run the following command<br />
            `composer require gulshankumar/cron-manager`
      - Make sure that composer finished the installation without errors

 2. Command Line Installation
      - Backup your web directory and database.
      - Download the latest package available on https://github.com/gulshankumar/cron-manager
      - Navigate to your Magento root folder<br />
            `cd path_to_the_magento_root_directory`<br />
      - Upload contents of the package to your Magento root directory
      - Then run the following command<br />
            `php bin/magento module:enable GulshanDev_CronManager`<br />
   
- After install the extension, run the following command
```
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy <locale_code>
php bin/magento cache:flush
```
- Log out from the backend and login again.

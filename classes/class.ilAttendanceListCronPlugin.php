<?php

require_once __DIR__ . "/../vendor/autoload.php";

use srag\DIC\AttendanceList\DICTrait;
use srag\Plugins\AttendanceList\Cron\AttendanceListJob;

/**
 * Class ilAttendanceListCronPlugin
 *
 * @author studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class ilAttendanceListCronPlugin extends ilCronHookPlugin
{

    use DICTrait;

    const PLUGIN_CLASS_NAME = ilAttendanceListPlugin::class;
    const PLUGIN_ID = "xalicron";
    const PLUGIN_NAME = "AttendanceListCron";
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * ilAttendanceListCronPlugin constructor
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @inheritDoc
     */
    public function getPluginName() : string
    {
        return self::PLUGIN_NAME;
    }


    /**
     * @inheritDoc
     */
    public function getCronJobInstance(/*string*/ $a_job_id)/*: ?ilCronJob*/
    {
        switch ($a_job_id) {
            case AttendanceListJob::CRON_JOB_ID:
                return new AttendanceListJob();

            default:
                return null;
        }
    }


    /**
     * @inheritDoc
     */
    public function getCronJobInstances() : array
    {
        return [
            new AttendanceListJob()
        ];
    }
}

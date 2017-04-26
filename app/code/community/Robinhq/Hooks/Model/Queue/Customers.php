<?php

class Robinhq_Hooks_Model_Queue_Customers extends Jowens_JobQueue_Model_Job_Abstract
{

    /**
     * @var Mage_Customer_Model_Customer[]
     */
    protected $customers;

    /**
     * @var false|Robinhq_Hooks_Model_Api
     */
    protected $api;

    /**
     * @param Robinhq_Hooks_Model_Api $api
     * @param Robinhq_Hooks_Model_Robin_Customer[] $customers
     */
    public function __construct(Robinhq_Hooks_Model_Api $api, $customers) {
        parent::__construct();

        $this->customers = $customers;
        $this->api = $api;
    }

    public function perform()
    {
        // Add a 1/2 second sleep so we don't hit the robin api limits too quickly
        usleep(500000);
        $this->api->customers($this->customers);
    }

}
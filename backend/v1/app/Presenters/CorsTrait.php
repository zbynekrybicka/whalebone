<?php
namespace App\Presenters;

trait CorsTrait {

    /**
     *
     */
    public function startup()
    {
        parent::startup();
        $this->gethttpresponse()->setHeader('Access-Control-Allow-Headers', 'Accept, Content-Type, Authorization');
        $this->gethttpresponse()->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS');
        $this->gethttpresponse()->setHeader('Access-Control-Allow-Origin', "*");
    }

}
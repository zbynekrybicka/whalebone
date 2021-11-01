<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\DeviceService;
use Nette;


final class DevicePresenter extends Nette\Application\UI\Presenter
{
    use CorsTrait;

    private $database;
    private $deviceService;

    /**
     * DevicePresenter constructor.
     * @param Nette\Database\Connection $database
     */
    public function __construct(Nette\Database\Connection $database)
    {
        $this->database = $database;
        $this->deviceService = DeviceService::get($database);
    }



    /**
     *
     */
    public function actionRead()
    {
        $listDevice = $this->deviceService->loadAll();
        $this->sendJson($listDevice);
    }


    /**
     *
     */
    public function actionCreate()
    {
        $json = $this->getHttpRequest()->getrawBody();
        $data = json_decode($json);
        try {
            $result = $this->deviceService->create($data);
        } catch (\Exception $ex) {
            $this->getHttpResponse()->setCode(400);
            $this->sendJson($ex->getMessage());
        }
        $this->getHttpResponse()->setCode(201);
        $this->sendJson($result);
    }

    public function actionOptions()
    {
        $this->terminate();
    }

}

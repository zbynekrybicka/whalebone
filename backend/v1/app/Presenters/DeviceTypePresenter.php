<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\DeviceService;
use Nette;


final class DeviceTypePresenter extends Nette\Application\UI\Presenter
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
        $listDevice = $this->deviceService->loadTypes();
        $this->sendJson($listDevice);
    }



}

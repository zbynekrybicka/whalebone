<?php

namespace App\Services;
use Nette\Database\{
    Connection
};

/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.10.2021
 * Time: 8:49
 */
class DeviceService
{

    private static $instance;
    private $db;


    /**
     * DeviceService constructor.
     * @param $database
     */
    private function __construct(Connection $database)
    {
        $this->db = $database;
    }


    /**
     * @param $database
     * @return DeviceService
     */
    public static function get($database): DeviceService
    {
        if (!self::$instance) {
            self::$instance = new self($database);
        }
        return self::$instance;
    }


    /**
     *
     */
    public function loadAll()
    {
        return $this->db->query('SELECT device.*, device_type.title as device_type, os.title as os  
          FROM device 
          JOIN device_type ON device.device_type_id = device_type.id
          JOIN os ON device.os_id = os.id
          ORDER BY device.id ASC')->fetchAll() ?: [];
    }


    /**
     * @param $data
     * @return int|null
     * @throws \Exception
     */
    public function create($data): ?int
    {
        if ($result = $this->createDeviceValidation($data)) {
            throw new \Exception($result);
        }
        $this->db->query('INSERT INTO device (hostname, device_type_id, os_id, owner) VALUES(?, ?, ?, ?)',
            $data->hostname, $data->device_type_id, $data->os_id, $data->owner);
        return $this->db->getInsertId();
    }


    /**
     * @param $data
     * @return string|null
     */
    private function createDeviceValidation($data)
    {
        if (!isset($data->hostname) || !strlen($data->hostname)) {
            return 'Missing hostname or is empty';
        }
        if (!isset($data->device_type_id) || !intval($data->device_type_id)) {
            return 'Missing device_type_id or not int';
        }
        if (!isset($data->os_id) || !intval($data->os_id)) {
            return 'Missing os_id or not int';
        }
        if (!isset($data->owner) || !strlen($data->owner)) {
            return 'Missing owner or is empty';
        }
    }


    /**
     * @return array
     */
    public function loadTypes()
    {
        return $this->db->query('SELECT id, title FROM device_type')->fetchPairs('id', 'title');
    }


    /**
     * @return array
     */
    public function loadOs()
    {
        return $this->db->query('SELECT id, title FROM os')->fetchPairs('id', 'title');
    }


}
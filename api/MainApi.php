<?php

abstract class MainApi
{
    protected $model;
    private $status = [
        200 => '200 OK',
        204 => '204 No Content',
        404 => '404 Not Found',
        500 => '500 Internal Server Error',
    ];

    public function __construct()
    {
        Model::getInstance();
    }

    protected function response($data, $status = 404)
    {
        if (!$data) {
            $data = ['error' => 'No data'];
        }
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $this->status[$status]);
        return json_encode($data);
    }

    abstract public function get($param);

    abstract public function post($param);

    abstract public function put($param);

    abstract public function delete($param);
}
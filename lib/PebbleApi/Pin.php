<?php

namespace PebbleApi;

class Pin
{
    private $id;
    private $data = array();

	public function __construct($id, $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function toJson()
    {
        return json_encode($this->data);
    }

    public function getId()
    {
        return $this->id;
    }
}
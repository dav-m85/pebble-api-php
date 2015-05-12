<?php

namespace PebbleApi;

/**
 * Write directly pins with arrays.
 */
class JsonPin implements PinInterface
{
    /**
     * @var int Developer-implemented identifier for this pin event. Can not be re-used.
     */
    private $id;

    /**
     * @var \DateTime The start time of the event the pin represents, such as the beginning of a meeting.
     */
    private $time;

    /**
     * @var array Data to be sent
     */
    private $data;

    /**
     * @param $id
     * @param \DateTime $time
     * @param array     $data
     */
    public function __construct(
        $id,
        \DateTime $time,
        array $data
    ) {
        $this->id = $id;
        $this->time = $time;
        $this->data = $data;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array_merge(
            array_filter([
                'id' => $this->id,
                'time' => $this->time->format('Y-m-d\TH:i:s\Z')
            ]),
            $this->data
        );
    }
}

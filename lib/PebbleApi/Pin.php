<?php

namespace PebbleApi;

class Pin
{
    /**
     * @var int Developer-implemented identifier for this pin event. Can not be re-used.
     */
    private $id;

    /**
     * @var DateTime The start time of the event the pin represents, such as the beginning of a meeting.
     */
    private $time;

    /**
     * @var int The duration of the event the pin represents, in minutes.
     */
    private $duration;

    /**
     * @var Notification The notification shown when the event is first created.
     */
    private $createNotification;

    /**
     * @var Notification The notification shown when the event is updated but already exists.
     */
    private $updateNotification;

    /**
     * @var Layout Description of the values to populate the layout when the user views the pin.
     */
    private $layout;

    /**
     * @var Reminder[] Collection of event reminders to display before an event starts (max 3).
     */
    private $reminders = array();

    /**
     * @var Action[] Collection of event actions that can be executed by the user.
     */
    private $actions = array();

    /**
     * @param $id
     * @param \DateTime $time
     * @param Layout $layout
     */
    public function __construct(
        $id,
        \DateTime $time,
        LayoutInterface $layout
    ) {
        $this->id = $id;
        $this->time = $time;
        $this->layout = $layout;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return array_filter([
            'id' => $this->id,
            'time' => $this->time->format('Y-m-d\TH:i:s\Z'),
            'duration' => $this->duration,
            'layout' => $this->layout->getData()
        ]);
    }

    /**
     * @param int $duration The duration of the event the pin represents, in minutes.
     * @return Pin
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }
}

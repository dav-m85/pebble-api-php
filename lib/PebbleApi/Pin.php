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

    public function __construct(
        $id,
        \DateTime $time,
        Layout $layout,
        $duration = null,
        Notification $createNotification = null,
        Notification $updateNotification = null,
        array $reminders = null,
        array $actions = null
    ) {
        $this -> layout = $layout;
        $this -> duration = $duration;
        $this -> createNotification = $createNotification;
        $this -> updateNotification = $updateNotification;
        $this -> pinAction = $pinAction;
    }

    public function getData()
    {
        $createNotification = $this -> createNotification ? $this -> createNotification -> getData() : null;
        $updateNotification = $this -> updateNotification ? $this -> updateNotification -> getData() : null;

        return array_filter(['id' => $this -> id, 'time' => $this -> time, 'duration' => $this -> duration,'createNotification' => $createNotification, 'updateNotification' => $updateNotification,'layout' => $this -> layout -> getData(), 'reminders' => $this -> reminders, '' ]);
    }

    public function addReminder(Reminder $reminder)
    {
        if (count($this -> reminders) < 3 ) {
            array_push($this -> reminders, $reminder -> getData());

            return true;
        }

        return false;
    }
}

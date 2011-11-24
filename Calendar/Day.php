<?php

namespace DTL\TrainerBundle\Calendar;

class Day extends CalendarUnit
{
    public function getEvents()
    {
        return $this->calendar->getEventsForDate($this->getDate());
    }

    public function isInMonth()
    {
        if ($this->getDate()->format('m') == $this->calendar->getDate()->format('m')) {
            return true;
        }

        return false;
    }
}

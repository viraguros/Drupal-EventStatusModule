<?php

namespace Drupal\event_status\Services;

class EventStatusCalculator {

    public function setStatusMsg($eventDate) {

        $eventStart = strtotime($eventDate);
        $today = time();

        $timeDifference = $eventStart - $today;
        $dayDifference = round($timeDifference/(60*60*24));

        if($dayDifference == 0) {

            $message = "This event is happening today";
        }
        else if ($dayDifference >=1 ) {

            $message = $dayDifference." days left until event starts.";
        }

        else {
            $message = "This event already passed.";
        }
        
        return $message;
    }
}


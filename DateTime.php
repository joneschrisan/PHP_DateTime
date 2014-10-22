<?php

/********************
 *
 * Author:      Chris Jones
 * Date:        Wed Nov 06 2013
 * Version:     1.0
 *
 *****************************************/

/********************
 *
 * __construct([String datetime [, Array working_days [, Array holidays]]])
 * 
 * datetime is a datetime string in sql datetime format (YYYY-mm-dd HH:mm:ss) Default null
 *
 * __construct([Integer timestamp [, Array working_days [, Array holidays]]])
 *
 * timestamp is a unix timestamp integer Default null
 *
 * If no datetime or timestamp is given then the date and time of the server at the instance of the
 *   object will be used.
 *  
 *  working_days is an array of numbers:
 *   1: Monday
 *   2: Tuesday
 *   3: Wednesday
 *   4: Thursday
 *   5: Friday
 *   6: Saturday
 *   7: Sunday
 *  working_days default null
 *  
 *  holidays is an array of datetime strings in sql datetime format (YYYY-mm-dd HH:mm:ss) Default null
 * 
 * 
 * add_working_days(Integer days_to_add [, Array working_days [, Array holidays [, String returns]]])
 *  
 *  Use working_days and holidays to change the respective arrays set in the construct. Both default null.
 *  
 *  returns is a string to format the datetime returned. Default null.
 *   if returns is set then method will return a datetime string of format given
 *
 * 
 * minus_working_days(Integer days_to_add [, Array working_days [, Array holidays [, String returns]]])
 *  
 *  Use working_days and holidays to change the respective arrays set in the construct. Both default null.
 *  
 *  returns is a string to format the datetime returned. Default null.
 *   if returns is set then method will return a datetime string of format given
 *
 *****************************************/

namespace chris_jones;

class DateTime extends \DateTime {
    
    public $working_days = array(1, 2, 3, 4, 5);
    public $holidays = array();
    
    public function __construct($date = null, $working_days = null, $holidays = null) {
        if($date === null) {
            if(USE_DATABASE_TIME) {
                $row = mysql_fetch_assoc($GLOBALS['dbh']->mysql_query("select now() as datetime"));
                parent::__construct($row['datetime']);
            } else {
                parent::__construct();
            }
        } else {
            if(is_integer($date)) {
                parent::__construct();
                $this->from_unix_time($date);
            } else {
                parent::__construct($date);
            }
        }
        
        if($working_days !== null) $this->working_days = $working_days;
        if($holidays !== null) $this->holidays = $holidays;
    }
    
    public function add_working_days($days_to_add, $working_days = null, $holidays = null, $returns = null) {
        $working_days = ($working_days === null) ? $this->working_days : $working_days;
        $holidays = ($holidays === null) ? $this->holidays : $holidays;
        
        for($i = 0; $i < $days_to_add; $i++) {
            if(!in_array($this->format("N"), $working_days)) $i--;
            if(in_array($this->format("Y-m-d"), $holidays)) $i--;
            $this->modify("+ 1 day");
        }
        
        if($returns !== null)
            return $this->format($returns);
    }
    
    public function minus_working_days($days_to_minus, $working_days = null, $holidays = null, $returns = null) {
        $working_days = ($working_days === null) ? $this->working_days : $working_days;
        $holidays = ($holidays === null) ? $this->holidays : $holidays;
        
        for($i = 0; $i < $days_to_minus; $i++) {
            if(!in_array($this->format("N"), $working_days)) $i--;
            if(in_array($this->format("Y-m-d"), $holidays)) $i--;
            $this->modify("- 1 day");
        }
        
        if($returns !== null)
            return $this->format($returns);
    }
    
    public function from_unix_time($unix_timestamp) {
        $this->setTimestamp(1356609600);
    }
}

?>

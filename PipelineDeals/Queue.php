<?php
namespace PipelineDeals\Queue;

/**
 * The Queue handles timing the requests to not violate the Pipeline Deals API limits
 * It DOES NOT handle queue delay across multiple PHP "loads"... for example page refreshes.
 *
 * @author Joel Colombo
 */
class PipelineDeals_Queue {

    const MAX_CALLS_PER_PERIOD = 10;
    const CALL_PERIOD_SECONDS = 5;

    private static $queue_instance = null;

    public $call_counter;

    static public function stall()
    {
        $q = PipelineDeals_Queue::getQueue();

        $time = time();
        $cc =& $q->call_counter;

        $total = 0;
        for($i=0;$i<PipelineDeals_Queue::CALL_PERIOD_SECONDS;$i++) {
            $t = $time-$i;
            if (!isset($cc[$t])) {
                $cc[$t] = 0;
            }
            $total += $cc[$t];
        }
        $allowed = PipelineDeals_Queue::MAX_CALLS_PER_PERIOD - $total;
        if ($allowed > 0) {
            return true;
        }
        if (time()<=$time) { sleep(1); }
        PipelineDeals_Queue::stall();
    }

    public static function getQueue() {
        if(!isset(self::$queue_instance)) {
            self::$queue_instance = new PipelineDeals_Queue();
        }
        return self::$queue_instance;
    }

    private function __construct()
    {
        $this->call_counter = array();
    }

}

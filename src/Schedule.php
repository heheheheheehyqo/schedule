<?php

namespace Hyqo\Schedule;

use Hyqo\Collection\Collection;

use function Hyqo\Task\task;

class Schedule
{
    /** @var \DateTimeZone */
    protected $timezone;

    /** @var Job[] */
    protected $jobs = [];

    public function __construct()
    {
        $this->timezone = new \DateTimeZone(date_default_timezone_get());
    }

    public function task(string $classname, array $options = []): Job
    {
        return $this->jobs[] = new Job(static function () use ($classname, $options){
            return task($classname, $options);
        });
    }
}

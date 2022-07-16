<?php

namespace Hyqo\Schedule;

class Job
{
    /** @var $callable */
    protected $callable;

    /** @var string */
    protected $expression = '* * * * *';

    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function setExpression(string $expression): self
    {
        $this->expression = $expression;

        return $this;
    }

    protected function updateExpression(int $position, string $value): self
    {
        $segments = explode(' ', $this->expression);

        $segments[$position - 1] = $value;

        return $this->setExpression(implode(' ', $segments));
    }

    public function at(string $time): self
    {
        return $this->dailyAt($time);
    }

    public function dailyAt(string $time): self
    {
        $segments = explode(':', $time, 2);

        return $this
            ->updateExpression(1, (int)($segments[1] ?? '0'))
            ->updateExpression(2, (int)$segments[0]);
    }

    public function hourly(): self
    {
        return $this->updateExpression(1, 0);
    }

    public function hourlyAt(int $minute): self
    {
        return $this->updateExpression(1, $minute);
    }

    public function everyTwoHours(): self
    {
        return $this
            ->updateExpression(1, 0)
            ->updateExpression(1, '*/2');
    }

    public function everyThreeHours(): self
    {
        return $this
            ->updateExpression(1, 0)
            ->updateExpression(1, '*/3');
    }

    public function everyFourHours(): self
    {
        return $this
            ->updateExpression(1, 0)
            ->updateExpression(1, '*/4');
    }

    public function everyFiveHours(): self
    {
        return $this
            ->updateExpression(1, 0)
            ->updateExpression(1, '*/5');
    }

    public function everySixHours(): self
    {
        return $this
            ->updateExpression(1, 0)
            ->updateExpression(1, '*/6');
    }
}

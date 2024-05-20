<?php

namespace Bermuda\Benchmark;

use Bermuda\Stdlib\Byte;

final class Benchmarker
{
    /**
     * @var callable
     */
    private $tickHandler;

    public function bench(callable $benchmark, int $iterations = 10000): BenchmarkResult
    {
        set_time_limit(1000);
        $its = $iterations;

        $start = microtime(true);
        $memory = 0;

        while ($iterations--) {
            $benchmark();
            $memory += memory_get_usage(true);
            if ($this->tickHandler) ($this->tickHandler)();
        }

        $memory_peak = memory_get_peak_usage(true);
        $execTime = microtime(true) - $start;

        return new BenchmarkResult(
            $its,
            new Byte(round($memory/$its)),
            new Byte(round($memory_peak)),
            $execTime,
        );
    }

    public function setTickHandler(?callable $tick): self
    {
        $this->tickHandler = $tick;
        return $this;
    }
}

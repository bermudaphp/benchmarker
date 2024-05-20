<?php

namespace Bermuda\Benchmark;

use Bermuda\Stdlib\Byte;

final class BenchmarkResult
{
    public function __construct(
        public readonly int $iterations,
        public readonly Byte $memoryUsage,
        public readonly Byte $memoryPeakUsage,
        public readonly float $executionTime,
    ){
    }
}

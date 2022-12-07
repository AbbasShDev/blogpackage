<?php

namespace AbbasShDev\BlogPackage;

class Calculator
{
    private float|int $result;

    public function __construct()
    {
        $this->result = 0;
    }

    public function add(float|int $value): self
    {
        $this->result += $value;

        return $this;
    }

    public function subtract(float|int $value): self
    {
        $this->result -= $value;

        return $this;
    }

    public function clear(): self
    {
        $this->result = 0;

        return $this;
    }

    public function getResult(): float|int
    {
        return $this->result;
    }
}
<?php

/*
 * This file is part of the lanehub/laravel-bit-status.
 *
 * (c) liyu <liyu001989@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Lanehub\LaravelBitStatus;

use Lanehub\LaravelBitStatus\Exceptions\InvalidArgumentException;

/**
 * Laravel Eloquent Model Trait.
 *
 * @author liyu <liyu001989@gmail.com>
 */
trait BitStatusTrait
{
    /**
     * transBitStatus.
     *
     * @return int
     */
    protected function transBitStatus(int $bitStatus)
    {
        if ($bitStatus < 1) {
            throw new InvalidArgumentException('bit stauts should not less than 1');
        }

        return 1 << ($bitStatus - 1);
    }

    /**
     * getBitStatus.
     *
     * @return bool
     */
    public function getBitStatus(string $attribute, int $bitStatus)
    {
        $bit = $this->transBitStatus($bitStatus);

        return ($this->$attribute & $bit) == $bit;
    }

    /**
     * setBitStatus.
     *
     * @return $this
     */
    public function setBitStatus(string $attribute, int $bitStatus, bool $value = true)
    {
        $bit = $this->transBitStatus($bitStatus);

        if ($value) {
            $this->$attribute |= $bit;
        } else {
            $this->$attribute &= ~$bit;
        }

        return $this;
    }
}

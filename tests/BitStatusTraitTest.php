<?php

/*
 * This file is part of the lanehub/laravel-bit-status.
 *
 * (c) liyu <liyu001989@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Lanehub\LaravelBitStatus\BitStatusTrait;
use Lanehub\LaravelBitStatus\Exceptions\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BitStatusTraitTest extends TestCase
{
    public function testGetBitStatus()
    {
        $obj = $this->getObjectForTrait(BitStatusTrait::class);
        $obj->status = 0;
        $this->assertSame($obj->getBitStatus('status', 1), false);

        $obj->status = 1;
        $this->assertSame($obj->getBitStatus('status', 1), true);
        $this->assertSame($obj->getBitStatus('status', 2), false);

        $obj->status = 4;
        $this->assertSame($obj->getBitStatus('status', 1), false);
        $this->assertSame($obj->getBitStatus('status', 2), false);
        $this->assertSame($obj->getBitStatus('status', 3), true);
        $this->assertSame($obj->getBitStatus('status', 4), false);

        $obj->status = 9;
        $this->assertSame($obj->getBitStatus('status', 1), true);
        $this->assertSame($obj->getBitStatus('status', 2), false);
        $this->assertSame($obj->getBitStatus('status', 3), false);
        $this->assertSame($obj->getBitStatus('status', 4), true);
    }

    public function testGetBitStatusWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        $obj = $this->getObjectForTrait(BitStatusTrait::class);
        $obj->status = 0;
        $obj->getBitStatus('status', 0);
    }

    public function testSetBitStatus()
    {
        $obj = $this->getObjectForTrait(BitStatusTrait::class);

        $obj->status = 0;
        $obj->setBitStatus('status', 1);
        $this->assertSame($obj->status, 1);

        $obj->status = 0;
        $obj->setBitStatus('status', 1, true);
        $this->assertSame($obj->status, 1);

        $obj->status = 0;
        $obj->setBitStatus('status', 1);
        $obj->setBitStatus('status', 2);
        $this->assertSame($obj->status, 3);

        $obj->status = 0;
        $obj->setBitStatus('status', 1, true);
        $obj->setBitStatus('status', 2, false);
        $obj->setBitStatus('status', 3, false);
        $obj->setBitStatus('status', 4, true);
        $this->assertSame($obj->status, 9);

        $obj->status = 15; // 1111
        $obj->setBitStatus('status', 3, false);
        $this->assertSame($obj->status, 11);
    }

    public function testSetBitStatusWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        $obj = $this->getObjectForTrait(BitStatusTrait::class);
        $obj->status = 0;
        $obj->setBitStatus('status', -1);
    }
}

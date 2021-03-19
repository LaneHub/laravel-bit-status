<?php

use PHPUnit\Framework\TestCase;
use Yuanling\LaravelBitStatus\BitStatusTrait;
use Yuanling\LaravelBitStatus\Exceptions\InvalidArgumentException;

class BitStatusTraitTest extends TestCase
{
    public function testGetBitStatus()
    {
        $obj = $this->getObjectForTrait(BitStatusTrait::class);
        $obj->status = 0;
        $this->assertEquals($obj->getBitStatus('status', 1), false);

        $obj->status = 1;
        $this->assertEquals($obj->getBitStatus('status', 1), true);
        $this->assertEquals($obj->getBitStatus('status', 2), false);

        $obj->status = 4;
        $this->assertEquals($obj->getBitStatus('status', 1), false);
        $this->assertEquals($obj->getBitStatus('status', 2), false);
        $this->assertEquals($obj->getBitStatus('status', 3), true);
        $this->assertEquals($obj->getBitStatus('status', 4), false);

        $obj->status = 9;
        $this->assertEquals($obj->getBitStatus('status', 1), true);
        $this->assertEquals($obj->getBitStatus('status', 2), false);
        $this->assertEquals($obj->getBitStatus('status', 3), false);
        $this->assertEquals($obj->getBitStatus('status', 4), true);
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
        $this->assertEquals($obj->status, 1);

        $obj->status = 0;
        $obj->setBitStatus('status', 1, true);
        $this->assertEquals($obj->status, 1);

        $obj->status = 0;
        $obj->setBitStatus('status', 1);
        $obj->setBitStatus('status', 2);
        $this->assertEquals($obj->status, 3);

        $obj->status = 0;
        $obj->setBitStatus('status', 1, true);
        $obj->setBitStatus('status', 2, false);
        $obj->setBitStatus('status', 3, false);
        $obj->setBitStatus('status', 4, true);
        $this->assertEquals($obj->status, 9);

        $obj->status = 15; // 1111
        $obj->setBitStatus('status', 3, false);
        $this->assertEquals($obj->status, 11);
    }

    public function testSetBitStatusWithInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        $obj = $this->getObjectForTrait(BitStatusTrait::class);
        $obj->status = 0;
        $obj->setBitStatus('status', -1);
    }
}

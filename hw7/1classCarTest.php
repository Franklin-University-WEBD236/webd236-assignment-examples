<?php
include "code.php";

use PHPUnit\Framework\TestCase;

final class CodeTest extends TestCase
{
    public function testConstructorSetsInitialState(): void
    {
        $car = new Car(20.0, 10.0);
        $this->assertEquals(0.0, $car->readOdometer());
        $this->assertEquals(20.0, $car->readFuelGauge());
    }

    public function testNormalDriveUpdatesFuelAndOdometer(): void
    {
        $car = new Car(20.0, 10.0);
        $car->drive(15.0);
        $this->assertEquals(15.0, $car->readOdometer());
        $this->assertEquals(18.5, $car->readFuelGauge());
    }

    public function testCarWithEmptyTankCannotDrive(): void
    {
        $car = new Car(0.0, 10.0);
        $car->drive(15.0);
        $this->assertEquals(0.0, $car->readOdometer());
        $this->assertEquals(0.0, $car->readFuelGauge());
    }

    public function testExactFuelExhaustion(): void
    {
        $car = new Car(5.0, 10.0);
        $car->drive(50.0);
        $this->assertEquals(50.0, $car->readOdometer());
        $this->assertEquals(0.0, $car->readFuelGauge());
    }

    public function testDriveStopsWhenFuelRunsOut(): void
    {
        $car = new Car(5.0, 10.0);
        $car->drive(150.0);
        $this->assertEquals(50.0, $car->readOdometer());
        $this->assertEquals(0.0, $car->readFuelGauge());
    }

    public function testSuccessiveDrivesAccumulate(): void
    {
        $car = new Car(20.0, 10.0);
        $car->drive(10.0);
        $car->drive(5.0);
        $this->assertEquals(15.0, $car->readOdometer());
        $this->assertEquals(18.5, $car->readFuelGauge());
    }

    public function testAddGasSupportsFurtherDriving(): void
    {
        $car = new Car(5.0, 10.0);
        $this->assertNull($car->addGas(10.0));
        $car->drive(10.0);
        $this->assertEquals(10.0, $car->readOdometer());
        $this->assertEquals(14.0, $car->readFuelGauge());
    }
}

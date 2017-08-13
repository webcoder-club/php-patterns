<?php

/* Сложные части системы */
class CPU
{
    public function freeze() { /* ... */ }
    public function jump( $position ) { /* ... */ }
    public function execute() { /* ... */ }

}

class Memory
{
    public function load( $position, $data ) { /* ... */ }
}

class HardDrive
{
    public function read( $lba, $size ) { /* ... */ }
}

/* Фасад */
class Computer
{
    protected $cpu;
    protected $memory;
    protected $hardDrive;

    public function __construct()
    {
        $this->cpu = new CPU();
        $this->memory = new Memory();
        $this->hardDrive = new HardDrive();
    }

    public function startComputer()
    {
        $this->cpu->freeze();
        $this->memory->load( BOOT_ADDRESS, $this->hardDrive->read( BOOT_SECTOR, SECTOR_SIZE ) );
        $this->cpu->jump( BOOT_ADDRESS );
        $this->cpu->execute();
    }
}

/* Клиентская часть */
$facade = new Computer();
$facade->startComputer();

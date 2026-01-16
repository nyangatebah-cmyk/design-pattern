<?php
// Subsystem class 1
class CPU {
    public function freeze() {
        echo "CPU frozen.
";
    }

    public function jump($position) {
        echo "CPU jumped to position $position.
";
    }

    public function execute() {
        echo "CPU executing instructions.
";
    }
}

// Subsystem class 2
class Memory {
    public function load($position, $data) {
        echo "Memory loaded with data '$data' at position $position.
";
    }
}

// Subsystem class 3
class HardDrive {
    public function read($lba, $size) {
        echo "Reading $size bytes from hard drive at position $lba.
";
        return "data";
    }
}

// Facade class
class ComputerFacade {
    private $cpu;
    private $memory;
    private $hardDrive;

    public function __construct() {
        $this->cpu = new CPU();
        $this->memory = new Memory();
        $this->hardDrive = new HardDrive();
    }

    // Simplified startup process
    public function start() {
        echo "Starting computer...
";
        $this->cpu->freeze();
        $data = $this->hardDrive->read(0, 1024);
        $this->memory->load(0, $data);
        $this->cpu->jump(0);
        $this->cpu->execute();
        echo "Computer started successfully!
";
    }
}

// Usage example
$computer = new ComputerFacade();
$computer->start();
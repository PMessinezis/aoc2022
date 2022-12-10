<?php

$input = <<<TEXT
noop
noop
noop
addx 4
addx 3
addx 3
addx 3
noop
addx 2
addx 1
addx -7
addx 10
addx 1
addx 5
addx -3
addx -7
addx 13
addx 5
addx 2
addx 1
addx -30
addx -8
noop
addx 3
addx 2
addx 7
noop
addx -2
addx 5
addx 2
addx -7
addx 8
addx 2
addx 5
addx 2
addx -12
noop
addx 17
addx 3
addx -2
addx 2
noop
addx 3
addx -38
noop
addx 3
addx 4
noop
addx 5
noop
noop
noop
addx 1
addx 2
addx 5
addx 2
addx -3
addx 4
addx 2
noop
noop
addx 7
addx -30
addx 31
addx 4
noop
addx -24
addx -12
addx 1
addx 5
addx 5
noop
noop
noop
addx -12
addx 13
addx 4
noop
addx 23
addx -19
addx 1
addx 5
addx 12
addx -28
addx 19
noop
addx 3
addx 2
addx 5
addx -40
addx 4
addx 32
addx -31
noop
addx 13
addx -8
addx 5
addx 2
addx 5
noop
noop
noop
addx 2
addx -7
addx 8
addx -7
addx 14
addx 3
addx -2
addx 2
addx 5
addx -40
noop
noop
addx 3
addx 4
addx 1
noop
addx 2
addx 5
addx 2
addx 21
noop
addx -16
addx 3
noop
addx 2
noop
addx 1
noop
noop
addx 4
addx 5
noop
noop
noop
noop
noop
noop
noop
TEXT;


$testSmall = <<<TEXT
noop
addx 3
addx -5
TEXT;

$test = <<<TEXT
addx 15
addx -11
addx 6
addx -3
addx 5
addx -1
addx -8
addx 13
addx 4
noop
addx -1
addx 5
addx -1
addx 5
addx -1
addx 5
addx -1
addx 5
addx -1
addx -35
addx 1
addx 24
addx -19
addx 1
addx 16
addx -11
noop
noop
addx 21
addx -15
noop
noop
addx -3
addx 9
addx 1
addx -3
addx 8
addx 1
addx 5
noop
noop
noop
noop
noop
addx -36
noop
addx 1
addx 7
noop
noop
noop
addx 2
addx 6
noop
noop
noop
noop
noop
addx 1
noop
noop
addx 7
addx 1
noop
addx -13
addx 13
addx 7
noop
addx 1
addx -33
noop
noop
noop
addx 2
noop
noop
noop
addx 8
noop
addx -1
addx 2
addx 1
noop
addx 17
addx -9
addx 1
addx 1
addx -3
addx 11
noop
noop
addx 1
noop
addx 1
noop
noop
addx -13
addx -19
addx 1
addx 3
addx 26
addx -30
addx 12
addx -1
addx 3
addx 1
noop
noop
noop
addx -9
addx 18
addx 1
addx 2
noop
noop
addx 9
noop
noop
noop
addx -1
addx 2
addx -37
addx 1
addx 3
noop
addx 15
addx -21
addx 22
addx -6
addx 1
noop
addx 2
addx 1
noop
addx -10
noop
noop
addx 20
addx 1
addx 2
addx 2
addx -6
addx -11
noop
noop
noop
TEXT;

class CRT {
    public $pixels=[];

    public function __construct() {
        $row = str_repeat('.',40);
        for($i=1; $i<=6; $i++) $this->pixels[] = str_split($row); 
    }

    public function setPixel($pixel, $onOff=true)
    {
        $column = $pixel % 40;
        $row = intval($pixel/40);
        $this->pixels[$row][$column] = $onOff ? '#' : '.';
    }

    public function render()
    {
        return collect($this->pixels)->map(fn($r)=>implode('',$r))->implode(PHP_EOL);
    }
}


class CPU {

    public $values = [];
    public $pixel = 0;

    public function __construct(public $X = 1, public $cycle = 0, public ?CRT $crt = null) {
        $this->crt ??= new CRT;
    }

    function tick($before=null) 
    {
        $this->cycle++;
        $this->values[$this->cycle] = $value = $this->X;
        $sprite_range = range($value-1, $value+1);
        $onOff = in_array($this->pixel % 40, $sprite_range);
        $this->crt->setPixel($this->pixel, $onOff);
        $this->pixel++;
    }

    public function noop()
    {
        $this->tick();
    }

    public function addx($args) 
    {
        $value = $args[0];
        $this->tick();
        $this->tick();
        $this->X += $value;
    }

    public function execute($commandString)
    {
        $this->commands[] = $commandString;
        $parts = explode(' ', $commandString);
        $command = array_shift($parts);
        $args = $parts;
        $this->$command($args);
    }

    public function executeStream(String|Array $commands)
    {
        if (is_string($commands)) {
            $commands = trim($commands);
            $commands = $commands ? explode(PHP_EOL, $commands) : [];
        }
        foreach($commands as $command) {
            $this->execute($command);
        }
    }
}

$crt = new CRT;
$cpu = new CPU(crt:$crt);

$commands = $input;
$cpu->executeStream($commands);

$total = collect([20, 60, 100, 140, 180, 220])->map(fn($cycle)=> $cycle * $cpu->values[$cycle])->reduce(fn($v,$t)=>($t??0)+$v);

dump($total);
echo $crt->render() . PHP_EOL;


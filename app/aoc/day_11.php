<?php

use Illuminate\Support\Collection;

$input = <<<TEXT
Monkey 0:
  Starting items: 54, 98, 50, 94, 69, 62, 53, 85
  Operation: new = old * 13
  Test: divisible by 3
    If true: throw to monkey 2
    If false: throw to monkey 1

Monkey 1:
  Starting items: 71, 55, 82
  Operation: new = old + 2
  Test: divisible by 13
    If true: throw to monkey 7
    If false: throw to monkey 2

Monkey 2:
  Starting items: 77, 73, 86, 72, 87
  Operation: new = old + 8
  Test: divisible by 19
    If true: throw to monkey 4
    If false: throw to monkey 7

Monkey 3:
  Starting items: 97, 91
  Operation: new = old + 1
  Test: divisible by 17
    If true: throw to monkey 6
    If false: throw to monkey 5

Monkey 4:
  Starting items: 78, 97, 51, 85, 66, 63, 62
  Operation: new = old * 17
  Test: divisible by 5
    If true: throw to monkey 6
    If false: throw to monkey 3

Monkey 5:
  Starting items: 88
  Operation: new = old + 3
  Test: divisible by 7
    If true: throw to monkey 1
    If false: throw to monkey 0

Monkey 6:
  Starting items: 87, 57, 63, 86, 87, 53
  Operation: new = old * old
  Test: divisible by 11
    If true: throw to monkey 5
    If false: throw to monkey 0

Monkey 7:
  Starting items: 73, 59, 82, 65
  Operation: new = old + 6
  Test: divisible by 2
    If true: throw to monkey 4
    If false: throw to monkey 3
TEXT;

$test = <<<TEXT
Monkey 0:
  Starting items: 79, 98
  Operation: new = old * 19
  Test: divisible by 23
    If true: throw to monkey 2
    If false: throw to monkey 3

Monkey 1:
  Starting items: 54, 65, 75, 74
  Operation: new = old + 6
  Test: divisible by 19
    If true: throw to monkey 2
    If false: throw to monkey 0

Monkey 2:
  Starting items: 79, 60, 97
  Operation: new = old * old
  Test: divisible by 13
    If true: throw to monkey 1
    If false: throw to monkey 3

Monkey 3:
  Starting items: 74
  Operation: new = old + 3
  Test: divisible by 17
    If true: throw to monkey 0
    If false: throw to monkey 1
TEXT;


function generateFunction ($code){
    return function(...$args) use(&$code){
       return eval($code);
    };
}

class Monkey {

    public Closure $operation;
    public $inspectionsCount = 0;

    public function __construct(public $id, public Collection|Array $items, public Collection &$allMonkeys, String $operationCode, public $divisor, public $trueMonkeyID, public $falseMonkeyID) 
    {
        $this->items = collect($this->items);
        $operationCode = str_replace('old', '$old', $operationCode);
        $fullCode = <<<PHP
            \$old = \$args[0];
            return {$operationCode} ;
        PHP;
        $this->operation = generateFunction($fullCode);
    }

    public function inspectItem($old, $relaxed= true)
    {
        $new = ($this->operation)($old);       
        $new = $relaxed ? intval($new/3) : ($new % $this->allDivisorsProduct); 
        $this->allMonkeys->first(fn($m)=>$m->id == ((!($new % $this->divisor)) ? $this->trueMonkeyID : $this->falseMonkeyID))->items->push($new);
    }

    public function inspectItems($relaxed = true)
    {
        $this->allDivisorsProduct ??= ($relaxed ? 1 : $this->allMonkeys->pluck('divisor')->reduce(fn($c,$d)=>$d*$c, 1));  
        // use of product of all divisors was not my idea - SEEN ON REDDIT - KEEPS NUMBERS DOWN SO AS TO BE MANAGABLE
        while ($this->items->isNotEmpty()) {
            $item = $this->items->shift();
            $this->inspectItem($item, $relaxed);
            $this->inspectionsCount++;
        }
    }
}

function makeMonkeys(&$monkeys, $rules)
{
    $monkeyIndicator = 'Monkey ';
    $itemsIndicator = 'Starting items: ';
    $codeIndicator = 'Operation: new = ';
    $divisorIndicator = 'Test: divisible by ';
    $trueIndicator = 'If true: throw to monkey ';
    $falseIndicator = 'If false: throw to monkey ';

    $lines = collect(explode(PHP_EOL, $rules));

    $id = -1;
    $items = [];
    $operationCode = '';
    $divisor = 1;
    $trueMonkey = 0;
    $falseMonkey = -1;

    do {
        $line = $lines->shift();
        $line = str(trim($line));
        $id = $line->startsWith($monkeyIndicator) ? intval($line->after($monkeyIndicator)->__toString()) : $id;
        $items = $line->startsWith($itemsIndicator) ?  collect($line->after($itemsIndicator)->explode(',')) : $items;
        $operationCode = $line->startsWith($codeIndicator) ?  $line->after($codeIndicator) : $operationCode;
        $divisor = $line->startsWith($divisorIndicator) ?  $line->after($divisorIndicator)->__toString() : $divisor;
        $trueMonkey = $line->startsWith($trueIndicator) ?  intval($line->after($trueIndicator)->__toString()) : $trueMonkey;
        $falseMonkey = $line->startsWith($falseIndicator) ?  intval($line->after($falseIndicator)->__toString()) : $falseMonkey;
        if ($falseMonkey>=0 || $lines->isEmpty())  {
            $monkey = new Monkey($id, $items, $monkeys, $operationCode, $divisor, $trueMonkey, $falseMonkey);
            $monkeys->push($monkey);
            $falseMonkey = -1;
        }
    } while ($lines->isNotEmpty());
}




function run($rules, $rounds, $relaxed) 
{
    $monkeys = collect();
    makeMonkeys($monkeys, $rules);
    foreach(range(1,$rounds) as $round) {
        foreach($monkeys as $monkey) {
            $monkey->inspectItems(relaxed:$relaxed);
        }
    }
    $level = $monkeys->pluck('inspectionsCount')->sortDesc()->take(2)->reduce(fn($l,$i)=>$l*$i, 1);
    return $level;
}

$rules = $input;
dump(run($rules, 20, true));
dump(run($rules, 10000, false));

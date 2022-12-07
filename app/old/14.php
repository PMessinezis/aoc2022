<?php

$input = <<<TEXT
NBOKHVHOSVKSSBSVVBCS
SN -> H
KP -> O
CP -> V
FN -> P
FV -> S
HO -> S
NS -> N
OP -> C
HC -> S
NP -> B
CF -> V
NN -> O
OS -> F
VO -> V
HK -> N
SV -> V
VC -> V
PH -> K
NH -> O
SB -> N
KS -> V
CB -> H
SS -> P
SP -> H
VN -> K
VP -> O
SK -> V
VF -> C
VV -> B
SF -> K
HH -> K
PV -> V
SO -> H
NK -> P
NO -> C
ON -> S
PB -> K
VS -> H
SC -> P
HS -> P
BS -> P
CS -> P
VB -> V
BP -> K
FH -> O
OF -> F
HF -> F
FS -> C
BN -> O
NC -> F
FC -> B
CV -> V
HN -> C
KF -> K
OO -> P
CC -> S
FF -> C
BC -> P
PP -> F
KO -> V
PC -> B
HB -> H
OB -> N
OV -> S
KH -> B
BO -> B
HV -> P
BV -> K
PS -> F
CH -> C
SH -> H
OK -> V
NB -> K
BF -> S
CO -> O
NV -> H
FB -> K
FO -> C
CK -> P
BH -> B
OH -> F
KB -> N
OC -> K
KK -> O
CN -> H
FP -> K
VH -> K
VK -> P
HP -> S
FK -> F
BK -> H
KV -> V
BB -> O
KC -> F
KN -> C
PO -> P
NF -> P
PN -> S
PF -> S
PK -> O
TEXT;

$test = <<<TEXT
NNCB
CH -> B
HH -> N
CB -> H
NH -> C
HB -> C
HC -> B
HN -> C
NN -> C
BH -> H
NC -> B
NB -> B
BN -> B
BB -> N
BC -> B
CC -> N
CN -> C
TEXT;

function parseInput($input)
{
    $replacements = explode(PHP_EOL, $input);
    $initial = array_shift($replacements);
    $replacements = collect($replacements)->mapWithKeys(function($m){
        $m = collect(explode(' ', $m))->reject(fn($p)=>$p == '->');
        return [$m->first()=>$m->last()];
    })->toArray();
    return compact('initial', 'replacements');
}

function executereplacements($data, $rounds)
{
    $polymer = $data['initial'];
    $replacements = $data['replacements'];
    $pairs = array_keys($replacements);
    echo $polymer. PHP_EOL;
    for ($round=1; $round<=$rounds; $round++){
        $newPolymer = ''; 
        for ($i=1; $i<strLen($polymer); $i++) {
            $pair = substr($polymer, $i-1, 2);
            if ($i==1) {
                $newPolymer .= $pair[0];
            }
            if (in_array($pair,$pairs)) {
                $insert = $replacements[$pair];
                $newPolymer .=  $insert . $pair[1];
            } else {
                $newPolymer .= $pair[1];
            }
        }
        $polymer = $newPolymer;
        echo '.';
    }
    echo PHP_EOL;
    return $polymer;
}


$data = parseInput($test);

$polymer = executereplacements($data,40);
$stats = collect(str_split($polymer))->map(fn($c)=>['c'=>$c])->groupBy('c')->map->count()->sort();
$result = $stats->last()-$stats->first();
dd($stats, $result);


<?php

namespace AOC2022;

$input = <<<TEXT
000101002102003121323241144233304242044444224322555122224111442430042002422404011033200102312010222
221001210320111200023341022214223134031413111451532412355524552433013131441430430230031133003002220
122221231000323320200234443123410222443555111531251244245532551533102324231134241400331231103311202
002101002220302234344333042430134115513332123415135441434515521411543331101323034131002231322012200
012103211131230310231112144234315535452455525223214133132235223543125544102124134031231131222210112
111130002131003013423030312121141451112312221535313252455443343322525321202043441240023211102333110
010101133203222432223112115322531452121232111514435241332455323133154311225111113101042100133231220
212312122201423311012344443454341224424241453264363522215552425444132445311420002412240101220213301
101023311332333312310042312545121541355232566342466654642446644123243354413142100010434411303120123
120130020344442212321452432111214314224425462535564426355544623222244543342221430323224303412123123
100122201433440301022421212153344326335254336332362524455255536253422121511215542111404434333203131
013302033043421031435312253135354263224222465554566325364566463622366241143414135130441301243233112
313033320031421022413344311554263463336555324665326464442663522563423242343515255141042434110313302
202110330220024351355553524343353263452564662444652264664644263222422343351433313245204140031042233
231222130003131521443531513223263225523646546245776476552252433532343423256211415521111332211400213
130301412331245422242144423232442666343543766554565376667543646343245233345431144424351220201130311
101001302033443322332135463532426243534743745555757373435546545622644225322621145412552200003023222
323141130033535331332232634266266252456763755766745543637336575766635662566255111541542153120403433
301333142311131441252324455553552564677635545757576667435747446367555243356243565213424252034403411
113341013301322433454225565463624376657556766453476655643365434767354462224366636431132214233311340
244103023113455431143263324442576666454737757434543647745477733644635432526565242223252243244013342
033402244215534225426664224435664574357764644644574655653436455444346474435465652435225543122102043
122420435144215434324225642344476473673735775544685778446555534774736746346526462321413112121431124
340144412411145312554534434574536376545388774855574488858586543335733453562435324346154542245241101
404120334311531362625543547577756437446548767457867758444558847555645775665242263625423435215332442
212010435132212524655246557635374434847867584574475567446777865456536755745536535663553324141520120
330104233414152326256363475457776454854787865557558584875774464888664577563345564542526431152314144
204424552413353456325435464573447454586888444477657468877554586448477357557777242465555115454242234
100003132443552563452674364555647688778574657658657657677845556856874446765775346664235453321514311
421122231134136624523375774567546567777455768765958787894557575564788753335766552646453554553244313
220231254234454666263733633553445867457848695756678898897967856856886766755656654226425642314324424
303314254151456442346637464335864467866659665796967655766576845457844884466665643466554342325231511
001554112513566332436573643778566784647665875985896999587879587768647847644467736744333526555422114
032222531135645356643363454846585667657775788588967687579955596787755586685634747724256635155514341
200335551244366554375647558667858488687875677867666567569699898898555448586575767755664335355453351
015523555256545653574455635766645567977578969879669769675787686968848578587654453573623436523313245
122413154354345427477464686665766857766769897656999766988969599558668445557475444456442236225341342
232513331242556236476736346484477865755576796987968796787788559898768868447645667575522623645115255
155115513343454246674563554667866686757789699968997766878696957587787758887774663634662336425245425
121211421234625477775653687648849788956656689799787769677866858596885865867544747433766266522234243
125411412463453653644666878877599555886769968966879976797787797978556785776554666554434625544243533
125111332362525545467465486567588567887686776779799888897866768588888978867566653363634662422511142
431451425222366656557648858455877665869898788877889796998886899879677657488656657747565525252113115
431443443346432366667346846584967789989877668669779797898886687767766876777457674646666425654132532
351525545656354663336584775556676995579686688898989899776767867766779884868888536664345366662431313
215332512532553563577757477476698965776678889889998889989888786967876586458688477763365456436143133
155354365362542537756778665676557859686996777798978778998787877768568767544754756454754233345311422
221224222534246553774375775559859578888779669898977878797876989675576998775846876733676454264214353
452432453264654634334555468575558985777666668797977987798996997766796899845846747447375442252542342
453231335553424444456675545687877565888789789798997899797878778788877956755774667337344546636414343
253541162525564676777357876478995885677968699987798898877776689689557958475676766377575455565452321
555414542536465736673775475585875888788686697777889798989789976996767666768666433465457362532214555
224124236446626436764764757489579765868786769889888888987899998898687798646555433474645224663454322
255332526246362477757378867446686577679698689788797889999866999668587757647565675545445662662644541
542554463433564545674688477658899896789686869779898778798879786887788587748545774757566323426521322
221323525535234333533747467755867587689697668999799988879989977889995855676865636566336652636314324
142153344255424535563586565776896769779776789877777789866876979765668578846455464774754332352322524
455144143466266766646775486464988766577986796786697768977888769997759854458674376354744434355325132
354233542542533574435477786674658756989969689678798978799776788677766957554777337575342543332134352
314322226552423445674367656855895795668776799786997677996697869586899654684578754337566343326231531
355312142422322275343775868876686577879567966888998687679797895997658576765468677537326552546444241
235252535422554667366453848674855795788758989778996697897687756897975468564885543353334455522152242
333225422342666554374433848546779957575589768877978766696697557796967654757684337557645522551215134
335131235555563267745455668544875859998796897986697976968957778675957454488463546357346424234511434
011321545432264363565367448576765668977958667969889687676775855687565885857543473335443255313122512
441241131563254445343775336845667467996589697665958687599865868695546774845375675644535364613435113
233555434234644565356456646578587488855989888688997866886896878798678874688774734662543336422325124
134522142112446634267673373557544644659978866577667965576768677674468548753467576525264422111551342
440234232512665242564476655578678656487596765595696667857989598876886764845366633334634223522135241
201123333231534434645554553345674677578459779677766777796967754477556567573445673452334543541151510
331012113351662624255336766457454768788587599588887796985895674445654444344454447444566452522343332
224012511135142432346456767563366674884584644587886776855566748864458766673533573456233245552422412
421232255423364256455266364355455648588764788688845588874684858757485445334773543635446244323145424
331100535315256343462563743673435647856476874866766446444688644458853564565376526535334242254241402
400432141313355423443444365547654648867855766448755555464655678768873734374346635434535515143521112
213114035441542566342554455546334346665844775767666674784577564756557664663523534245442351121140413
312140151134432266252456356334566444765484474474558866876844845676576747533623525435642352244422240
110114304524111124366532554457435454544484465464856774577678647737467576566322635652224211142340114
403241244335214551236434554433646643576756567846588688444557736377353773433664266641143511414003022
043144141425434212534355224455365656433467644534357666337353746556337337245654223625412235551412312
200002122031442244224635656325475445555445433366543353437343753457455774435355225321145535314024004
233033222223234153532456455545223466657375346755437344776365673634365324265543662545444355310011220
104213032434143353122226465342645644374547656637375755737345765775642563455244343522235122143414010
221300210103225231221546342643362332765663733473436476474653674475562542564226511453141450432410403
001002433444133154432122523226462532323563455334576776633564535436442654644352242532124500411122020
101010412133301314252131146332265343536245455476553635775564564366264265243244235545351244314302223
331004130041211314354353312663325253233356525255433474245422625254344335334555152353241431032122220
110332302424241311542132245535522443545463445562656552523542653563655453233323211354413334431440300
310002133122112114243524142251355565455635626653464462352555243446665634435455153541131122100231031
221013034340101121242214455253355264252445654446356363346466542323322543155321353123012012143020031
312323031223321240445311424525241136554543353544655543356324424422242433155433424302134412202103103
200331103222232430312311523131422215242546524354452645243226455523552531141134121044420021303230321
003221032320334231323434311543313544421256366626336545533532523324253534255554211110432320030001320
002001213030410031121111131121142322452354113122332235334411233453234411341431423400413112032130321
211203331323114322411142421234424555315432344243254512433312122524311443215320300420443410312313330
121203030210303443004134242331354225425411412153223454424423453455445411531200340243140321330132300
020013203133203122033341422142241334225534114115433111122135152521211322332333111230111303313301011
100122131000211034223301034012415322234122154143522313235545255134155143122000321242010032132112010
022210130000131121100420203411431312433123144335254451454421435455333142200104132010113111122222121
TEXT;


$test = <<<TEXT
30373
25512
65332
33549
35390
TEXT;


class Tree {
    public function __construct(public $row, public $column, public $height, public $visible = null, public $viewScore = 0)
    {
    }
}

function checkIfVisible(&$forest, $row, $column) 
{
    $myValue = $forest[$row][$column]->height;
    $maxRow = $forest->count()-1;
    $maxColumn = $forest->first()->count()-1;
    $fromAbove = $fromBelow = $fromLeft = $fromRight = true;
    $hidden = fn($r, $c)=>$forest[$r][$c]->height>=$myValue;
    for($i = $row-1; $i>=0; $i--) {
        if ($hidden($i,$column)) {
            $fromAbove = false;
            break;
        }
    }

    for($i = $row+1; $i<=$maxRow; $i++) {
        if ($hidden($i,$column)) {
            $fromBelow = false;
            break;
        }
    }

    for($i = $column-1; $i>=0; $i--) {
        if ($hidden($row,$i)) {
            $fromLeft = false;
            break;
        }
    }

    for($i = $column+1; $i<=$maxColumn; $i++) {
        if ($hidden($row, $i)) {
            $fromRight = false;
            break;
        }
    }
    $isVisible = $fromAbove || $fromBelow || $fromLeft || $fromRight;
    $forest[$row][$column]->visible = $isVisible;
    // if (!$isVisible) {
    //     ray(compact('row', 'column', 'myValue', 'fromAbove' , 'fromBelow' , 'fromLeft' , 'fromRight', 'isVisible') )->orange();
    //     ray()->pause();
    // }
    return $isVisible;
}

function findViewScore(&$forest, $row, $column) 
{
    $myHeight = $forest[$row][$column]->height;
    $maxRow = $forest->count()-1;
    $maxColumn = $forest->first()->count()-1;
    $fromAbove = $fromBelow = $fromLeft = $fromRight = 0;
    $lastVisible = fn($r, $c)=> ($r==0) || ($c==0) || ($r==$maxRow) || ($c==$maxColumn) || $forest[$r][$c]->height>=$myHeight;
    for($i = $row-1; $i>=0; $i--) {
        $fromAbove++;
        if ($lastVisible($i,$column)) {
            break;
        }
    }

    for($i = $row+1; $i<=$maxRow; $i++) {
        $fromBelow++;
        if ($lastVisible($i,$column)) {
            break;
        }
    }

    for($i = $column-1; $i>=0; $i--) {
        $fromLeft++;
        if ($lastVisible($row,$i)) {
            break;
        }
    }

    for($i = $column+1; $i<=$maxColumn; $i++) {
        $fromRight++;
        if ($lastVisible($row, $i)) {
            break;
        }
    }
    $score = $fromAbove * $fromBelow * $fromLeft * $fromRight;
    $forest[$row][$column]->viewScore = $score;
    return $score;
}


function setupForest($input) 
{
    $forest = collect(explode(PHP_EOL,$input))->map(fn($r)=>collect(str_split($r)));
    $forest = $forest->map(fn($trees,$row)=>$trees->map(fn($height, $column)=>new Tree($row, $column, intval($height))));
    return $forest;
}

function reviewForest(&$forest, $closure, $fromRow, $fromColumn, $toRow, $toColumn) {
    for ($row=$fromRow; $row<=$toRow; $row++) {
        for ($column=$fromColumn; $column<=$toColumn ; $column++) {
            $closure($row, $column);
        }
    }
}

function findVisible($input)
{
    $forest = setupForest($input);
    $rowsCount = $forest->count();
    $columnsCount = $forest->first()->count();
    $visible = ($rowsCount + $columnsCount - 2) * 2;
    reviewForest($forest, 
        function($row, $column) use (&$forest, &$visible) {
            $visible += checkIfVisible($forest, $row, $column);
        }, 1,1, $rowsCount-2, $columnsCount-2
    );
    return $visible;
}

function viewScore($input)
{
    $forest = setupForest($input);
    $rowsCount = $forest->count();
    $columnsCount = $forest->first()->count();
    $bestView = 0;
    reviewForest($forest, 
        function($row, $column) use (&$forest, &$visible, &$bestView) {
            $viewScore = findViewScore($forest, $row, $column);
            if ($viewScore>$bestView) {
                $bestView = $viewScore;
            }
        }, 0,0, $rowsCount-1, $columnsCount-1
    );
    return $bestView;
}

$trees = $test;
$trees = $input;

dump(findVisible($trees), viewScore($trees));
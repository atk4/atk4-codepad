hello



<div id="<?$_name?>">
<h1>Model Definition</h1>

<p>Models in Agile Toolkit are defined dynamically inside their init() method by calling addField() multiple times.</p>

<h3>Using Expressions with a single table</h3>
<?Example?>One Table Example
class Model_ExpressionTest extends Model_Table {
public $table='movie';
	function init(){
    	parent::init();

    	$this->addField('name');
    	$this->addField('year');

    	$this->addExpression('age')->set('year(now())-year');

    	$this->addExpression('title')->set(function($m,$q){
    		return $q->expr('concat([f1]," (",[f2],")")')
    		->setCustom('f1',$m->getElement('name'))
    		->setCustom('f2',$m->getElement('age'))
    		;
    	});
   	}
}

$m=$this->add('Model_ExpressionTest');
$page->add('Grid')->setModel($m);
<?/?>

<p>Agile Toolkit will automatically determines type of your fields and uses them in a query:</p>
<font color="blue">select  `<font color="black">name</font>`,`<font color="black">year</font>`,year(now())-year `<font color="black">age</font>`,concat(`<font color="black">movie</font>`.`<font color="black">name</font>`," (",year(now())-year,")") `<font color="black">title</font>`,`<font color="black">id</font>` from `<font color="black">movie</font>`      </font>
</p>

<p>The next example uses a hasOne relation which indirectly creates a calculated field "movie". This field now is used instead of the "name" from previous example and although it does affect the query, the model definition code looks very consistent to what you had before.</p>


<h3>Using Expressions with related table</h3>
<?Example?>Multi Table Example
class Model_ExpressionTest2 extends Model_Table {
public $table='dvd';
	function init(){
    	parent::init();

    	$this->hasOne('ExpressionTest','movie_id');

    	$q=$this->join('movie');
    	$q->addField('year');

    	$this->addExpression('age')->set(
    		$this->dsql()->expr('year(now())-[f1]')
    			->setCustom('f1',$this->getElement('year'))
    		);

    	$this->addExpression('title')->set(function($m,$q){
    		return $q->expr('concat([f1]," (",[f2],")")')
    		->setCustom('f1',$m->getElement('movie'))
    		->setCustom('f2',$m->getElement('age'))
    		;
    	});
   	}
}

$m=$this->add('Model_ExpressionTest2');
$page->add('Grid')->setModel($m);
<?/?>

<p><font color="blue">select  (select  `<font color="black">movie</font>`.`<font color="black">name</font>` from `<font color="black">movie</font>`  where `<font color="black">dvd</font>`.`<font color="black">movie_id</font>` = `<font color="black">movie</font>`.`<font color="black">id</font>`    ) `<font color="black">movie</font>`,year(now())-`<font color="black">_m</font>`.`<font color="black">year</font>` `<font color="black">age</font>`,`<font color="black">_m</font>`.`<font color="black">year</font>`,concat((select  `<font color="black">movie</font>`.`<font color="black">name</font>` from `<font color="black">movie</font>`  where `<font color="black">dvd</font>`.`<font color="black">movie_id</font>` = `<font color="black">movie</font>`.`<font color="black">id</font>`    )," (",year(now())-`<font color="black">_m</font>`.`<font color="black">year</font>`,")") `<font color="black">title</font>`,`<font color="black">dvd</font>`.`<font color="black">id</font>`,`<font color="black">dvd</font>`.`<font color="black">movie_id</font>` `<font color="black">_m</font>` from `<font color="black">dvd</font>` inner join `<font color="black">movie</font>` as `<font color="black">_m</font>` on `<font color="black">_m</font>`.`<font color="black">id</font>` = `<font color="black">dvd</font>`.`<font color="black">movie_id</font>`     </font>
</p>

<p>One other note is that I had to add "join" with the movie table in order to be able to acquire the year of the movie. Expression field "title" have used a proper prefix to adress the age which is now defined in a related table and not the main table.</p>















<?$Content?>


</div>


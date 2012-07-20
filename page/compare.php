<?php
class page_compare extends Page {
	function init(){
		parent::init();

		$f=$this->add('Form',array('default_controller'=>'MyForm'));

		$f->setClass('stacked');

		$f->setModel('FrameworkComparison');

		
	}
	function defaultTemplate(){
		return array('page/compare');
	}
}

class Controller_MyForm extends Controller_MVCForm {
	function importField($field){
		$formfield=parent::importField($field);
		if(!$formfield)return $formfield;

        $field=$this->model->getElement($field);

		if($field->hint()){
			$formfield->setFieldHint($field->hint());
		}

		if($field->subtitle()){
			$formfield->owner->add('Order')
				->move($formfield->owner->add('H3')->set($field->subtitle()),'before',$field)
				->now();
		}

		if($field->intro()){
			$formfield->aboveField()->add('P')
			//$formfield->owner->add('Order')
				//->move($formfield->owner->add('HR'),'before',$field)
				//->move($formfield->owner->add('P')
					->set($field->intro())
					;
					//,'before',$field)
				//->now();
		}
		$formfield->owner->add('HR');

	}

}

class ComparisonField extends Field {
	public $hint=null;
	public $intro=null;
	public $subtitle=null;

	function hint($t=undefined){ return $this->setterGetter('hint',$t);}
	function intro($t=undefined){ return $this->setterGetter('intro',$t);}
	function subtitle($t=undefined){ return $this->setterGetter('subtitle',$t);}

}

class Model_FrameworkComparison extends Model_Table {
	public $table='framework_comparison';
	public $field_class='ComparisonField';
	function init(){
		parent::init();

		$this->addField('name')
			->caption('Name of compared framework');

		$this->addField('version')
			->caption('Major version number if applicable')
			->hint('Use only for major versions such as "1.x", "2.x"')
			;

		$this->addField('date')
			->caption('Date');

		$this->addField('language')
			->caption('Programming Language');

		$this->addField('innovation')
			->subtitle('Raw Feature Comparison')

			->intro('Every author of a framework follows one of the two paths. He is either implementing ideas he have "borrowed" in other frameworks or he is innovating his own path. Agile Toolkit has a unique architecture which is not used in any mainstream softawre. What about your framework? Does it bring something fresh and unique to the mix?')
			->caption('Can your framework be considered a "game-changer"?')
			->hint('Small and minor features do not count')
			->type('boolean')
			;

		$this->addField('self_sufficient')
			->intro('Some frameworks are dependant on other frameworks or PHP libraries, while other frameworks are self-sufficient and solve all of the generic problems themselves. If framework is not self-sufficient it must rely on API compatibility, release schedules, stability and security of the other code.')
			->caption('Is it common for your framework to be used stand-alone without mixing with other frameworks?')
			->hint('Only Server-Side software should be considered here')
			->type('boolean')
			;

		$this->addField('object_oriented')
			->intro('Object-oriented programming is based around concepts such as inheritance, polymorphism, modularity, encapsulation and abstraction. While some frameworks claim that they are Object-Oriented, they are not usign all of the concepts. Primarily they only rely on class inheritance and static methods. In other cases, frameworks use object-orientation but developers are not encouraged to produce object-oriented code.')
			->caption('Is your framework using Object-Orientation to the fulliest?')
			->hint('Ask yourself - is it typical that developer would build hierarchy out of controllers or models?')
			->type('boolean')
			;


		$this->addField('conceptual_age')
			->intro('Some frameworks have been around for longer. Often frameworks change names and change add new concepts. However the fundamentals of the framework come a long way through many years. How old are the foundation of your framework?')
			->caption('Age of the concept in years')
			->hint('If your framework copies other framework, then put the age of that other framework')
			;


		$this->addField('rewrite_age')
			->intro('Other frameworks have been used for years without major rewrite. Rewrite does not necessarily have to be full. Some part of the framework could be rewritten. Rewrites are good as they consider developer feedback and make things generally better at the expense of backward compatibility')
			->caption('When was the last major rewrite?')
			;

		$this->addField('sql_power')
			->intro('One of the most popular way to manage data is SQL database. SQL is a language which produces performance-efficient queries for necessary data. Some frameworks abstract and restrict developers from using efficient SQL queries.')
			->caption('Does your framework allow developer to use full power of joins, sub-selects and expressions?')
			->type('boolean')
			;

		$this->addField('model')
			->intro('Ability to address database through a model is great. Active Record can address records through native objects. Can your framework do that?')
			->caption('Support for active-record')
			->type('boolan')
			;

		$this->addField('ui_form')
			->intro('UI components in a framework can save developer a lot of time. Would your framework be able to display a form to a user based around the model fields?')
			->caption('Built-in Form Widget')
			->hint('If it is mandatory to write HTML or copy POST data into model, then do not tick this')
			->type('boolean')
			;

		$this->addField('ui_universality')
			->intro('Imagine you have just implemented a form on a page. Can you copy-and-paste your code to have two forms now?')
			->caption('Universal UI')
			->hint('If you would need to rename fields or worry about collision between forms, do not tick this')
			->type('boolean')
			;

		$this->addField('model_multitable')
			->intro('Often business data is stored in multiple tables. For example "user" and "contact_info" may be related tables. If your framework contains active-record implementaiton, can both tables be expressed by a single model? This way database design can be independent from the UI')
			->caption('Support for multi-table models')
			->type('boolean')
			;

		$this->addField('model_multitable_add_delete')
			->intro('If framework model support multiple tables, would creating new model entry populate both tables and link them with ID? What about deleting?')
			->caption('All c-r-u-d operations with multi-table model')
			->type('boolean')
			;

		$this->addField('model_conditions')
			->intro('If you are building a multi-user environment where all the data tables contain "user_id" field. User may only manage records which are labeled with his ID. Can this restriction be implemented on a model level in your framework?')
			->caption('Model support for conditions')
			->type('boolean')
			;

		$this->addField('model_traversal_conditions')
			->intro('If I have a model for "author". Can I traverse one-to-many relations? An example would be where I would get a "Book" model which would give me access only to the book of particular author')
			->caption('Model one-to-many traversal')
			->type('boolean')
			;


		$this->addField('query_builder_abstraction')
			->intro('If your framework contains query builder. To enhance functionality of query-builder developer extends the class. Can the extended version of a class be used instead througought some parts of your framework?')
			->caption('Query Builder Abstraction')
			->type('boolean')
			;

		$this->addField('add_ons')
			->intro('A third party developer is willing to build an add-on for your framework. Can I put his add-on into a certain folder and then start using it right away?')
			->caption('Easily installable add-ons')
			->type('boolean')
			;

		$this->addField('add_on_extensions')
			->intro('Can add-on implement "soft-delete" and "audit-log" on some of your model?')
			->caption('Addons for models')
			->hint('If soft-delete is a built-in feature and could not be added through add-on esaily, don\'t click this')
			->type('boolean')
			;

		$this->addField('add_on_theme')
			->caption('Can add-on contain a new theme(s) for your UI elements?')
			->hint('Add-on must be able to supply HTML and CSS to standard UI of your framework. Do not tick if your framework has no UI')
			->type('boolean')
			;

		$this->addField('add_on_field')
			->intro('A third party developer wishes to build a new field type for a standard form. Is that doable through add-on?')
			->caption('Form field add-ons')
			->type('boolean')
			;

		$this->addField('add_on_global')
			->intro('A third party developer wants to build "debug toolbar" addon. It would sit below a regular screen and provide some additional info for your application. Would that be possible without having any preparations from the framework?')
			->caption('Application add-on')
			->type('boolean')
			;

		$this->addField('add_on_auth')
			->intro('A third party developer wants to implement add-on which adds "security code" to your standard log-in form. Is that possible to implement without replacing any of the auth functionality?')
			->caption('Authentication add-ons')
			->type('boolean')
			;


		$this->addField('migration')
			->intro('Your applicaiton developed on top of the framework is being installed on 10 servers through versioning control system. Does framework offer a way how to distribute changes (migrations) without destructino of data?')
			->caption('Support for database migrations')
			->type('boolean')
			;

		$this->addField('simple_framework')
			->intro('When someone new to development considers if he should build web application from scratch or use your framework, would your framework be simpler and easier for him to use?')
			->caption('Simple Framework')
			->type('boolean')
			;

		$this->addField('nojs_application')
			->intro('Can a web application be built easily without any use of JavaScript?')
			->caption('no-javascript support')
			->type('boolean')
			;

		$this->addField('ajaxification')
			->intro('A developer have just finished his application which has very minimal JS use. He now wants to use AJAX to load page content when menu is clicked. Can framework facilitate that easily?')
			->caption('Ajaxification support')
			->type('boolean')
			;

		$this->addField('ajax_widget')
			->intro('A third party developer have created a widget which relies on some AJAX methods. Will this AJAX widget work anywhere in the applicaiton?')
			->caption('Universal AJAX')
			->hint('Do not tick if developer must know about the nature of the 3rd party add-on in order to make it working properly on a page')
			->type('boolean')
			;

		$this->addField('output_format')
			->intro('Assuming you have a page with a CRUD on it. You would like to turn on API which would produce result in other format (such as JSON) instead of HTML but would still offer same set of fields, records as the original CRUD. Is that possible in your framework?')
			->caption('Alternative output format')
			->type('boolean')
			;

		$this->addField('output_format_addon')
			->intro('Is it possible to add a new "action" to the API or introduce new output format through a simple add-on?')
			->caption('API addon')
			->hint('Do not tick if significant change to the application is necessary')
			->type('boolean')
			;

		$this->addField('dry_safe')
			->intro('Some framework will use code generation and even copy whole files to create CRUDs, which can be further modified by user thus violating Do not repeat yourself principle.')
			->caption('Is your framework DRY-safe?')
			->hint('Repetition of Language constructs is ok, but if blocks of statements is copied for user, then don\'t click')
			->type('boolean')
			;

		$this->addField('integration')
			->intro('Developer wishes to create command-line utility which can still use models, but wouldn\'t have any of the routing or any web-related functionality. Can framework facilitate that?')
			->caption('Support for command-line model use')
			->type('boolean')
			;

		$this->addField('integration_app')
			->intro('Existing software is built without use of a framework. Can your framework be integrated and can developer slowly start moving functionality onto your framework without breaking any existing code?')
			->caption('Migration to your framework')
			->type('boolean')
			;

		$this->addField('easy_upgrade')
			->intro('Two developers start working on identical projects. One of them is using previous version of your framework and other is using the most up-to-date version. After software is developed, the first developer notices that he have been using older version. He makes sure the applicaiton interface is compatible and upgrades framework to most recent version. Would both applications look exactly the same?')
			->caption('Framework clean upgrade')
			->hint('If your framework generates code, will it be able to "upgrade" all of the code it generated if necessary?')
			->type('boolean')
			;

		$this->addField('performance_sql')
			->intro('In pursuit to have minimal latency, developer tries to eliminate number of queries. He is not allowed to use cache. Will your framework permit developer to optimize and improve SQL queries?')
			->caption('SQL query optimization')
			->type('boolean')
			;

		$this->addField('performance_ui')
			->intro('The developer have found that your implementation of some component (ui component, logger, auth, routing) is ineffective. Can he globally substitute your implementaiton with his own? Will add-ons depending on replaced functionality continue to work un-changed and take advantage of new code?')
			->caption('Substitutions')
			->hint('Do not tick this if the only way to do this would be to replace actual classes inside a read-only framework distribution folder, which would be overwritten during upgrade')
			->type('boolean')
			;

		$this->addField('dev_and_designer')
			->intro('Your team consist of developer, but external designer is used. Will designer be able to deliver a skin for your framework which can then be used easily and consistently throughout interface by developer who has very little HTML skills?')
			->caption('HTML skinning')
			->type('boolean')
			;

		$this->addField('design_after')
			->intro('Your developer have finished work on the app. It is now necessary to change look and feel of the application. Will designer be able to change look and feel without going into business-logic my simply changing HTML templates?')
			->caption('Post-design')
			->type('boolean')
			;

		$this->addField('template_as_is')
			->intro('Designer have delivered a sample page HTML, which developer have to use. Developer integrates template into your framework. Now designer wants to do some more fixes to the template. Will he be able to find his HTML in a similar condition to how it was initially delivered?')
			->caption('Designer-friendly templates')
			->hint('Do not tick this if developer would typically distribute HTML across many small templates or would need to severely clean-up the HTML such as repetition of rows in a table')
			->type('boolean')
			;

		$this->addField('security_dev')
			->intro('Many developers have no understanding of data escaping and may never have heard about JS injection or cross-site scripting. When using your framework does your frameowrk employ some automated measures to protect application security even if developer is unaware?')
			->caption('Automatic security')
			->hint('Do not tick if developer must manually call encoding or verification functions on data')
			->type('boolean')
			;


	}

}
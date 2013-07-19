# Basic Form Example

Form is a fundamental component of any web application. Agile Toolkit greatly simplifies form creation.

#### Example2

    $form=$page->add('Form');
    $form->addField('line','name');
    $form->addField('line','surname');    
    $form->addSubmit();
 
    if($form->isSubmitted()){
      $form->js()->univ()->alert('Thank you, '.
        $form->get('name').' '.$form->get('surname'))->execute();
    }

#### Example2
This Fiels will allowed you type in e-mail only.

    $f=$page->add('Form');
    
    // email field
    $f->addField('line','email')
        ->validateNotNull()
        ->validateField('filter_var($this->get(), FILTER_VALIDATE_EMAIL)')
        ;

    // Submit handling    
    $f->addSubmit('Check email');
    if($f->isSubmitted()){
        $f->js()->univ()->alert('Email '.$f->get('email').' is valid')->execute();
    }
    
    // Application is safe from arbitary code injection, but validate input at will


#### Example3

    $f=$page->add('Form');
    
    // using multiple validations on a same field
    $f->addField('line','username')->validateNotNull()
        ->validateField('preg_match("/^[a-z]+$/",$this->get())')
        ->validateField('strlen($this->get())>=6','Too short')
        ->validateField('20>=strlen($this->get())','Too long');
    
    $f->addField('password','pasword')->validateNotNull();
    $f->addSubmit('Login');
    
    if($f->isSubmitted()){
        $f->js()->univ()->alert('[Demo] Login Successful')->execute();
    }


### Form Elements

There are many field types you can use with form. In addition you can add your own field types or use add-on which may provide additional types.

#### field types

    $form=$page->add('Form');
    $form->addComment('This form shows all sorts of fields you can use by default');
    $form->addField('line','line');
    $form->addField('password','password');
    $form->addField('checkbox','checkbox');
    $form->addField('dropdown','dropdown');
    $form->addField('checkboxlist','checkboxlist');
    $form->addField('radio','radio');
    $form->addField('DatePicker','date');
    $form->addField('text','text');
    
    $form->addSeparator();
    $form->addField('Slider','Slider');
    $form->addField('upload','upload');
    
    $form->addSeparator('Here are some variations in how you can use fields');
    $form->addField('Search','Search');
    $form->addSubmit();


### Use with Model

The most convenient way to use form is to have it's fields populated from a Model.

#### model 1

    //$form = $page->add('Form');
    //$form->setModel('Employee');
    //$form->addSubmit();









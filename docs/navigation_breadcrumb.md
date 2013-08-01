# Breadcrumb



#### Example 1

    $page->add('x_bread_crumb/View_BC',array(
        'routes' => array(
            0 => array(
                'name' => 'Home',
            ),
            1 => array(
                'name' => 'Job',
                'url' => 'url/to/job',
                'args' => array('var_one'=>'value_one','var_two'=>'value_two',),
            ),
            2 => array(
                'name' => 'Current',
                'url' => 'url/to/some/current/staff',
            ),
        )
    ));
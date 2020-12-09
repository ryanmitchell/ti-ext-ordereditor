<?php 

namespace Thoughtco\OrderEditor;

use Event;
use Admin\Models\Orders_model;
use Admin\Widgets\Form;
use Admin\Widgets\Toolbar;
use System\Classes\BaseExtension;

/**
 * Order Editor Extension Information File
**/
class Extension extends BaseExtension
{
    public function boot()
    {
        // extend fields on orders model
        Event::listen('admin.form.extendFieldsBefore', function (Form $form) {
            if ($form->model instanceof Orders_model) {
				$form->tabs['fields']['order_time']['disabled'] = FALSE;
				$form->tabs['fields']['order_date']['disabled'] = FALSE;
				
				$form->tabs['fields']['notes'] = [
        			'tab' => 'lang:thoughtco.ordereditor::default.notes',
        			'label' => 'lang:thoughtco.ordereditor::default.order_notes',
					'span' => 'left',
		            'type' => 'textarea',
				];
				
			    Event::listen('admin.toolbar.extendButtons', function (Toolbar $toolbar) {
					$toolbar->buttons['save']['context'][] = 'edit';
					$toolbar->buttons['saveClose']['context'][] = 'edit';
				});						
	        }
        });
    }
}

?>

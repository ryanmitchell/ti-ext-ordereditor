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

			    $form->tabs['fields']['order_time_is_asap'] = [
				    'tab' => 'lang:thoughtco.ordereditor::default.editor',
				    'label' => 'lang:admin::lang.orders.label_time_is_asap',
				    'type' => 'switch',
				    'on' => 'lang:admin::lang.text_yes',
				    'off' => 'lang:admin::lang.text_no',
				    'context' => ['edit', 'preview'],
			    ];

			    $form->tabs['fields']['order_time'] = [
        		    'tab' => 'lang:thoughtco.ordereditor::default.editor',
        		    'label' => 'lang:admin::lang.orders.label_order_time',
				    'type' => 'datepicker',
				    'mode' => 'time',
				    'span' => 'left',
			    ];

			    $form->tabs['fields']['order_date'] = [
        		    'tab' => 'lang:thoughtco.ordereditor::default.editor',
        		    'label' => 'lang:admin::lang.orders.label_order_date',
            	    'type' => 'datepicker',
				    'mode' => 'date',
				    'span' => 'right',
			    ];

			    $form->tabs['fields']['comment'] = [
        		    'tab' => 'lang:thoughtco.ordereditor::default.editor',
        		    'label' => 'lang:admin::lang.orders.label_comment',
				    'span' => 'left',
            	    'type' => 'textarea',
			    ];
				$form->tabs['fields']['notes'] = [
        			'tab' => 'lang:thoughtco.ordereditor::default.editor',
        			'label' => 'lang:thoughtco.ordereditor::default.order_notes',
					'span' => 'right',
		            'type' => 'textarea',
				];

			    Event::listen('admin.toolbar.extendButtonsBefore', function (Toolbar &$toolbar) {
                    if ($toolbar->getController() instanceof \Admin\Controllers\Orders) {
			            $toolbar->buttons['save']['context'][] = 'edit';
                    }
				});
	        }
        });
    }
}

?>

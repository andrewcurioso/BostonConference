<?php

/**
 * Content management helper - helps out with rich UI elements 
 *
 */
class ContentManagementHelper extends AppHelper {

/**
 * Additional helpers
 *
 * @var array
 */
	public $helpers = array( 'Form', 'Js' );

/**
 * Initialization javascript for rich text editor.
 *
 * @var string
 */
	protected $_richextInitjs = 'new wysihtml5.Editor("%s", { toolbar: "%s", parserRules: wysihtml5ParserRules });';

/**
 * Create a rich text edit field.
 * Note, that currently this requires the full field name (wuth model) to be used in the view.
 *
 * @param string $fieldName The name of the field to output a rich text editor for
 * @param array $options Additional options will be passed to FormHelper::input
 * @returns Rich text editor HTML
 */
	public function richtext($fieldName,$options=array()) {

		$this->setEntity($fieldName,false);
		$id = $this->domId();

		$this->Form->Html->script('BostonConference.wysihtml5-rules',array('inline' => false));
		$this->Form->Html->script('BostonConference.wysihtml5-0.3.0.min',array('inline' => false));

		$toolbar = <<<EOMARKUP
<div id="$id-toobar" class="wysiwyg-toolbar">
  <a data-wysihtml5-command="bold">bold</a>
  <a data-wysihtml5-command="italic">italic</a>
  <a data-wysihtml5-action="change_view" class="html-view">html</a>
</div>
EOMARKUP;

		$defaultOptions = array(
			'type' => 'textarea',
			'between' => $toolbar
		);

		$options = array_merge($defaultOptions,$options);

		$init = $this->Form->Html->scriptBlock(sprintf($this->_richextInitjs,$id,$id.'-toobar'),array('inline' => true));

		return $this->Form->input($fieldName,$options).$init;
	}

}

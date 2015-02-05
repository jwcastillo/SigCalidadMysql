<?php

App::uses('AppHelper', 'View/Helper');

/**
 * Charisma helper
 *
 * @package       app.View.Helper
 */

class CharismaHelper extends AppHelper {

	public $helpers = array('Html', 'Form');

	public static $inputDefaults = array(
		'label' => array ('class' => 'control-label'), 
		'div' => 'control-group', 'class' => 'input-xlarge', 
		'between' => '<div class="controls">', 
		'after' => '</div>',
		'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')), 
		'format' => array('label', 'before', 'between', 'input', 'error', 'after') 
	);

	public static $dateOptions = array('type' => 'text', 'class' => 'datepicker');

	public static $selectOptions = array('class' => 'chosen-select');

	public static $spinnerOptions = array('class' => 'spinner');

	public static $textAreaOptions = array('type' => 'textarea', 'class' => 'autogrow');

	public function getInputDefaults() { return self::$inputDefaults; }

	public function getDateOptions() { return self::$dateOptions; }

	public function getSelectOptions() { return self::$selectOptions; }

	public function getSpinnerOptions() { return self::$spinnerOptions; }

	public function getTextAreaOptions() { return self::$textAreaOptions; }

	public function __construct(View $view, $settings = array()) {
		parent::__construct($view, $settings);
	}

	public function iconLink($text = '', $link = '/', $icon = 'icon-star', $class = '', $attributes = array()) {

		$span = (!empty($text)) ? $this->Html->tag('span', '&nbsp;' . $text, array('class' => $class)) : '';

		return $this->Html->link(
			$this->Html->tag('i', '', array('class' => $icon)) .  $span, 
			$link, array_merge(array('escape' => false), $attributes)
		);
	}

	public function spanLink($text = '', $link = '/', $spanClass = '', $options = array()) {

		return $this->Html->link(  
			$this->Html->tag('span', $text, array('class' => $spanClass)), 
			$link, array_merge($options, array('escape' => false))
		);
	}

	public function iconButton($text = '', $link = '/', $icon = 'icon-star', $class = 'btn btn-info') {

		return $this->Html->link(
			$this->Html->tag('li', '', array('class' => "$icon icon-white")) . '&nbsp;' . $text, 
			$link, 
			array('class' => $class, 'escape' => false)
		);
	}

	public function button($text = '', $type = 'button', $class = 'btn btn-primary') {
		
		return $this->Form->button($text, 
			array('class' => $class, 'div' => false, 'type' => $type)
		);
	}
	
	public function deleteLink($text = '', $link = array(), $icon = 'icon-trash icon-white', $class = '') {
		
		return $this->Form->postLink(
			$this->Html->tag('i', '', array('class' => $icon)) .  
			'&nbsp;' . $text, 
			$link, 
			array (
				'confirm' => __('Are you sure you want to delete # %s?', end($link)), 
				'class' => $class,
				'escape' => false
			)
		);
	}

	public function deleteButton($text = '', $link = array(), $icon = 'icon-trash icon-white', $class = '', $span_class = '') {
		
		return $this->deleteLink(
			$this->Html->tag('span', '&nbsp;' . $text, array('class' => $span_class)), 
			$link, 
			$icon, 
			$class
		);
	}

/**
 * Get a list of controllers in the app and plugins.
 *
 * Returns an array of path => import notation.
 *
 * @param string $plugin Name of plugin to get controllers for
 * @return array
 **/
	private function getControllerList($plugin = null) {
		if (!$plugin) {
			$controllers = App::objects('Controller', null, false);
		} else {
			$controllers = App::objects($plugin . '.Controller', null, false);
		}
		return $controllers;
	}

/**
 * Return a Title Text given a Camel Case String
 *
 * @param string $camelStr String in Camel Case
 * @return array
 **/
	public function camelToTitle($camelStr) {
		$intermediate = preg_replace(
			'/(?!^)([[:upper:]][[:lower:]]+)/',
			' $0', $camelStr);
		$titleStr = preg_replace(
			'/(?!^)([[:lower:]])([[:upper:]])/',
			'$1 $2', $intermediate);
		 
		return $titleStr;
	}

/**
 * Get a list of controllers and links to them
 *
 * Returns an array with controlller names as labels and links as values
 *
 * @return array
 **/
	public function controllerLinks() {
		$controllers = $this->getControllerList(false);
		$data = array();
		foreach ($controllers as $key => $value) {
			$target = str_replace('Controller', '', $value);
			$data[$key]['label'] = __($this->camelToTitle($target));
			$data[$key]['value'] = Router::url(array('plugin' => false, 'controller' => $target), true);
		}
		return $data;
	}

	public function monthNames($n = null, $length = 0) {

		$m = array(
			 1 => __('January'),
			 2 => __('February'),
			 3 => __('March'),
			 4 => __('April'),
			 5 => __('May'),
			 6 => __('June'),
			 7 => __('July'),
			 8 => __('August'),
			 9 => __('September'),
			10 => __('October'),
			11 => __('November'),
			12 => __('December')
		);

		$pos = intval($n);

		if ($pos > 0)
			return $m[$pos];
		elseif ($length != 0)
			return array_map(function($item) use($length) { return substr($item, 0, $length); }, $m);
		else
			return $m;
	}

	public function daysNames($n = null, $length = 0) {

		$m = array(
			 1 => __('Sunday'),
			 2 => __('Monday'),
			 3 => __('Tuesday'),
			 4 => __('Wednesday'),
			 5 => __('Thursday'),
			 6 => __('Friday'),
			 7 => __('Saturday'),
		);

		$pos = intval($n);

		if ($pos > 0)
			return $m[$n];
		elseif ($length != 0)
			return array_map(function($item) use($length) { return substr($item, 0, $length); }, $m);
		else
			return $m;
	}

	public function getInputDefaultsLabel($text, $class = 'control-label') {
		return array_merge( $this->getInputDefaults(), 
			array( 'label' => array('text'=> $text, 'class' => $class) ) );
	}

	public function getSelectOptionsLabel($text, $class = 'control-label') {
		return array_merge( $this->getSelectOptions(), 
			array( 'label' => array('text'=> $text, 'class' => $class) ) );
	}

	public function getDateOptionsLabel($text, $class = 'control-label') {
		return array_merge( $this->getDateOptions(), 
			array( 'label' => array('text'=> $text, 'class' => $class) ) );
	}

	public function greaterEqual($firstDate, $secondDate) {
		return $this->deleteMinutes($firstDate) >= $this->deleteMinutes($secondDate);
	}

	public function lowerEqual($firstDate, $secondDate) {
		return $this->deleteMinutes($firstDate) <= $this->deleteMinutes($secondDate);
	}

	public function deleteMinutes($date){

		return date("Y-m-d", strtotime($date));

	}

}
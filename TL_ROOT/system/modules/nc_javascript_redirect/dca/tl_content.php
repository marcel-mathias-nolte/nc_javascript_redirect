<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package   NC Javascript Redirect
 * @author    Marcel Mathias Nolte
 * @copyright Marcel Mathias Nolte 2013
 * @website	  https://www.noltecomputer.com
 * @license   <marcel.nolte@noltecomputer.de> wrote this file. As long as you retain this notice you
 *            can do whatever you want with this stuff. If we meet some day, and you think this stuff 
 *            is worth it, you can buy me a beer in return. Meanwhile you can provide a link to my
 *            homepage, if you want, or send me a postcard. Be creative! Marcel Mathias Nolte
 */


/**
 * Table tl_content
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['nc_js_redirect'] = '{type_legend},type,headline;{js_redirect_legend},js_redirect_timeout,js_redirect_jump_to;{text_legend},text;{image_legend},addImage;{protected_legend:hide},protected;{expert_legend:hide},guests,invisible,cssID,space';
$GLOBALS['TL_DCA']['tl_content']['fields']['js_redirect_jump_to'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['js_redirect_jump_to'],
	'inputType'               => 'pageTree',
	'eval'                    => array('fieldType' => 'radio'),
	'sql'                     => 'int(10) unsigned NOT NULL default \'0\''
);
$GLOBALS['TL_DCA']['tl_content']['fields']['js_redirect_timeout'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['js_redirect_timeout'],
	'exclude'                 => true,
	'inputType'               => 'inputUnit',
	'options'                 => array('s', 'ms'),
	'eval'                    => array('rgxp'=>'digit'),
	'sql'                     => 'varchar(255) NOT NULL default \'\''
);
?>
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
 * Run in a custom namespace, so the class can be replaced
 */
namespace NC;

/**
 * Class ContentNcJavascriptRedirect
 *
 * Front end content element "Javascript redirect".
 */
class ContentNcJavascriptRedirect extends ContentElement
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'ce_javascript_redirect';


	/**
	 * Prepare the content element
	 * @return string
	 */
	public function generate() 
	{
		if(TL_MODE == 'BE') 
		{
			$t = new BackendTemplate('be_wildcard');
			$t->wildcard = '### REDIRECT ###';
			return($t->parse());
		}
		
		return(parent::generate());
	}

	/**
	 * Generate the content element
	 */
	protected function compile()
	{
		global $objPage;
		$this->import('String');

		// Clean the RTE output
		if ($objPage->outputFormat == 'xhtml')
		{
			$this->text = $this->String->toXhtml($this->text);
		}
		else
		{
			$this->text = $this->String->toHtml5($this->text);
		}
		
		$objNextPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id = ?")->limit(1)->execute($this->js_redirect_jump_to);
		$target = $objNextPage->numRows ? $this->generateFrontendUrl($objNextPage->fetchAssoc()) : '';

		$this->Template->text = $this->String->encodeEmail($this->text);
		$this->js_redirect_timeout = deserialize($this->js_redirect_timeout);
		$this->Template->timeout = $this->js_redirect_timeout['unit'] == 'ms' ? (int)$this->js_redirect_timeout['value'] : (int)$this->js_redirect_timeout['value'] * 1000;
		$this->Template->addImage = false;
		$this->Template->href = $target;

		// Add image
		if ($this->addImage && $this->singleSRC != '' && is_file(TL_ROOT . '/' . $this->singleSRC))
		{
			$this->addImageToTemplate($this->Template, $this->arrData);
		}
	}
}

?>
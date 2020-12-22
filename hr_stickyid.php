<?php
/**
 * @package    HR_StickyID
 *
 * @author     HR-IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2017 - 2021 HR-IT-Solutions GmbH
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Joomla! System plugin to turn anything sticky. Adapted from https://github.com/garand/sticky
 *
 * @since  Version 1.0.0.0
 */
class PlgSystemHR_StickyID extends CMSPlugin
{
	protected $app;

	/**
	 * onBeforeCompileHead
	 *
	 * @since  Version 1.0.0.0
	 *
	 * @return void
	 */
	public function onBeforeCompileHead()
	{
        // Frontend
        if ($this->app->isClient('site'))
        {
			if (!empty($this->params->get('stickyid')))
			{
                HTMLHelper::_('script',
					'plg_hr_stickyid/jquery.sticky.js',
					array('version' => 'auto', 'relative' => true)
				);

				Factory::getDocument()->addScriptDeclaration(
					$this->stickyScript(
						$this->params->get('stickyid')
					)
				);
			}
		}
	}

	/**
	 * stickyScript
	 *
	 * @param   string  $id  the id to sticky
	 *
	 * @return string
	 */
	private function stickyScript($id)
	{
		$id = trim($id, '#');

		return <<<SCRIPT
(function($) {
    $(function()
    {
        $("#$id").sticky({ topSpacing: 0 });
    });
})(jQuery);
SCRIPT;
	}
}

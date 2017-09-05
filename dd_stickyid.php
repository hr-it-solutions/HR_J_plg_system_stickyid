<?php
/**
 * @package    DD_StickyID
 *
 * @author     HR IT-Solutions Florian Häusler <info@hr-it-solutions.com>
 * @copyright  Copyright (C) 2017 - 2017 Didldu e.K. | HR IT-Solutions
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 **/

defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');
jimport('joomla.access.access');

/**
 * Joomla! system plugin to disable jQuery from the front end!
 *
 * @since  Version 1.0.0.0
 */
class PlgSystemDD_StickyID extends JPlugin
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
		// Front end
		if ($this->app instanceof JApplicationSite)
		{
			if (!empty($this->params->get('stickyid')))
			{
				JHTML::_('script',
					'plg_dd_stickyid/jquery.sticky.js',
					array('version' => 'auto', 'relative' => true)
				);

				JFactory::getDocument()->addScriptDeclaration(
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

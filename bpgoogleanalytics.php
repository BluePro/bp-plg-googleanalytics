<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin');

class plgSystemBPGoogleAnalytics extends JPlugin {

	function onAfterInitialise() {
		$tracker = $this->params->get('tracker');
		$domain = $this->params->get('domain');
		$app = JFactory::getApplication();
		$document = JFactory::getDocument();
		
		if (!$tracker || $app->isAdmin() || strpos($_SERVER['PHP_SELF'], 'index.php') === false) return true;
		
		$js = "var _gaq = _gaq || []; _gaq.push(['_setAccount', '$tracker']);";
		if ($domain) {
			$js .= " _gaq.push(['_setDomainName', '$domain']);";
		}
		$js .= " _gaq.push(['_trackPageview']);\n";
$js .= "(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
";
		$document->addScriptDeclaration($js);
	}
}

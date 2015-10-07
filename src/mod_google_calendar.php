<?php defined('_JEXEC') or die;

try
{
	// Require the module helper file
	require_once __DIR__ . '/helper.php';

	// Get a new ModGCalendarHelper instance
	$helper = new ModGoogleCalendarHelper($params);

	// Setup joomla cache
	$cache = JFactory::getCache();
	$cache->setCaching(true);
	$cache->setLifeTime($params->get('api_cache_time', 60));

	// Get the next events
	$events = $cache->call(
		array($helper, 'nextEvents'),
		(int) $params->get('max_list_events', 5)
	);

	// Get the Layout
	require JModuleHelper::getLayoutPath('mod_google_calendar', $params->get('layout', 'default'));
}
catch(Exception $e)
{
	JFactory::getApplication()->enqueueMessage(
		'Google Calendar error: ' . $e->getMessage(), 'error'
	);
}

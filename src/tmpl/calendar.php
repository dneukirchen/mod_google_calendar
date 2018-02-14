<?php defined('_JEXEC') or die;

// Load the FullCalendar assets
$document = JFactory::getDocument();
$langTag  = JFactory::getLanguage()->getTag();
$shortTag = strtolower(substr($langTag, 0, -3));

// Get the appropriate locale file for the current language
$localesPath = JUri::root() . '/modules/mod_google_calendar/media/fullcalendar/lang/en.js';
if (is_file(JPATH_ROOT . '/modules/mod_google_calendar/media/fullcalendar/lang/' . $shortTag . '.js'))
{
	$localesPath = JUri::root() . '/modules/mod_google_calendar/media/fullcalendar/lang/' . $shortTag . '.js';
}
$document->addStyleSheet(JUri::root() . '/modules/mod_google_calendar/media/fullcalendar/fullcalendar.min.css');
$document->addScript(JUri::root() . '/modules/mod_google_calendar/media/fullcalendar/lib/moment.min.js');
$document->addScript(JUri::root() . '/modules/mod_google_calendar/media/fullcalendar/fullcalendar.min.js');
$document->addScript($localesPath);
$document->addScript(JUri::root() . '/modules/mod_google_calendar/media/fullcalendar/gcal.js');
?>
<script>
  jQuery(document).ready(function ($) {
    jQuery('#calendar-<?php echo $module->id; ?>').fullCalendar({
      googleCalendarApiKey: '<?php echo $params->get('api_key', null); ?>',
      events: {
        googleCalendarId: '<?php echo $params->get('calendar_id', null); ?>'
      },
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      timeFormat: 'H:mm',
      eventClick: function (event) {
        window.open(event.url, 'gcalevent', 'width=700,height=600');
        return false;
      },
      loading: function (bool) {
        $('#loading').toggle(bool);
      }
    });
  });
</script>
<div id="calendar-<?php echo $module->id; ?>"></div>

<?php

/**
 * FullcalendarWidget виджет расписания
 *
 * @category YupeWidget
 * @package  yupe.modules.quizcalc.widgets
 *
 */

Yii::import('application.modules.masterclass.models.*');

class FullcalendarWidget extends yupe\widgets\YWidget
{
     public $options = [
        'class' => 'fullcalendar'
    ];
	
	public $id;
	
	public $themeUrl;

	public $theme='default';
    
	public $moduleName='masterclass';
    
	public $locale='ru';
	
	public $scriptUrl;
	
	public $scriptFile=[ 'js/main.min.js', 'js/locales/ru.js' ];
	
	public $cssFile=[ 'css/main.min.css' ];
	
	public $clientOptions 	= [];
		
	public $events 			= [];
	
	public $businessHours  	= [];
	
	public $defaultDate;
	
    
	/**
    * FullCalendar offers the following packages:
     * interaction, dayGrid, timeGrid, list, timeline, resourceDayGrid, resourceTimeGrid, resourceTimeline, bootstrap, googleCalendar
     * rrule, luxon, moment, momentTimezone
     * @var array header format
     */
    public $plugins = [
        'interaction', 'dayGrid', 'timeGrid'
    ];
	
    /**
     * @var string defaultView will define which view renderer will initially be used for displaying calendar events 
     */
    public $defaultView 	= 'dayGridMonth';

	/**
     * Define the look n feel for the calendar header, known placeholders are left, center, right
     * @var array header format
     */
    public $header = [
        'center' => 'title',
        'left' => 'prev, next today',  
        'right' => 'dayGridMonth, timeGridWeek, timeGridDay',
    ];

    
    /**
     * Will hold an url to json formatted events!
     * @var url to json service
     */
    public $ajaxEvents = NULL;
    
    /**
     * wheather the events will be "sticky" on pagination or not. Uncomment if you are loading events
	 * separately from the initial options.
     * @var boolean
     */
    //public $stickyEvents = true;

    /**
     * tell the calendar, if you like to render google calendar events within the view
     * @var boolean
     */
    public $googleCalendar	= false;

    /**
     * the text that will be displayed on changing the pages
     * @var string
     */
    public $loading 		= 'Загрузка ...';

    /**
     * The javascript function to us as en eventRender callback
     * @var string the javascript code that implements the eventRender function
     */
    public $eventRender 	= "";

    /**
     * The javascript function to us as en eventAfterRender callback
     * @var string the javascript code that implements the eventAfterRender function
     */
    public $eventAfterRender = "";

    /**
     * The javascript function to us as en eventAfterAllRender callback
     * @var string the javascript code that implements the eventAfterAllRender function
     */
    public $eventAfterAllRender = "";

    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        //checks for the element id
        if (empty($this->id)) {
            $this->options['id'] = $this->getId();
        }
		else{
			$this->options['id'] = $this->id;
		}
		
        //checks for the class
        if (!isset($this->options['class'])) {
            $this->options['class'] = 'fullcalendar';
        }
		
        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {   
	    $boot='';
        if (!isset($this->options['class'])) {
            $this->options['class'] = 'fullcalendar';
        }
        
        echo CHtml::openTag('div', $this->options) . "\n";
			
        echo CHtml::closeTag('div')."\n";
		
		$this->registerPlugin($boot);
	}
	
    protected function registerPlugin($boot)
    { 
		
        $id = !empty($this->id) ? $this->id : $this->options['id'];
		
		$this->resolvePackagePath();
		$this->registerCoreScripts();
		
/*        if(is_array($this->plugins) && isset($this->clientOptions['plugins'])){
            $this->clientOptions['plugins'] = array_merge($this->plugins, $this->clientOptions['plugins']);
        } 
		else {
            $this->clientOptions['plugins'] = $this->plugins;
        }*/
        
        if(is_array($this->header) && isset($this->clientOptions['header'])){
            $this->clientOptions['header'] = array_merge($this->header, $this->clientOptions['header']);
        } 
		else {
            $this->clientOptions['header'] = $this->header;
        }
		
		if (isset($this->defaultDate)){
			$this->clientOptions['defaultDate'] = $this->defaultDate;	
		}
		else{
			$this->clientOptions['defaultDate'] = date('Y-m-d');
		}
        
		if (isset($this->locale)){
			$this->clientOptions['locale'] = $this->locale;	
		}
		else{
			$this->clientOptions['locale'] = 'ru';
		}		
		
/*		if (isset($this->slotDuration)){
			$this->clientOptions['slotDuration'] = $this->slotDuration;	
		}
		else{
			$this->clientOptions['slotDuration'] = '01:00';
		}*/
		
		if (isset($this->defaultView)){
			$this->clientOptions['defaultView'] = $this->defaultView;	
		}
		else{
			$this->clientOptions['defaultView'] = 'agendaWeek';
		}
		
		if(is_array($this->events) && isset($this->clientOptions['events'])){
            $this->clientOptions['events'] = array_merge($this->events, $this->clientOptions['events']);
        } 
		else {
            $this->clientOptions['events'] = $this->events;
        }
		
		$clientAllOptions = $this->getClientOptions();
		
		$js = 
        "$(document).ready(function() {
            var calendarEvents = document.getElementById('$id');
            var calendar = new FullCalendar.Calendar(calendarEvents, $clientAllOptions);
            calendar.render();
        });";
 
		Yii::app()->getClientScript()->registerScript($id, $js, CClientScript::POS_READY);
		
    }
	
	protected function resolvePackagePath(){
		if($this->scriptUrl===null || $this->themeUrl===null){
			$basePath=Yii::getPathOfAlias('application.modules.' . $this->moduleName . '.views.assets');
			$baseUrl=Yii::app()->getAssetManager()->publish($basePath);
			if($this->scriptUrl===null)
				$this->scriptUrl=$baseUrl.'';
			if($this->themeUrl===null)
				$this->themeUrl=$baseUrl.'';
		}
	}
	
	protected function registerCoreScripts(){
		$cs=Yii::app()->getClientScript();
		if(is_string($this->cssFile))
			$this->registerCssFile($this->cssFile);
		else if(is_array($this->cssFile)){
			foreach($this->cssFile as $cssFile)
				$this->registerCssFile($cssFile);
		}

		$cs->registerCoreScript('jquery');
		if(is_string($this->scriptFile))
			$this->registerScriptFile($this->scriptFile);
		else if(is_array($this->scriptFile)){
			foreach($this->scriptFile as $scriptFile)
				$this->registerScriptFile($scriptFile);
		}
	}
	
	protected function registerScriptFile($fileName,$position=CClientScript::POS_HEAD){
		Yii::app()->clientScript->registerScriptFile($this->scriptUrl.'/'.$fileName,$position);
	}
	protected function registerCssFile($fileName){
		Yii::app()->clientScript->registerCssFile($this->themeUrl.'/'.$fileName);
	}
	
	
	protected function getClientOptions()
    { 
		$options = $this->clientOptions;
		return CJavaScript::encode($options);
    }
}

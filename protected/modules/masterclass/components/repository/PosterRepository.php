<?php

/**
 * Class PosterRepository
 */
class PosterRepository extends CApplicationComponent
{
        
	public function getPoster(){
        
        $posterEvents = [];
            
		$criteria=new CDbCriteria;
		$criteria->condition = 'status = :public';
		$criteria->params = [':public' => Masterclass::STATUS_PUBLIC];
		$criteria->order = 'date DESC, position ASC';
        
        $poster = Masterclass::model()->findAll($criteria);
        
        if(!empty($poster)){
            foreach($poster as $key => $event){
                $name = "<span class='fc-event-main__name hidden-xs'>{$event->name_short}</span><span class='fc-event-main__park hidden-xs'>Парк: {$event->park->name_short}</span>";
                $posterEvents[] = [
                    'id' => $event->id,
                    'title' => $event->name_short,
                    'extendedProps' => [
                        'description' => $name
                    ],
                    'url' => Yii::app()->createAbsoluteUrl('/masterclass/masterclass/view', ['slug' => $event->slug]),
                    'start' => Yii::app()->dateFormatter->format('yyyy-MM-dd', $event->date),
                    'end' => Yii::app()->dateFormatter->format('yyyy-MM-dd', $event->date),
                    'backgroundColor' => '#F55790',
                    'borderColor' => '#F55790',
                    'color' => '#ffffff',
                    'textColor'	=> '#ffffff',
                    'className'	=> 'reserve-date',
                    'allDayDefault' => true,
                ];
            }
        }
        
        return $posterEvents;
    }
    
    public function getPosterByDate($date = 'now()'){
            
		$criteria=new CDbCriteria;
		$criteria->condition = 'date = :date AND status = :public';
		$criteria->params = [ ':date' => $date,  ':public' => Masterclass::STATUS_PUBLIC ];
		$criteria->order = 'date DESC, position ASC';
        $poster = Masterclass::model()->findAll($criteria);
        return $poster;
    }
	
}

<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Modal;
$this->title = 'Calendar';

if(Yii::$app->user->identity->roleid==app\models\Role::ROLE_USER){
    $test = app\models\Crmlog::find()->where(['accountid' => Yii::$app->user->identity->accountid])->all();
}else {
    $test = app\models\Crmlog::find()->all();
}


   $events = array();
  //Testing

  foreach($test as $t){
        $Event = new \yii2fullcalendar\models\Event();
     // var_dump($t->crmlogid);exit;
  $Event->id = $t->crmlogid;
  if($t->status==0){
       $Event->backgroundColor='blue';
  }else {
       $Event->backgroundColor='green';
 
  }
  $Event->title = $t->rvperson->lastname.' '.$t->description;
  $Event->start = $t->fromdate;
	  $Event->end = $t->todate;
  //$Event->end=date('Y-m-d H:i:s');
  $events[] = $Event;
  }
 
 
 /* $Event = new \yii2fullcalendar\models\Event();
  $Event->id = 2;
  $Event->title = 'Testing';
  $Event->start = date('Y-m-d\Th:m:s\Z',strtotime('tomorrow 6am'));
  $events[] = $Event;*/
 
  ?>
 
  <?= \yii2fullcalendar\yii2fullcalendar::widget(array(
      'events'=> $events,
      
  )); 
    
    
    ?>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head> 
<script>
/*$(document).ready(function() {
		
		$('#fullcalendar fc fc-ltr fc-unthemed').fullCalendar({
			
			//defaultDate: '2016-06-12',
			selectable: true,
			selectHelper: true,
			/*select: function(start, end) {
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#calendar').fullCalendar('unselect');
			},
			editable: true,
			//eventLimit: true, // allow "more" link when too many events
			
		});
		
	});
*/
</script>   

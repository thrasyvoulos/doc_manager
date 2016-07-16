
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
//use yii2fullcalendar\yii2fullcalendar;
$this->title = 'Calendar';

if(Yii::$app->user->identity->roleid==app\models\Role::ROLE_USER){
    $test = app\models\Crmlog::find()->where(['accountid' => Yii::$app->user->identity->accountid])->all();
}else {
    $test = app\models\Crmlog::find()->all();
}


   /*$events = array();

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
	 // $Event->end = $t->todate;
  //$Event->end=date('Y-m-d H:i:s');
    $events[] = $Event;
  }
 
 
  */?>
 
  <?php
   yii2fullcalendar\yii2fullcalendar::widget(array(
      //'events'=> $events,
      'options'=>[
          'editable'=>true,
          	'selectable'=> true,
				'selectHelper'=> true,
      ]
      
      
  )); 
    
    
   ?>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


</head>
  <div id='calendar'></div>
<script type='text/javascript'>
 
$(document).ready(function() {

$('#calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
  },
  editable: true,
  events: [
 
<?php
  foreach ($test as $event) {
    $title = $event->rvperson->lastname.' '.$event->description;
    $date = $event->fromdate;
    $id=$event->crmlogid;
    echo "{";
    echo "id: '" . $id .   "',";
    echo "title: '" . $title .   "',";
    echo "start: '" . $date .   "',";
    echo "allDay: false,";
    echo "url: '" . Url::to(['crmlog/update', 'id' => $id]). "'";
    echo "},";
  
  }
?>
 
]
});
});

</script>
 
<style type='text/css'>
#calendar {
  width: 900px;
  margin: 0 auto;
}
</style>
 

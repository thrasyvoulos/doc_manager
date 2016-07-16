<?php  
use yii\helpers\Html;
use yii\widgets\DetailView;

$doctor = app\models\Profile::find()->where(['accountid' => $id])->one();

 ?>
 <div class="panel panel-info">
  
         <div style="margin-top: 10px;margin-right: 10px;display: inline-block;">
             
                 <h2>
                     <?php  if($doctor->logo){
                        echo Html::img('@web/'.$doctor->logo);   
                    }?>
                     <?php echo Yii::t('app', 'Στοιχεία Ιατρού');
                ?>
                 </h2>
                <?= DetailView::widget([
                'model' => $doctor,
                'attributes' => [
                 
                    'firstname',
                    'lastname',
                    [
                        'attribute'=>'specialtiesid',
                        'value'=>$doctor->specialties->description,
                        'header'=>Yii::t('app','Specialty')
                    ],
                    [
                        'attribute'=>'cityid',
                        'value'=>$doctor->city->cityname,
                        'header'=>Yii::t('app','City')
                    ],
                    'address',
                    'email:email',
                    'mobilephone',
                    'telephone'
                    
                

                ],
            ]) ?>
          
             </div>
     
         
         </div>



 <div class="panel panel-info">
         <div style="margin-top: 10px;margin-right: 10px">
          
                 <h2><?= Html::img('@web/images/details.png');?><?php echo Yii::t('app', 'Στοιχεία Ασθενή');
                ?>
                 </h2>
                 
             </div>
             <?= DetailView::widget([
                'model' => $model2,
                'attributes' => [
                 
                    'firstname',
                    'lastname',
                    [
                        'attribute'=>'cityid',
                        'value'=>$model2->city->cityname,
                        'header'=>Yii::t('app','City')
                    ],
                    'address',
                    'email:email',
                    
                

                ],
            ]) ?>
               
                
         </div>
  

<hr align="left" width="50%">
<?php $data=explode(' ',$model->fromdate); 
       $date=$data[0];
       $time=$data[1];
?>
<h3 style="text-align: center">  <u><?php echo 'έχετε ραντεβού:'.'<br>' ?></u></h3>
<h3 style="text-align: center"><u> <?php  echo $date.' '.'στις: '.$time.'<br>'?></u> </h3>   

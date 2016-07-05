<?php   $doctor = app\models\Profile::find()->where(['accountid' => $id])->one();
 ?>
<h2 style="text-align: center">  <?php echo $doctor->firstname.' '.$doctor->lastname.' '. $doctor->specialties->description ?> </h2>

<br>
<br>

<h3 style="text-align: center"> <?php echo $model2->firstname.' '.$model2->lastname.'<br>' ?></h3>
<hr align="left" width="50%">
<?php $data=explode(' ',$model->fromdate); 
       $date=$data[0];
       $time=$data[1];
?>
<h3 style="text-align: center">  <u><?php echo 'έχετε ραντεβού:'.'<br>' ?></u></h3>
<h3 style="text-align: center"><u> <?php  echo $date.' '.'στις: '.$time.'<br>'?></u> </h3>   
<hr align="left" width="50%">


<?php echo $doctor->address.'<br>' ?>

<?php echo $doctor->zipcode.' '.$doctor->city->cityname.'<br>' ?>
<?php echo Yii::t('app', 'Telephone').':'.$doctor->telephone.'<br>' ?>
<?php echo Yii::t('app', 'Mobile phone').':'.$doctor->mobilephone.'<br>'  ?>
<?php

$this->pageTitle=Yii::app()->name . ' - See patient submission status';
$this->breadcrumbs=array(
	'Submission status',
);

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(            
            'first'=>'First Name',
            //call the method 'gridUniqueProductName' of the controller
            //the params extracted to the method are $data (=the current rowdata) and $row (the row index)
            'value'=>'Ron'//array($this,'gridPatientName')
        ),
        array(            
            'last'=>'Last Name',
            'value'=>'Weasly'//array($this,'gridPatientDescription')
        ),
 
        'category', //display the category as a default column
    ),
));

?>
<body>
    
<head>
<style>
table, th, td
{
border-collapse:collapse;
border:0px solid black;
}
th, td
{
padding:15px;
}
</style>
</head>




<h2>Home</h2>

<form name="addNewPatient" method="get" action="add">
    <input type="submit" name="addNewPatient" value="Add New Patient"/>
</form>

<br />
<h4>Recent Submissions</h4>

<table style="width:300px">
<tr>
  <td>Jill</td>
  <td>Smith</td>		
  <td>50</td>
  </tr>
<tr>
  <td>Eve</td>
  <td>Jackson</td>		
  <td>94</td>
</tr>
<tr>
  <td>John</td>
  <td>Doe</td>		
  <td>80</td>
</tr>

</body>
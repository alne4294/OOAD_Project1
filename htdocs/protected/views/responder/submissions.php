<?php

$this->pageTitle=Yii::app()->name . ' - See patient submission status';
$this->breadcrumbs=array(
	'Submission status',
);
?>

<h2>Home</h2>

<form name="addNewPatient" method="get" action="add">
    <input type="submit" name="addNewPatient" value="Add New Patient"/>
</form>

<br />
<h4>Recent Submissions</h4>

<head>
<style>
table, th, td
{
border-collapse:collapse;
border:1px solid black;
}
th, td
{
padding:15px;
}
</style>
</head>

<body>

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
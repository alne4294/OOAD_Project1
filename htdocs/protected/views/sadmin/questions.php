<?php

$this->pageTitle=Yii::app()->name . ' - Answer Medical Questions About Patient';
$this->breadcrumbs=array(
	'Manage Questions',
);
?>

<style type="text/css">

    li {
        list-style: none;
    }
    
    ul {
        margin: 0px 0px 0px 20px;
    }
    
</style>
    
<h1>Manage Medical Questions</h1>

<form method="post" action=""> <!-- Page posts to self -->
    <?php echo $questionTreeHtml; ?>
    <br />
    Add new top level question: <input type="text" name="newTopLevelName" value="" />
    <br />
    <br />
    <input type="submit" value="Save" /> <a href="">Reload without saving again</a>
</form>








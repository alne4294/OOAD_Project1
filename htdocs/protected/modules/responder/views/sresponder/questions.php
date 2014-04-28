<?php

$this->pageTitle=Yii::app()->name . ' - Answer Medical Questions About Patient';
$this->breadcrumbs=array(
	'Record Questions for Patient',
);
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.3/jquery.min.js"></script>

<script type="text/javascript">

    $(function() {
        
        // BOOTSTRAP
    
        $("#questions #start, #add-patient, #upload-photo").show();
  
        // EVENT HANDLERS
        
        $('#select-patient').change(function () {
             var optionSelected = $(this).find("option:selected");
             var valueSelected  = optionSelected.val();
             // var textSelected   = optionSelected.text();
             
             // $("#questions a").hide();
             
             getQuestionMarkedYesForPatient(valueSelected);
        });
 
        $("#questions a").bind("click", function() {
            
            var anchorClickedOn = $(this);
            
            var questionId = anchorClickedOn.attr("id");
                        
            if(questionId != 'start') {
            
 		$.ajax({
                    type: "POST", 
                    url: 'http://snap.colorado.edu/index.php/responder/Sresponder/record',
                    data: {
                        'action': 'MARK-YES',
                        'patientId': 4,
                        'questionId': questionId
                    },
                    cache: false,
                    async: false,
                    success: function(response){
                       
                        if(response == 'INSERT-SUCCESSFUL') {
                            
                           anchorClickedOn.addClass('yes');
                           
                        }
                        
                    }
		}); 
                
            }
            $(this).parent("li").find("ul:first").children("li").children("a").show();
        });

    });

    function getQuestionMarkedYesForPatient(patientId) {
        $.ajax({ type: "GET", 
            url: 'http://snap.colorado.edu/index.php/responder/Sresponder/getyes',
            data: {
                'patientId': patientId
            },
            cache: false,
            async: false,
            dataType: 'json',
            success: function(questionsMarkedYes){
                                
                $.each(questionsMarkedYes, function(i, item) {
                    var questionId = item.question_id;
                    $("#" + questionId).show();
                    // $("#" + questionId).parent("li").find("a").show();
                    // $("#start")
                    $("#" + questionId).addClass("yes");
                });
                
            }
        }); 
    } 

</script>

<style type="text/css">

    #questions li {
        list-style: none;
        margin: 8px 0 !important;
    }
    
    #questions ul {
        margin: 8px 0px !important;
    }
    
    #questions a {
        color: black;
        border: 1px solid #666666;
        padding: 2px 6px;
        background-color: #dfdfdf;
        text-decoration: none;
        font-weight: bold;
        display: none;
    }
    
    #questions a:hover {
        color: white;
        background-color: #666666;
    }
    
    a.yes{
        color: white !important;
        background-color: red !important;
    }
    
</style>
    
<h1>Record Questions for Patient</h1>

<div id="questions">
    
    <select id="select-patient">
        <option> -- Select Patient -- </option>

        <?php
            
            $patientModel = new Spatient;

            $patients = $patientModel->getPatients();
        
            foreach($patients as $patient) {
                
                $id = $patient['id'];
                $first = $patient['first'];
                $last = $patient['last'];
                
                echo "<option value=\"$id\">$first $last</option>\n";

            }
            print_r($patients);
            
        ?>
        
    </select>
        
    <a id="add-patient">Add Patient</a>

    <hr />

    <ul>
        <li>
            <a id="start">Answer Questions</a> <a id="upload-photo">Upload Photo</a>
            <?php echo $questionTreeHtml; ?>
        </li>
    </ul>
</div>

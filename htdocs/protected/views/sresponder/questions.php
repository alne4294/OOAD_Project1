<?php

$this->pageTitle=Yii::app()->name . ' - Answer Medical Questions About Patient';
$this->breadcrumbs=array(
	'Record Questions for Patient',
);
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.3/jquery.min.js"></script>

<script type="text/javascript">

    $(function() {
        
        getQuestionMarkedYesForPatient(4);
    
        $("#questions #start").show();
        
        $("#questions a").bind("click", function() {
            
            var anchorClickedOn = $(this);
            
            var questionId = anchorClickedOn.attr("id");
                        
            if(questionId != 'start') {
            
 		$.ajax({ type: "POST", 
                    url: 'http://snap.colorado.edu/index.php/Sresponder/record',
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
            url: 'http://snap.colorado.edu/index.php/Sresponder/getyes',
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
        margin: 8px 0;
    }
    
    #questions ul {
        margin: 8px 0px 8px 4px;
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
    <ul>
        <li>
            <a id="start">Start Recording</a>
            <?php echo $questionTreeHtml; ?>
        </li>
    </ul>
</div>

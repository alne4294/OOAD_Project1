<?php

$this->pageTitle=Yii::app()->name . ' - Answer Medical Questions About Patient';
$this->breadcrumbs=array(
	'Record Questions for Patient',
);
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.2.3/jquery.min.js"></script>

<script type="text/javascript">

    var patientId = null;

    $(function() {
        
        // BOOTSTRAP
    
        $("#add-patient").show();
        $("#image-upload").hide();
  
        // EVENT HANDLERS
        
        $('#select-patient').change(function () {
             var optionSelected = $(this).find("option:selected");
             patientId = optionSelected.val();
             // var textSelected = optionSelected.text();
             
             $("input[name='patientId']").val(patientId);
             
             $("#questions a").hide(); // HIde all so no "left overs" from previous patient show.
             $("#questions a").removeClass("yes") // also unmark all so can mark just for current patient.
             
             if(patientId != 'select') {
                 $("#start").show(); // This should always show
                 $("#image-upload").show();
             } else {
                 $("#image-upload").hide();
             }
             
             getQuestionMarkedYesForPatient(patientId);
        });
 
        $("#questions a").bind("click", function() {
            
            var anchorClickedOn = $(this);
            
            var questionId = anchorClickedOn.attr("id");
                        
            if(questionId != 'start') {
            
 		$.ajax({
                    type: "POST", 
                    url: '/index.php/responder/Sresponder/record',
                    data: {
                        'action': 'MARK-YES',
                        'patientId': patientId,
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
            url: '/index.php/responder/Sresponder/getyes',
            data: {
                'patientId': patientId
            },
            cache: false,
            async: false,
            dataType: 'json',
            success: function(questionsMarkedYes) {
                                
                $.each(questionsMarkedYes, function(i, item) {
                    
                    var questionId = item.question_id;
                    
                    //$("#" + questionId).parent("li").find("a").show();

                    // $("#" + questionId).show();
                    $("#start, #" + questionId).parent("li").children("a").show();
                     $("#start, #" + questionId).parent("li").children("ul").children("li").children("a").show();
                    $("#" + questionId).addClass("yes");
                    // $("#start") 
                    
               });
                
            }
        }); 
    } 

</script>

<style type="text/css">

    #patientManagement li {
        list-style: none;
        margin: 8px 0 !important;
    }
    
    #patientManagement ul {
        margin: 8px 0px !important;
    }
    
    #patientManagement a {
        color: black;
        border: 1px solid #666666;
        padding: 2px 6px;
        background-color: #dfdfdf;
        text-decoration: none;
        font-weight: bold;
        display: none;
    }
    
    #patientManagement a:hover {
        color: white;
        background-color: #666666;
    }
    
    a.yes {
        color: white !important;
        background-color: red !important;
    }
    
    #start, #upload-photo {
        display: none;
    }
    
</style>
    
<h1>Record Questions for Patient</h1>

<div id="patientManagement">
    
    <select id="select-patient">
        <option value="select"> -- Select Patient -- </option>

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

    <a id="add-patient" href="/index.php/responder/default/create/">Add Patient</a>
    
    <hr />
    
    <div id="image-upload">
        
    <form action="/index.php/responder/sresponder/uploadphoto" method="post" enctype="multipart/form-data">
        <input type="hidden" name="patientId" value="" />
        <input type="file" accept="image/*" capture="camera" name="file" id="file">
        <input type="submit" name="submit" value="Upload Photo">
    </form>
    
    <hr />

    </div>
    
    <div id="questions">

        <ul>
            <li>
                <a id="start">Answer Questions</a> <a id="upload-photo">Upload Photo</a>
                <?php echo $questionTreeHtml; ?>
            </li>
        </ul>
    </div>
</div>
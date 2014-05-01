<?php
/* @var $this PatientController */
/* @var $data Patient */
?>

<div class="image">
    
    <br>
    <h1>Patient ID# <?php echo $patientId; ?></h1>
   
    <img width="400" 
        src="/images/patient_photos/<?php echo $patientId; ?>.jpg"
        onError="this.onerror=null;this.width=70;this.src='/images/no-available-image.png';">

</div>
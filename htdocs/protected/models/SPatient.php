<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class Spatient
{
	public function __construct() {

        }
        
        public function add($params) {
            
            $command = Yii::app()->db->createCommand();
            
            $command->insert('patient', array(
                'first'=> $params['first'],
                'last'=> $params['last'],
            ));
    
            return true; // Should figure out if insert was successful and only return true if varified as successful.
        }
        
        public function markQuestionYesForPatient($patientId, $questionId) {
            
            $command = Yii::app()->db->createCommand();
            
            $status = $command->insert('patient_question', array(
                'patient_id'=> $patientId,
                'question_id'=> $questionId,
                'answered_by'=> '1', // PLACEHOLDER, REPLACE WITH REAL VALUE LATER.
                'answer'=> 1, // PLACEHOLDER, REPLACE WITH REAL VALUE LATER.
                'deleted'=> '1', // PLACEHOLDER, REPLACE WITH REAL VALUE LATER.
                'deleted_by'=> '2', // PLACEHOLDER, REPLACE WITH REAL VALUE LATER.
                'deleted_datetime'=> '2014-04-25 00:00:00' // PLACEHOLDER, REPLACE WITH REAL VALUE LATER.
            ));
            
            if($status == 1) {
                $statusMessage = 'INSERT-SUCCESSFUL';
            } else {
                $statusMessage = 'INSERT-NOT-SUCCESSFUL';
            }
            
            return $statusMessage; // Should figure out if insert was successful and only return true if varified as successful.
            
        }
        
        public function getAnsweredYesQuestionsForPatient($patientId) {
            
            // questions with no parents are top level parents
            
            $patientId = (isset($patientId) && is_numeric($patientId)) ? $patientId :  '""';

            $sql = "
                select
                    question_id
                from 
                    patient_question
                where  
                    patient_id = $patientId
            ";

            $connection=Yii::app()->db; 
            $command = $connection->createCommand($sql);
            $dataReader = $command->query();
            $questions = $dataReader->readAll();

            return $questions;
            
        }
        
        public function getPatients() {
            
            $sql = "
                select
                    id,
                    first,
                    last
                from 
                    patient
            ";

            $connection=Yii::app()->db; 
            $command = $connection->createCommand($sql);
            $dataReader = $command->query();
            $patients = $dataReader->readAll();

            return $patients;
            
        }
        
}
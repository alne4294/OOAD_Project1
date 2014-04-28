<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class Squestion
{
	public function __construct() {

        }
        
        public function addTopLevel($name) {
         
            $command = Yii::app()->db->createCommand();
            
            $command->insert('question', array(
                'name'=> $name, // Name is the text of the question.
            ));
            
            return true; // Should figure out if insert was successful and only return true if varified as successful.            
        }
        
        public function addQuestion($parent, $name) {
            // If $parent does not exist or is null, then we add question to top of tree.
            
            $command = Yii::app()->db->createCommand();
            
            $command->insert('question', array(
                'parent'=> $parent,
                'name'=> $name, // Name is the text of the question.
            ));
            
            return true; // Should figure out if insert was successful and only return true if varified as successful.
            
        }

        public function updateQuestion($id, $name) {
            // If $parent does not exist or is null, then we add question to top of tree.
            
            $command = Yii::app()->db->createCommand();

            $command->update('question', array(
                'name' => $name
            ), 'id=:id', array(':id'=>$id));

            return true; // Should figure out if insert was successful and only return true if varified as successful.
            
        }
        
        public function deleteQuestion($id) {
            
            $command = Yii::app()->db->createCommand();
            $command->delete('question', 'id=:id', array(':id'=>$id));

            return true;
        }
        
        public function buildQuestionTree($visitor) {
            // Implements the Visitor Design Pattern where the vistor object passed in has a method called processTreeNode, which wraps question node in html defined by visitor object.

            $questionTreeHtml = $this->processQuestion($visitor, null);

            return $questionTreeHtml;
        }
        
        private function processQuestion($visitor, $parentQuestionId) {

            // The method should NOT need modification.  Only modify the visitor object class.

            $questionsHtml = '';
            
            $questions = $this->getQuestionRecordsForParent($parentQuestionId);

            for($i=0; $i<count($questions); $i++) {
                if($i == 0) { // first queston, go in.
                    $questionsHtml .= $visitor->getStartGroupHtml($questions[$i]);
                }
                $questionsHtml .= $visitor->getStartHTml($questions[$i]);
                $questionsHtml .= $this->processQuestion($visitor, $questions[$i]['id']); // Recursive call
                $questionsHtml .= $visitor->getEndHTml($questions[$i]);
                if($i+1 == count($questions)) { // last question, come out.
                    $questionsHtml .= $visitor->getEndGroupHtml($questions[$i]);
                    return $questionsHtml; // BASE CASE returning empty string when there ARE questions. 
                }                
            }

            return $questionsHtml;  // BASE CASE returning empty string when there are NO questions returned.
        }
        
        private function getQuestionRecordsForParent($parent) {
            
            // questions with no parents are top level parents
            
            $nullParentSql = (!isset($parent) || $parent == '') ? 'is NULL' :  "= $parent";
            
            $sql = "
                select
                    id,
                    name
                from 
                    question
                where  
                    parent $nullParentSql
            ";
            
            $connection=Yii::app()->db; 
            $command = $connection->createCommand($sql);
            $dataReader = $command->query(); // gets an array of arrays (will need foreach loop to go though) $rows=$dataReader->readAll(); // Get all the results into an array.
            $questions = $dataReader->readAll();
            
            return $questions;
        }
        
    }

?>

<?php

    $formData = ZRequest::getPost();
    $rowId = ZRequest::getParam('handler_id'); 
    $form = ZFormHandler::getForm('trash',$rowId);
    $rowModel = ZFactory::createModel('zform_handler');

    if (isset($formData['zformhandler_trash_submit'])) {
        //delete row
        $res = 0;
        if ($rowId >0) {
            $res = $rowModel->delete(array('id = ?'=>$rowId));
        }
        include('list.inc.php');
    } else {
        //initial view of form
        if ($rowId >0) {
            $row = $rowModel->find($rowId);
            if (!empty($row)) {
                //fill the form and show it
                $dataRow = $row[0]; //collection/array of objects
                $data = $dataRow->toArray(); //convert objects to arrays. using naming scheme.
                $form->populate($data);
                echo "<h2>Trash Form Handler</h2>";
                echo $form;
            } else {
                include('list.inc.php');
            }
        } else {
            //not much to edit if we don't have the rowId
            include('list.inc.php');
        }
    }
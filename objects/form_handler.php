<?php
    include_once '../config/database.php';
    include_once 'form.php';
    // instantiate database
    $database = new Database();
    $db = $database->getConnection();
    // pass connection to objects
    $reason = $_POST['y'];
    $form = new Form($db);

    if ($reason == 'load') {
        if ($stmt = $form->retrieve()) {
            $return_arr = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $text = $row['text'];   
                array_push($return_arr, array( // places rows in array with keys and values
                  'Text' => $text));
            }
        }
        echo json_encode($return_arr);
    }

    if ($reason == 'save') {
        $text = $_POST['text'];
        // Post values
        $form->text = $text;
        if ($stmt = $form->update()) {
            $result['message'] = "Text saved successfully!";
        } else {
            $result['message'] = "Failed to save Text";
        }
        // Return result as json
        echo json_encode($result);
    }
?>
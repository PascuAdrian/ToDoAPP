<?php

require_once 'db.php';
$db = new Database();

if(isset($_POST['action'])&& $_POST['action'] =="view"){
    $output = '' ;
    $data = $db->read();
    if($db->totalRowCount()>0){
        $output .='<table class="table table-striped table-sm table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Category</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($data as $row){
            $output .= '<tr class="text-center text-secondary">
            <td>'.$row['id'].'</td>
            <td>'.$row['category'].'</td>
            <td>'.$row['title'].'</td>
            <td>'.$row['status'].'</td>
            <td>' .date("Y-m-d").'</br>'.date("h:i:sa").'</td>
            <td>' .date("Y-m-d").'</br>'.date("h:i:sa").'</td>
            <td>
            <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal" 
            data-target="#editToDo" id="'.$row['id'].'">
                <i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;
            
            <a href="#" title="Delete" class="text-danger delBtn" id="'.$row['id'].'">
                <i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;
            </td></tr>';

        }
        $output .='</tbody></table>';
        echo $output;
    }
    else{
        echo '<h3 class="text-center text-secondary mt-5">:( No any todo
        present in the database!</h3>';
    }
}

if(isset($_POST['action']) && $_POST['action']=="insert"){
    $category = $_POST['category'];
    $title = $_POST['title'];
    $status = $_POST['status'];

    $db->insert($category,$title, $status);
}


if(isset($_POST['edit_id'])){
    $id = $_POST['edit_id'];
    
    $row = $db->getUserByID($id);
    echo json_encode($row);
}

if(isset($_POST['action']) && $_POST['action'] =="update"){
    $id = $_POST['id'];
    $category = $_POST['category'];
    $title = $_POST['title'];
    $status = $_POST['status'];

    $db->update($id, $category, $title, $status);
}

if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];

    $db->delete($id);
}
?>
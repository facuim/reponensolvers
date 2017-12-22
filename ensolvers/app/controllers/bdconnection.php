<?php
function conectarBD(){
    return (DB::connection('mysql'));
}
function saveTask($title,$dueDate,$description,$done,$idUser){
    $conn = conectarBD();
    $sql = "INSERT INTO tasks(title, dueDate, description, done, idUser)"
                    . "VALUES(?,?,?,?,?);";
    $conn->insert($sql, array($title, $dueDate, $description, $done, $idUser));
}
function markTaskAsDeleted($id){
    $conn = conectarBD();
    $sql = "UPDATE tasks set deleted = 1 where id = ?";
    $conn->update($sql, array($id));

}
function updateTask($id,$title,$dueDate,$description,$done){
    $conn = conectarBD();
    $sql = "UPDATE tasks set title = ? , dueDate = ? ,"
                       . " description = ? , done = ? "
                        . "where id =  ?";
    $conn->update($sql, array($title,$dueDate,$description,$done,$id));
}
Class Task extends Eloquent{
    protected $table = 'tasks';
}
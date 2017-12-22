<?php

require('bdconnection.php');

Class UserController extends BaseController {

    function isLogged() {
        session_start();
        return (isset($_SESSION['username']) && (isset($_SESSION['idUser'])));
    }

    function renderLogin() {
        if ($this->isLogged()) {
            $idUser = $_SESSION['idUser'];
            $username = $_SESSION['username'];
            $tasks = Task::where('idUser', '=', $idUser)
                    ->where('deleted', '=', "0")
                    ->orderBy('dueDate', 'desc')
                    ->paginate(6);
            return View::make('UserController.taskslist', array('tasks' => $tasks, 'username' => $username));
        } else {
            return View::make('UserController.login', array());
        }
    }

    function renderTasksList() {
        if ($this->isLogged()) {
            $idUser = $_SESSION['idUser'];
            $username = $_SESSION['username'];
            $tasks = Task::where('idUser', '=', $idUser)
                    ->where('deleted', '=', "0")
                    ->orderBy('dueDate', 'asc')
                    ->paginate(6);
            return View::make('UserController.taskslist', array('tasks' => $tasks, 'username'=>$username));
        } else {
            return View::make('UserController.login', array());
        }
    }

    function getRules() {
        return array(
            'title' => 'required|min:3|max:120',
            'date' => 'date_format:Y-m-d|required|after:today',
            'description' => 'required|min:3|max:500',
            'done' => 'required|boolean');
    }

    function addNewTask() {
        if ($this->isLogged()) {
            $validator = Validator::make(Input::all(), $this->getRules());
            if ($validator->passes()) {
                $title = $_POST['title'];
                $dueDate = $_POST['date'];
                $description = $_POST['description'];
                $done = $_POST['done'];
                $idUser=$_SESSION['idUser'];
                saveTask($title, $dueDate, $description, $done, $idUser);
                return json_encode(['valid' => true]);
            } else {
                return array('valid' => false, 'errors' => $validator->errors());
            }
        } else {
            return View::make('UserController.login', array());
        }
    }

    function updateTask() {
        if ($this->isLogged()) {
            $validator = Validator::make(Input::all(), $this->getRules());
            $id = $_POST['id'];
            $task = DB::table('tasks')->where('id', $id)->first();
            $idUser = $_SESSION['idUser'];
            if ($task->idUser == $idUser) { //VEO QUE EL REGISTRO QUE QUIERO MODIFICAR ME PERTENECE
                if ($validator->passes()) {
                    $title = $_POST['title']; $dueDate = $_POST['date'];
                    $description = $_POST['description']; $done = $_POST['done'];
                    updateTask($id, $title, $dueDate, $description, $done);
                    return array('valid' => true, 'tarea' => $task);
                } else {
                    return array('valid' => false, 'tarea' => $task, 'errors' => $validator->errors());
                }
            } else {
                return array('valid' => false);
            }
        } else {
            return View::make('UserController.login', array());
        }
    }

    function deleteTask() {
        if ($this->isLogged()) {
            $id = $_POST['id'];
            $task = DB::table('tasks')->where('id', $id)->first();
            $idUser = $_SESSION['idUser'];
            if ($task->idUser == $idUser) { //VEO QUE EL REGISTRO QUE QUIERO BORRAR ME PERTENECE
                markTaskAsDeleted($id);
                return array('valid' => true, 'tarea' => $task);
            } else {
                return array('valid' => false, 'tarea' => $task);
            }
        } else {
            return View::make('UserController.login', array());
        }
    }

    function logMeIn() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = DB::table('users')->where('username', $username)->first();
        if ($user == null) {
            return array('valid' => false, 'error' => 'Username or password incorrect');
        } else {
            if (password_verify($password, $user->password)) {
                session_start();
                $_SESSION['username'] = $user->username;
                $_SESSION['idUser'] = $user->id;
                return array('valid' => true);
            } else {
                return array('valid' => false, 'error' => 'Password incorrect');
            }
        }
    }

    function logOut() {
        session_start();
        session_destroy();
        return View::make('UserController.login', array());
    }

}

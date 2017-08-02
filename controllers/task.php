<?php
namespace App;

class Task
{
    public function create()
    {
        unset($_SESSION['error']);
        unset($_SESSION['success']);
        $connect = new \Task();
        $user = new \Auth();
        $errors = \Validate::is_ValidTask();
        if (isset($_GET['val'])) {
            $name = $_GET['val'];
            echo $connect->getEmail($name);
            exit;
        }
        if (isset($_POST['create'])) {
            if (!empty($_FILES['pic']['tmp_name'])) {
                if ($_FILES['pic']['type'] != 'image/jpeg' && $_FILES['pic']['type'] != 'image/png' && $_FILES['pic']['type'] != 'image/gif') {
                    $errors[] = 'Неверный формат изображения';
                }
            }

            if (empty($errors)) {
                $userName = $user->checkNameExists($_POST['name']);
                $user_id = $user->getUserByName($userName)->id;

                if ($userName) {
                    $connect->createTask($user_id, $_POST['text']);
                    $task_id = $connect->getLastTask()->task_id;
                    $connect->setImage($task_id);
                    $_SESSION['success'] = 'Success';
                    header('Refresh:.5; url= /');
                } else {
                    $_SESSION['error'] = 'Такого пользователя не существует';
                }
            } else {
                $_SESSION['error'] = array_shift($errors);
            }
        }

        $_SESSION['auth'] = \Auth::getSession();
        \View::render('task/create', $data = [
            'title' => 'Создание задачи',
            'uri' => 'task_create',
            'POST'=>$_POST,
            'session' => $_SESSION['auth'],
            'error' => $_SESSION['error'],
            'success' => $_SESSION['success']
        ]);
    }

    public function edit()
    {
        unset($_SESSION['error']);
        unset($_SESSION['success']);
        $connect = new \Task();
        $errors = \Validate::is_ValidTask();
        if (isset($_GET['edit'])) {
            $id = (int)$_GET['edit'];
            $task = $connect->getTaskById($id);
        }
        if (isset($_POST['edit'])) {
            if (!empty($_FILES['pic']['tmp_name'])) {
                if ($_FILES['pic']['type'] != 'image/jpeg' && $_FILES['pic']['type'] != 'image/png' && $_FILES['pic']['type'] != 'image/gif') {
                    $errors[] = 'Неверный формат изображения';
                }
            }

            if (empty($errors)) {
                $userName = \Auth::checkNameExists($_POST['name']);
                $user_id = \Auth::getUserByName($userName)->id;
                if ($userName) {
                    $connect->updateTask($task->task_id, $_POST['text'], $user_id, $_POST['status']);
                    $connect->setImage($task->task_id);
                    $task = $connect->getTaskById($task->task_id);
                    $_SESSION['success'] = 'Success';
                    header('Refresh:.5; url= /');
                } else {
                    $_SESSION['error'] = 'Такого пользователя не существует';
                }
            } else {
                $_SESSION['error'] = array_shift($errors);
            }
        }

        $_SESSION['auth'] = \Auth::getSession();
        \View::render('task/edit', $data = [
            'title' => 'Редактирование',
            'task' => $task,
            'POST'=>$_POST,
            'session' => $_SESSION['auth'],
            'error' => $_SESSION['error'],
            'success' => $_SESSION['success']
        ]);
    }
}
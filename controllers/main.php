<?php
namespace App;

class Main
{
    public function index()
    {
        $connect = new \Task();
        $perpage = 3;

        //общее колво товаров
        $count_tasks = $connect->getCountTasks();

        //кол-во страниц
        $count_pages = ceil($count_tasks / $perpage);
        if (!$count_pages) $count_pages = 1;

        // получение запршенной страницы
        if(isset($_GET['page'])){
            $page = (int)$_GET['page'];
            if($page<1) $page = 1;
        } else {
            $page = 1;
        }

        if($page>$count_pages) $page = $count_pages;

        // начальная позиция для запроса
        $start_pos = ($page-1)*$perpage;

        if (isset($_GET['do']) && $_GET['do'] == 'status') {
            $tasks = $connect->getTasksBy('status','DESC',$start_pos,$perpage);
            $active_link = 'status';

        } elseif (isset($_GET['do']) && $_GET['do'] == 'email') {
            $tasks = $connect->getTasksBy('email','ASC',$start_pos,$perpage);
            $active_link = 'email';

        } elseif (isset($_GET['do']) && $_GET['do'] == 'name') {
            $tasks = $connect->getTasksBy('name','ASC',$start_pos,$perpage);
            $active_link = 'name';

        } else {
            $tasks = $connect->getTasksBy('task_id','ASC',$start_pos,$perpage);
            $active_link = 'main';
        }

        if (isset($_GET['delete'])) {
            $id = (int)$_GET['delete'];
            $connect->deleteTask($id);
            $tasks = $connect->getTasksBy('task_id','ASC',$start_pos,$perpage);
            header('Location: /');
        }

        $_SESSION['auth'] = \Auth::getSession();

        \View::render('main/index', $data = [
            'tasks' => $tasks,
            'title' => 'Главная',
            'uri' => 'main',
            'count_pages'=>(int)$count_pages,
            's_uri' => $active_link,
            'session' => $_SESSION['auth'],
            'page'=>$page
        ]);
    }
}

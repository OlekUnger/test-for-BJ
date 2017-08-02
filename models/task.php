<?php

class Task extends \Illuminate\Database\Eloquent\Model
{
    public $timestamps = false;
    protected $table = 'tasks';
    protected $guarded = ['task_id'];

    public function user()
    {
        return $this->belongsTo('User');
    }

    // задачи по параметру
    public static function getTasksBy($param,$desc_asc,$start_pos,$perpage)
    {
        return self::rightJoin('users', 'tasks.user_id', '=', 'users.id')
            ->where('text', '!=', '')
            ->orderBy($param, $desc_asc)
            ->skip($start_pos)->take($perpage)
            ->get()->toArray();
    }

    //кол-во задач
    public function getCountTasks()
    {
        return self::where('text', '!=', '')->count();
    }

    // создание задачи
    public function createTask($user_id, $text)
    {
        $task = new self;
        $task->user_id = $user_id;
        $task->text = $text;
        if (empty($_FILES['pic']['tmp_name'])) {
            $task->image = 'thumbnail.jpg';
        }
        $task->save();
    }

    // предпросмотр
    public function getEmail($name)
    {
        $email = \Auth::getUserByName($name)->email;

        if ($email == false) {
            $res = array('answer' => 'no');
            return json_encode($res);
        } else {
            $res = array('answer' => 'yes', 'email' => $email);
            return json_encode($res);

        }
    }

    // получение задачи по id
    public function getTaskById($id)
    {
        return self::rightJoin('users', 'tasks.user_id', '=', 'users.id')
            ->where('tasks.task_id', '=', $id)
            ->first();
    }

    // получение последней добавленной задачи
    public function getLastTask()
    {
        return self::orderBy('task_id', 'DESC')->first();
    }

    //обновление задачи
    public function updateTask($task_id, $text, $user_id, $status)
    {
        return self::rightJoin('users', 'tasks.user_id', '=', 'users.id')
            ->select('user_id', 'text', 'status')
            ->where('task_id', '=', $task_id)
            ->update(['text' => $text, 'user_id' => $user_id, 'status' => $status]);
    }

    //обновление картинки
    public function setImage($task_id)
    {
        $filename = 'thumbnail.jpg';
        if (!empty($_FILES['pic']['tmp_name'])) {
            if ($_FILES['pic']['type'] == 'image/jpeg') {
                $filename = $task_id . '.jpg';
            } elseif ($_FILES['pic']['type'] == 'image/gif') {
                $filename = $task_id . '.gif';
            } elseif ($_FILES['pic']['type'] == 'image/png') {
                $filename = $task_id . '.png';
            }
            move_uploaded_file($_FILES['pic']['tmp_name'], 'template/pics/' . $filename);
            self::where('task_id', '=', $task_id)->update(['image' => $filename]);
            \IntImage::image('template/pics/' . $filename, 'template/pics/' . $filename, 320, 240);
        } else {
            return false;
        }
    }

    // удаление задачи
    public function deleteTask($task_id)
    {
        $image = self::getTaskById($task_id)->image;
        if ($image != 'thumbnail.jpg') {
            $path = "template/pics/$image";
            if (file_exists($path)) {
                unlink($path);
            }
        }
        return self::where('task_id', '=', $task_id)->delete();
    }
}

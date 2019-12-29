<?php

class Model_Board extends Model
{
    public function get_data()
    {
        $data['title']= "Задачи";
        $data['content']= "Список задач";
        $posts = DB::run("SELECT * FROM message")->fetchAll();

        for($i = 0; $i < 3; $i++)
        {

            $data['posts']= $data['posts']."<tr>
         <td>".$posts[$i]['id']."</td> 
         <td>".$posts[$i]['name']."</td>
         <td>".$posts[$i]['email']."</td> 
         <td>".$posts[$i]['message']."</td> 
         <td class=\"text-center\"><a class='btn btn-info btn-xs' href=\"#\"><span class=\"glyphicon glyphicon-edit\"></span>Редактировать</a> <a href=\"#\" class=\"btn btn-danger btn-xs\"><span class=\"glyphicon glyphicon-remove\"></span> Закрыть</a></td></tr>";
        }

        return $data;
    }
    public function add_data()
    {
        if (isset($_POST['username'])) {
            $name=htmlspecialchars($_POST['username']);
            $email=htmlspecialchars($_POST['email']);
            $message=htmlspecialchars($_POST['textquest']);
            $stmt = DB::prepare("INSERT INTO message VALUES (NULL, ?,?,?)");
            $data = array($name,$email,$message);
            $stmt->execute($data);
            echo "Готово! Аякс что то добавил в БД";
        } else
        {
            echo "Не заполнено поле Имя";
        }


    }
}

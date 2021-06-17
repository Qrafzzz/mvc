<?php
    class tasks_model extends db
    {

        public function add_task($user_id, $task_text)
        {
            $date = date('Y-m-d G:i');
            $add_tasklist = "INSERT INTO `tasks`(`user_id`, `description`, `created_at`, `status`)
                VALUES (:user_id,:task_text,:date,'0')";
            $tasklist_query = $this->pdo->prepare($add_tasklist);
            $tasklist_query->bindParam(':user_id', $user_id);
            $tasklist_query->bindParam(':task_text', htmlspecialchars($task_text, ENT_QUOTES));
            $tasklist_query->bindParam(':date', $date);
            $tasklist_query->execute(); 
        }

        public function ready_task($user_id, $task_id)
        {
            $ready_tasklist_check_status = "SELECT `status` FROM `tasks` WHERE `id` = :task_id";
            $ready_tasklist_check_status_query = $this->pdo->prepare($ready_tasklist_check_status);
            $ready_tasklist_check_status_query->bindParam(':task_id', intval($task_id));
            $ready_tasklist_check_status_query->execute();
            $tasklist_status = $ready_tasklist_check_status_query->fetch();
    
            if($tasklist_status['status'] == 0)
            {
                $status = 1;
            }
    
            else
            {
                $status = 0;
            }
    
            $ready_tasklist = "UPDATE `tasks` SET `status` = '$status' WHERE `user_id` = :user_id  AND
                `id` = :task_id";
            $ready_tasklist_query = $this->pdo->prepare($ready_tasklist);
            $ready_tasklist_query->bindParam(':user_id', $user_id);
            $ready_tasklist_query->bindParam(':task_id', intval($task_id));
            $ready_tasklist_query->execute();
        }

        public function task_status($task_status)
        {
            switch ($task_status)
            {
                case '0':
                    $switch[0] = 'Ready';
                    $switch[1] = 'red';
                    break;

                case '1':
                    $switch[0] = 'Unready';
                    $switch[1] = 'green';
                    break;
            }  
            return $switch;
        }

        public function ready_all_tasks($user_id)
        {
            $ready_all_taskslist = "UPDATE `tasks` SET `status` = '1' WHERE `user_id` = :user_id";
            $ready_all_taskslist_query = $this->pdo->prepare($ready_all_taskslist);
            $ready_all_taskslist_query->bindParam(':user_id', $user_id);
            $ready_all_taskslist_query->execute();
        }

        public function remove_all_tasks($user_id)
        {
            $remove_all_taskslist = "DELETE FROM `tasks` WHERE `user_id` = :user_id";
            $remove_all_taskslist_query = $this->pdo->prepare($remove_all_taskslist);
            $remove_all_taskslist_query->bindParam(':user_id', $user_id);
            $remove_all_taskslist_query->execute();
        }

        public function remove_task($user_id, $task_id)
        {
            $remove_task_sql = "DELETE FROM `tasks` WHERE `id` = :task_id AND `user_id` = :user_id";
            $remove_task_query = $this->pdo->prepare($remove_task_sql);
            $remove_task_query->bindParam(':task_id', intval($task_id));
            $remove_task_query->bindParam(':user_id', $user_id);
            $remove_task_query->execute();
        }

        public function show_tasks($user_id)
        {
            $show_tasks_sql = "SELECT * FROM `tasks` WHERE `user_id` = :user_id
                ORDER BY `tasks`.`created_at`  DESC";
            $show_tasks_query = $this->pdo->prepare($show_tasks_sql);
            $show_tasks_query->bindParam(':user_id', $user_id);
            $show_tasks_query->execute();
            $out = array();
            foreach($show_tasks_query as $row)
            {
                $out[] = $row;
            }
            return $out;
        }

        public function deauth()
        {
            session_unset();
        }
    }
?>
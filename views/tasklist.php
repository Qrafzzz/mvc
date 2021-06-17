<div>
    <div>
    <form method = "POST" action = "?c=tasklist&method=add_task">
        <input type = "text" name = "add_task_text" placeholder = "Введите описание" required>
        <button type = "submit" name = "add_task_button" value = "1">Добавить</button>
    </form>
    </div>

    <div>
    <form method = "POST" action="?c=tasklist&method=remove_all">
        <button type = "submit" name = "remove_all_tasks_button" value = "1">Удалить все</button>
    </form>

    <form method = "POST" action="?c=tasklist&method=ready_all">
        <button type = "submit" name = "ready_all_tasks_button" value = "1">Готово все</button>
    </form>
    </div>
</div>

<div>
    <?php
        if($content)
            foreach($content as $task)
            {   
?>   
            <div>
                <div>
                    <div><?php echo htmlspecialchars($task['description'], ENT_QUOTES);
?>  
                    </div>
                    <div class = "task_buttons">
                        <form method = "POST" action="?c=tasklist&method=ready_task">
                            <button type = "submit" value = "<?php echo $task['id']; ?>"name = "ready_task_button"><?php if($task['status'] == 1) echo 'Не готово'; 
                            else echo 'Готово'; ?></button>
                        </form>

                        <form method = "POST" action="?c=tasklist&method=remove_task">
                            <button type = "submit" name = "remove_task_button" value = "<?php echo $task['id']; ?>">Удалить</button>
                        </form>
                    </div>
                </div>         
            </div>   
<?php
            }
?>       
</div>
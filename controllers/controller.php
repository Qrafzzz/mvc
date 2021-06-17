<?php
    class controller
    {
        public function get_body()
        {
            $content = $this->get_content();

            require_once('views/header.php');
            require_once('views/'.$this->class.'.php');

            if($_SESSION['id'])
            {
                require_once('views/logout.php');
            }

            require_once('views/footer.php'); 
        }

        public function error()
        {
            require_once('views/error.php');
        }
    }
?>
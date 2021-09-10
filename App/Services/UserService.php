<?php
    namespace App\Services;

    use App\Models\User; // para ser chamada no IF 

    class UserService
    {
        public function get($id = null) 
        {
            if($id) {
                User::select($id);
            } else {
                echo "erou";
              //throw new \Exception("Digite o ID correto");// 
              //User::selectAll();
            }
        }

        public function post() 
        {

        }

        public function update() 
        {

        }

        public function delete() 
        {
            
        }
    }

?>
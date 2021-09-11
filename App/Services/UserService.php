<?php
    namespace App\Services;

    use App\Models\User; // para ser chamada no IF 

    class UserService
    {
        public function get($id) 
        {
            if($id) {
                return User::select($id);
            } else {
                throw new \Exception("Favor passar um id válido");
            }
        }

        public function post()
        {
            $data = $_POST;
            return User::insert($data);

        }

        public function update() 
        {

        }

        public function delete() 
        {
            
        }
    }

?>
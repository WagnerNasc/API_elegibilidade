<?php 
    namespace App\Models; // o nome que foi colocado no composer.json + subpasta Models

    class User
    {
        private static $table = 'user'; // tabela

        public static function select(int $id) 
        {   // contra barra "\PDO" pois é um objeto global e está sendo usado namespace

            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
         
            // usa-se o self para atributos estáticos e != de static usar o this
         
            $sql = 'SELECT * FROM '.self::$table.' WHERE id = :id'; // : é um bind para evitar sql injection
            $stmt = $connPdo->prepare($sql); // prepara a query
            $stmt->bindValue(':id', $id); // pega o parametro 
            $stmt->execute();

            if ($stmt->rowCount() > 0) 
            {
                return $stmt->fetch(\PDO::FETCH_ASSOC); // Para não duplicar o retorno
            } else 
            {
                throw new \Exception("Nenhum usuário encontrado");
            }
        }
    }



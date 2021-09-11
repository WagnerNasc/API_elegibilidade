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
        
        public static function insert($data) 
        {
            $connPdo = new \PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
                  
            $sql = 'INSERT INTO '.self::$table.' (email, password, name) VALUES(:em, :pa, :na)'; // : é um bind para evitar sql injection
            $stmt = $connPdo->prepare($sql); // prepara a query
            $stmt->bindValue(':em', $data['email']); 
            $stmt->bindValue(':pa', $data['password']); 
            $stmt->bindValue(':na', $data['name']);
            $stmt->execute();

            if ($stmt->rowCount() > 0) 
            {
                return 'Usuário(a) inserido(a) com sucesso!'; // Para não duplicar o retorno
            } else 
            {
                throw new \Exception("Falha ao inserir usuário(a)");
            }
        }
    }

    


/*public static function select( $idTbl )
    {
        $ret = array( );

        $conn = new \mysqli( "localhost", "root", "", "api_elegibilidade" );

        if( !$conn->connect_error )
        {
            $sql = "SELECT id, name 
                    FROM user 
                    WHERE id = ?";

            $id = $name = null;

            if( $stmt = $conn->prepare( $sql ) )
            {
                $stmt->bind_param( "i", $idTbl ); 
                $stmt->execute( );
                $stmt->store_result( ); // tudo que vai vir da tabela

                if( $stmt->num_rows > 0 )
                {
                    $stmt->bind_result( $id, $name);

                    while( $stmt->fetch( ) )
                    {
                        $ret[] = array
                        (
                            "ID" => $id,
                            "NAME" => $name
                        );
                    }
                }
                else
                    $ret = "INVALID";

                $stmt->free_result( );
                $stmt->close( );
            }
            else
                $ret = "PREP_ERROR";

            $conn->close( );
        }
        else
            $ret = "CONNECTION_OFF";

        return $ret;
    }*/
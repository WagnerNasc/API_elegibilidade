<?php


    header('Content-Type: application/json');
    require_once '../vendor/autoload.php';
    
    // api/users/1

    //var_dump($_GET['api']); // URL QUERY STRING 
    //var_dump($_GET['url']); // URL AMIGAVEL FAIL

    // VER UMA FORMA DE PEGAR O PRÓXIMO PARAMETRO DA URL
    /*$url = explode('/', $_GET['url']);

    var_dump($url);*/
    
   if (isset($_GET['url']))
   {    
        $url = explode('/', $_GET['url']);
        //var_dump($url);

        if ($url[0] === 'api') 
        {
            array_shift($url); // remove a primeira posição do array

            $service = 'App\Services\\'.ucfirst($url[0]).'Service';
            array_shift($url); // remove a primeira e permanece
            //var_dump($service);    

            $method = strtolower($_SERVER['REQUEST_METHOD']); // pega o método 

            //print_r($url);

            try {
                $response = call_user_func_array(array(new $service, $method), $url);
                http_response_code(200);
                echo json_encode(array('status' => 'sucess', 'data' => $response));
                exit;
                //$service = new App\Services\UserService();
                //print_r($service -> get(intval($url)));
                //print_r(RetornaId(intval($url)));
                //var_dump($response);

            } catch (\Exception $e){
                http_response_code(500);
                echo json_encode(array('status' => 'error', 'data' => $e->getMessage()), JSON_UNESCAPED_UNICODE); 
            }

        }
        
    } 

    
<?php

    use ZendDiagnostics\Check\GuzzleHttpService;
    function checkURL($url,$string = null){
        return new GuzzleHttpService(
            $url,
            array(),
            array(),
            200,
            $string
        );
    }

    class HTTPChecker{
        private $p = [];
        function __construct($method,$url,$body){
            $this->p = [
                $url,
                array(),
                array(),
                200,
                null,
                null,
                $method,//POST
                $body//array
            ];
        }
        function assertSuccess(){
            if($this->p[6] == 'POST')
            {
                $this->p[1] = ['Content-Type' => 'application/json'];
                $this->p[2] = ['json' => $this->p[7]];
                
            }
            return new GuzzleHttpService($this->p[0],$this->p[1],$this->p[2],200,$this->p[4],$this->p[5],$this->p[6],null);
        }
        function assertFail(){
            if($this->p[6] == 'POST'){
                $this->p[1] = ['Content-Type' => 'application/json'];
                $this->p[2] = ['json' => $this->p[7]];
            } 
            return new GuzzleHttpService($this->p[0],$this->p[1],$this->p[2],500,$this->p[4],$this->p[5],$this->p[6],null);
        }
    }
    function checkEndpoint($method,$url,$body=null){
        return new HTTPChecker($method, $url, $body);
    }
    
    $samples=[];
    function getSample($slug){
        if(!empty($samples[$slug])) return $samples[$slug];
        else{
            $content = file_get_contents(ASSETS_HOST.'/apis/hook/sample/'.$slug);
            if(!$content) throw new Exception('Invalid Sample URL: '.ASSETS_HOST.'hook/sample/'.$slug);
            
            $obj = json_decode($content);
            if(!$obj) throw new Exception('Invalid sample syntax for sample/'.$slug.' '.$content);
            if(empty($samples[$slug])) $samples[$slug] = $obj;
            
            return $samples[$slug];
        }
    }
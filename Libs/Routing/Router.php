<?php


namespace Libs\Routing;


use Libs\Https\Request;

class Router
{
    private array $routingTables = [];

    public function __construct($routingTableClasses=[])
    {
        foreach ($routingTableClasses as $routingTableClass){
            $this->add($routingTableClass[0], new $routingTableClass[1]);
        }
    }

    public function add($prefixPregPattern, RoutingTable $routingTable)
    {
        $routingTable->registerMyUrlPatterns();
        $this->routingTables[] = [
            'prefixPregPattern' => $prefixPregPattern
            , 'table' => $routingTable];
    }

    public function resolve(Request $request){
        $path_info = $request->pathInfo();
        $result = null;
        foreach ($this->routingTables as $routingTable){
            if (preg_match($routingTable['prefixPregPattern'], $path_info, $matches)){
                $current_path_info = substr($path_info, strlen($matches[0]));
                $result = $routingTable['table']->resolve($current_path_info, $request->methodType());
                break;
            }
        }

        return $result;
    }
}
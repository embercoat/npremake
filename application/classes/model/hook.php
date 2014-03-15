<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_hook extends Model {
    private static $registry = array();


    function init(){
        $hooks = Kohana::config('hook');
        if(count($hooks)){
            foreach($hooks as $hook => $func){
                Model::factory('hook')->register($hook, $func);
            }
        }
    }

    function register($hook, $function){
        self::$registry[$hook][] = $function;
    }
    function execute($hook, $args){
        foreach(self::$registry[$hook] as $h){
            if(is_array($h)){
                if(is_array($args))
                    call_user_func_array(array(Model::factory($h[0]), $h[1]), $args);
                else
                    call_user_func(array(Model::factory($h[0]), $h[1]), $args);
            } else {
                if(is_array($args))
                    call_user_func_array($h[0], $args);
                else
                    call_user_func($h[0], $args);
            }
        }
    }
    function print_hooks(){
        var_dump(self::$registry);
    }

}
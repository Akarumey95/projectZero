<?php

namespace App\Helpers;

class RequestWorker
{
    /**
     * @param $rules
     * @param $toMarge
     * @return mixed
     */
    public static function merge($rules, $toMarge)
    {
        foreach ($rules as $key => $rule){
            if(isset($toMarge[$key])){
                $toMarge[$key] = $toMarge[$key] . "|" . $rule;
            }else{
                $toMarge[$key] = $rule;
            }
        }

        return $toMarge;
    }
}

<?php

function searchText($searchText) {
    return function ($task) use ($searchText){
        $task['taskName'] = trim(strtolower($task['taskName']));
        $searchText = trim(strtolower($searchText));

        if($searchText === ''){
            return true;
        } else {
            return strpos($task['taskName'],$searchText)!==FALSE;
        }
    };  
}

function searchStatus(string $status) : callable {
    return function ($task) use ($status) {
        if(($status === '') || ($status === 'all')){
            return true;
        } else {
            if($task['status'] === $status){
                return true;
            } else {
                return false;
            }
        }
    };
} 
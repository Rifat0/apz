<?php

namespace App\Helpers;
use Request;
use Session;
use App\Model\activitylog as LogActivityModel;

class ActivityLog
{
    public static function addToLog($subject,$note=false,$document=false)
    {
    	$log = [];
    	$log['subject'] = $subject;
    	$log['url'] = Request::fullUrl();
    	$log['method'] = Request::method();
    	$log['ip'] = Request::ip();
    	$log['agent'] = Request::header('user-agent');
    	$log['user_id'] = Session::get('admin_data')[0] ['admin_id'];
        if (!empty($note)) {
            $log['note'] = $note;
        }
        if (!empty($document)) {
            $log['document'] = $document;
        }        

    	LogActivityModel::create($log);

    }
}
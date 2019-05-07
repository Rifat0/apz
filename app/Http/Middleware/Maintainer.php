<?php
namespace App\Http\Middleware;

use Closure;
use Session;

class Maintainer{
    
    public function handle($request, Closure $next)
    {
    	$permission = Session::get('admin_data')[0] ['permission'];

        if (strpos($permission, ',') !== false) {
    	    $permission = explode(',', $permission);
    		$count = count($permission);
    		for ($x = 0; $x < $count; $x++) {
    			if ($permission[$x]=='maintainer'){
    			    return $next($request);
    			}
    		}
    	}elseif ($permission=='maintainer'){
    		return $next($request);
		}

		return redirect('/login');
        
    }
}
// case "GetCustomerData":

// $searchSelect = array("pos_contact.name","pos_contact.contact_id");
// $rowSelect = array(
// "pos_contact.contact_id",
// "pos_contact.contact_type",
// "pos_contact.name",
// "pos_contact.address",
// "pos_contact.phone",
// "pos_contact.email",
// "pos_contact.user_id",
// "pos_contact.contact_status",
// );
// $jointWhere = array();
// $tableSelect = array("pos_contact");
// $selectWhere = array("pos_contact.contact_type" => "customer");
// $selectNotWhere = array("pos_contact.contact_status" => 'inactive');

// $GetFilterData = app('admin')->GetFilterDataJoint($_POST,$tableSelect,$rowSelect,$searchSelect,$selectWhere,$jointWhere,$selectNotWhere;);

// $i = 0;
// for ($x = 0; $x < count($GetFilterData['Data']); $x++) {
//     $GetContactInfo = app('pos')->GetSalesByCustomerOrder($GetFilterData['Data'][$x]['contact_id']);
//     $GetFilterData['Data'][$x]['total_sale_due'] = $GetContactInfo['total_due'];
//     $GetFilterData['Data'][$x]['total_paid'] = $GetContactInfo['total_sales'];
//     $GetuserInfo = app('admin')->getuserdetails($GetFilterData['Data'][$x]['user_id']);
//     $GetFilterData['Data'][$x]['user_id'] = $GetuserInfo['first_name'].' '.$GetuserInfo['last_name'];
// }

// echo json_encode(array("draw" => intval($GetFilterData['draw']),"iTotalRecords" => $GetFilterData['iTotalRecords'],"iTotalDisplayRecords" => $GetFilterData['iTotalDisplayRecords'],"aaData" => $GetFilterData['Data']));

// break;
// case "GetCustomerData":

// $GetFilterData = app('admin')->GetFilterData($_POST,"pos_contact",array("contact_id","contact_type","name","address","phone","email","user_id","contact_status"),array("name","contact_id"),array("contact_type" => "customer"),array("contact_status" => 'inactive'));
// $i = 0;

// for ($x = 0; $x < count($GetFilterData['Data']); $x++) {
//     $GetContactInfo = app('pos')->GetSalesByCustomerOrder($GetFilterData['Data'][$x]['contact_id']);
//     $GetFilterData['Data'][$x]['total_sale_due'] = $GetContactInfo['total_due'];
//     $GetFilterData['Data'][$x]['total_paid'] = $GetContactInfo['total_sales'];
//     $GetuserInfo = app('admin')->getuserdetails($GetFilterData['Data'][$x]['user_id']);
//     $GetFilterData['Data'][$x]['added_by'] = $GetuserInfo['first_name'].' '.$GetuserInfo['last_name'];
// }

// $response = array(
// "draw" => intval($GetFilterData['draw']),
// "iTotalRecords" => $GetFilterData['iTotalRecords'],
// "iTotalDisplayRecords" => $GetFilterData['iTotalDisplayRecords'],
// "aaData" => $GetFilterData['Data']
// );
// echo json_encode($response);
// break;
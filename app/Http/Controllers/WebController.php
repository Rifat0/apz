<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\Model\as_notification;
use App\Model\tutorial;
use App\Model\termsandcondition;
use Image;
use Carbon;
use Session;
	
	class WebController extends Controller
	{
		public function notification(){
			$notifications = as_notification::all();
			return view('WebModiul.notification_manage',compact('notifications'));
		}
		
		public function notification_submit(Request $notification){
			$this->validate($notification, [
			'title'=> 'required',
			'message'=> 'required',
			'link'=> 'required'
			]);

			$as_notification = new as_notification;
	        $as_notification->title = $notification->title;
	        $as_notification->message = $notification->message;
	        $as_notification->link = $notification->link;
	        $as_notification->save();

	        return redirect()->back();
		}
		
		public function notification_edit($id){
			$notifications = as_notification::all();
			$notification = as_notification::where('notification_id', $id)->first();
			return view('WebModiul.notification_manage',compact('notification','notifications'));
		}

		public function notification_update(Request $notification){
			$this->validate($notification, [
			'title'=> 'required',
			'message'=> 'required',
			'link'=> 'required'
			]);

			$as_notification = as_notification::find($notification->notification_id);
			$as_notification->title = $notification->title;
			$as_notification->message = $notification->message;
			$as_notification->link = $notification->link;
			$as_notification->save();
			return redirect('/notification-manage');
		}

		public function notification_status($notification_id){
			$as_notification = as_notification::findOrFail($notification_id);
			if($as_notification->status == "deactive"){
		        $as_notification->status = "active";
		    } elseif($as_notification->status == "active") {
		        $as_notification->status = "deactive";
		    }
			$as_notification->save();
			return redirect('/notification-manage');
		}

		public function notification_delete($id){
			as_notification::where('notification_id', $id)->delete();
			$notifications = as_notification::all();
			return view('WebModiul.notification_manage',compact('notifications'));
		}
		
		public function career(){
			return view('WebModiul.careers');
		} 
		
		public function tutorial(){
			$tutorials = tutorial::all();
			return view('WebModiul.tutorial',compact('tutorials'));
		}  
		
		public function tutorial_submit(Request $tutorial){
			$this->validate($tutorial, [
			'title'=> 'required',
			'link'=> 'required'
			]);

			$tutorials = new tutorial;
	        $tutorials->title = $tutorial->title;
	        $tutorials->link = $tutorial->link;
	        $tutorials->save();

	        return redirect()->back();
		}

		public function tutorial_edit($id){
			$tutorials = tutorial::all();
			$tutorial = tutorial::where('tutorial_id', $id)->first();
			return view('WebModiul.tutorial',compact('tutorial','tutorials'));
		}

		public function tutorial_update(Request $tutorial){
			$this->validate($tutorial, [
			'title'=> 'required',
			'link'=> 'required'
			]);
			
			$tutorials = tutorial::find($tutorial->tutorial_id);
			$tutorials->title = $tutorial->title;
			$tutorials->link = $tutorial->link;
			$tutorials->save();
			return redirect('/tutorial-manage');
		}

		public function tutorial_status($tutorial_id){
			$tutorials = tutorial::findOrFail($tutorial_id);
			if($tutorials->status == "deactive"){
		        $tutorials->status = "active";
		    } elseif($tutorials->status == "active") {
		        $tutorials->status = "deactive";
		    }
			$tutorials->save();
			return redirect('/tutorial-manage');
		}

		public function tutorial_delete($id){
			tutorial::where('tutorial_id',$id)->delete();
			$tutorials = tutorial::all();
			return view('WebModiul.tutorial',compact('tutorials'));
		}

		public function ticket(){
			return view('WebModiul.support');
		}

			public function terms_condition_manage(){
				return view('WebModiul.terms_condition_manage');
			}  
			public function create_terms_condition(){
				return view('WebModiul.create_terms_condition');
			}
			public function store_terms_condition(Request $request){
				$filename='';
				$tc='';
				if($request->hasFile('tc_document')){
		    		$document = $request->file('tc_document');
		    		$filename = time() . '.' . $document->getClientOriginalExtension();
		    		Image::make($document)->save( public_path('/uploads/document/' . $filename ) );
		    	}
				if(isset($request->id)){
					$tc = termsandcondition::find($request->id);
					if($request->hasFile('tc_document')==false){
						$filename = $tc['document'];
					}
				}
				else{
					$tc = new termsandcondition;
				}
				$tc->added_by = Session('admin_data')[0]['admin_id'];
				$tc->type = "t&c";
				$tc->document = $filename;
				$tc->body_text = $request->body;
				$tc->status = 'active';
				$tc->created_at = Carbon::now();
				$tc->save();
				$arr = array('msg' => 'Terms & Condition Successfully Added.', 'status' => true);
				return Response()->json($arr);
			}  
			public function edit_terms_condition($id){
				$tc = termsandcondition::find($id);
				return view('WebModiul.create_terms_condition',compact('tc'));
			}
			public function delete_terms_condition($id){
				termsandcondition::where('t_c_id',$id)->delete();
				return redirect('/terms-condition');
			}               
	}

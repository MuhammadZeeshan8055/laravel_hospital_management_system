<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Messages;
use App\Models\Appointment;
use App\Models\Contact;

use Notification;
use App\Notifications\SendEmailNotication;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function addview(){

        if(Auth::id()){
            if(Auth::user()->usertype=='1'){

                return view('admin.add_doctor');

            }else{
                return redirect()->back();
            }   
        }else{
            return view('login');
        }

    }
    public function upload_doctor(Request $request){
        $doctor=new doctor;
        $image=$request->file;
        $imagename=time().'.'.$image->getClientoriginalExtension();
        $request->file->move('doctorimage',$imagename);
        $doctor->image=$imagename;

        $doctor->name=$request->name;
        $doctor->phone=$request->phone;
        $doctor->speciality=$request->speciality;
        $doctor->room=$request->room;
        $doctor->fee=$request->fee;

        $doctor->save();

        return redirect()->back()->with('message','Doctor Added Successfully'); 

    }

    public function show_appointment(){

        if(Auth::id()){

            if(Auth::user()->usertype=='1'){

                // $appointments=Appointment::all();

                $appointments = Appointment::join('users', 'appointments.doctor', '=', 'users.id')
                ->select('appointments.*', 'users.name as doctor_name')
                ->get();
                
                return view('admin.show_appointment',compact('appointments'));
            }else{
                return redirect()->back();
            }

        }else{
            return view('login');
        }
    }

    public function show_doctor(){

        if(Auth::id()){
            // $doctor=Doctor::all();

            $doctor = Doctor::join('users', 'Doctors.doctor_id', '=', 'users.id')
                ->select('Doctors.*', 'users.name as doctor_name','users.phone as doctor_phone')
                ->get();

            return view('admin.show_doctor',compact('doctor'));

        }else{
            return redirect()->back();
        }
    }

    public function delete_doctor($id){
        $delete=Doctor::find($id);

        if ($delete) {
            $doctor_id = $delete->doctor_id;
            
            // Now you can use $doctorName in your controller logic
        } else {
            // Handle the case where the user with the given $id is not found
        }

        $delete_doctor_record=User::find($doctor_id);

        
        $delete->delete();
        $delete_doctor_record->delete();

        return redirect()->back();
    }

    public function update_doctor($id){
        $doctor_detail=Doctor::find($id);

       
        return view('admin.update_doctor',compact('doctor_detail'));
    }

    public function edit_doctor(Request $request, $id){

        $doctor_detail=Doctor::find($id);

        // $doctor_detail->name=$request->name;
        // $doctor_detail->phone=$request->phone;
        // $doctor_detail->speciality=$request->speciality;
        // $doctor_detail->room=$request->room;
        // $doctor_detail->fee=$request->fee;

        // $image=$request->file;

        // if($image){
        //     $imagename=time().'.'.$image->getClientoriginalExtension();
        //     $request->file->move('doctorimage',$imagename);
            
        //     $doctor_detail->image=$imagename;
    
        // }

        $doctor_detail->status=$request->status;

        
        $doctor_detail->save();

        return redirect()->back()->with('message','Doctor Info Updated Successfully');
    }

    public function approved($id){
        $approved=Appointment::find($id);

        $approved->status='Approved';

        $approved->save();

        return redirect()->back();
    }

    public function cancelled($id){
        $approved=Appointment::find($id);

        $approved->status='Cancelled';

        $approved->save();

        return redirect()->back();
    }

    //email 
    public function email_view($id){

        $data=Appointment::find($id);

        return view('admin.email_view',compact('data'));
    }

    public function sendemail(Request $request,$id){
        $data=Appointment::find($id);

        $details=[
            'greeting' => $request->greeting,
            'body' => $request->body,
            'actiontext' => $request->actiontext,
            'actionurl' => $request->actionurl,
            'endpart' => $request->endpart
        ];

            Notification::send($data,new SendEmailNotication($details));

            return redirect()->back()->with('message','Email Sended Successfully');
    }

    public function doctor_appointment(){

        $doctor=auth()->id();
        $appointments=Appointment::where('doctor',$doctor)->get();;
                return view('doctor.show_appointment',compact('appointments'));

    }

    public function doctor_chats(){
        $doctor = auth()->id();
        $chats = Appointment::where('doctor', $doctor)->get()->unique('user_id');
        return view('doctor.chats', compact('chats'));
    }
    public function doctor_show_chat($id){

        $auth_id=Auth::id();

        $user_name=User::find($id);

        $chat = Messages::where('from_id', $id)
        ->where('to_id', $auth_id) // Additional condition
        ->orWhere('from_id', $auth_id)
        ->where('to_id', $id)
        ->get();

      
        
        return view('doctor.show_chat', ['chat' => $chat],['user_name' => $user_name]);
    }

    public function chat_with_doctor($id){
        
        $auth_id=Auth::id();

        $doctor=User::find($id);

        if ($doctor) {
            $doctorName = $doctor->name;
            // Now you can use $doctorName in your controller logic
        } else {
            // Handle the case where the user with the given $id is not found
        }
        
        $chat = Messages::where('from_id', $auth_id)
        ->where('to_id', $id) // Additional condition
        ->orWhere('from_id', $id)
        ->where('to_id', $auth_id)
        ->get();

        return view('admin.patient_chat', ['chat' => $chat,'doctorName' => $doctorName]);
    }

    public function complete_profile(){

        $auth_id=Auth::id();


        $checking_Profile=Doctor::where('doctor_id', $auth_id)->get();

       
            return view('doctor.profile');

        


        
    }
    public function complete_doctors_profile(Request $request){

        $auth_id=Auth::id();

        $doctor=new doctor;
        $image=$request->file;
        $imagename=time().'.'.$image->getClientoriginalExtension();
        $request->file->move('doctorimage',$imagename);
        $doctor->image=$imagename;

        $doctor->speciality=$request->speciality;
        $doctor->fee=$request->fee;
        $doctor->doctor_id=$auth_id;

        $doctor->save();

        return redirect()->back()->with('message','Doctor Added Successfully'); 

    }

    public function search(Request $request){

        // Validate the input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

            // Retrieve the input values
            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'));

            
                    $in_progress = appointment::where('status', 'In Progress')->whereBetween('date', [$startDate, $endDate])->count();
                    
                    $approved = appointment::where('status', 'Approved')->whereBetween('date', [$startDate, $endDate])->count();
                    
                    $cancelled = appointment::where('status', 'Cancelled')->whereBetween('date', [$startDate, $endDate])->count();
                 
                    $totalFee = Appointment::whereBetween('date', [$startDate, $endDate])
                    ->where('status', '=', 'Approved') // Exclude appointments with 'Cancelled' status
                    ->sum('fee');
            // Pass the search results to the view
            return view('doctor.search_results', compact('in_progress','approved','cancelled','totalFee'));
    }

    public function contact(){
        $contact = Contact::all();
        return view('admin.contact', compact('contact'));

    }
    // public function total_doctors(){
    //     $doctors = doctor::all()->count();
    //     $patient = User::where('userType', '0')->count();
    //     $appointments = Appointment::all()->count();
    //     $pending_appointment = Appointment::where('status', 'In Progress')->count();

    //     return view('admin.home', compact('doctors','patient','appointments','pending_appointment'));
    // }


}

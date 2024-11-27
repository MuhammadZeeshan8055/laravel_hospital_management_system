<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\doctor;
use App\Models\Appointment;
use App\Models\Contact;

class HomeController extends Controller
{

    public function index(){

        if(Auth::id()){
            
            return redirect('home');

        }else{

            $doctor = User::join('doctors', 'users.id', '=', 'doctors.doctor_id')
            ->select('users.*', 'doctors.*')
            ->where('doctors.status', '=', 1)
            ->get();
            
            return view('user.home',compact('doctor'));

        }

    }

    public function redirect(){

        if(Auth::id()){
            if(Auth::user()->usertype=='0'){
                
                $doctor = User::join('doctors', 'users.id', '=', 'doctors.doctor_id')
                ->select('users.*', 'doctors.*')
                ->where('doctors.status', '=', 1)
                ->get();


                return view('user.home',compact('doctor'));


            }elseif(Auth::user()->usertype=='2'){

                    $doctor=auth()->id();
                    $in_progress = appointment::where('status', 'In Progress')->where('doctor', $doctor)->count();
                    
                    $approved = appointment::where('status', 'Approved')->where('doctor', $doctor)->count();
                    
                    $cancelled = appointment::where('status', 'Cancelled')->where('doctor', $doctor)->count();
                 
                    $totalFee = Appointment::where('doctor', $doctor)
                    ->where('status', '=', 'Approved') // Exclude appointments with 'Cancelled' status
                    ->sum('fee');

                    return view('doctor.home',compact('in_progress','approved','cancelled','totalFee'));

            }
            else{

                $doctors = User::where('usertype', '2')->count();
                $patients = User::where('usertype', '0')->count();
                $approved_doctors = Doctor::where('status', '1')->count();
                $pending_doctors = Doctor::where('status', '0')->count();
                    
                return view('admin.home',compact('doctors','patients','approved_doctors','pending_doctors'));

            }
        }else{
            return redirect()->back();
        }

    }

    

    public function appointment(Request $request){

        $data = new Appointment();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->date=$request->date;
        $data->time=$request->time;       
        $data->phone=$request->number;
        $data->message=$request->message;
      
        $departmentName = $request->department;

            // Find the user with the matching department name
            $user = User::where('name', $departmentName)->first();

            if ($user) {
                // Access the user's ID
                $doctor_id = $user->id;
                // Now you can use $doctor_id in your controller logic
            } else {
                // Handle the case where no user with the specified department name is found
            }
       
        $data->doctor=$doctor_id;

        $data->status='In Progress';

        
        $doctor = Doctor::where('doctor_id', $doctor_id)->first();

        if ($doctor) {
            
            $doctor_fee = $doctor->fee;
            
        } else {
            // Handle the case where no doctor is found for the given department
        }
     
        $data->fee=$doctor_fee;
        

        if(Auth::id()){
            $data->user_id=Auth::user()->id;
        }


        // Check if the combination of date and time is already taken
            $existingAppointment = Appointment::where('doctor', $doctor_id)
            ->where('date', $request->date)
            ->where('time', $request->time)
            ->first();

        if ($existingAppointment) {
            return redirect()->back()->with('message', 'The selected date and time are already taken. Please choose a different date or time.');
        }else{
            $data->save();

            return redirect()->back()->with('message','Appointment Request Successfull, We will contact with you soon');
    
        }

       
    }

    public function myappointment(){

        if(Auth::id()){

            if(Auth::user()->usertype=='0'){

                $user_id=Auth::user()->id;
                
                $user_name = Auth::user()->name;
                
                // $appointment=Appointment::where('user_id',$user_id)->get();
    
                $appointment = Appointment::join('users', 'appointments.doctor', '=', 'users.id')
                ->select('appointments.*', 'users.name as doctor_name')
                ->where('appointments.name','=', $user_name)
                ->get();

                return view('user.my_appointment',compact('appointment'));
    
            }else{
                return redirect()->back();
            }
          
        }else{
            
            return redirect()->back();
        }

    }

    public function cancelappointment($id){
        $cancel=Appointment::find($id);
        $cancel->delete();

        return redirect()->back();
    }

    public function about(){
        return view('user.about');
    }
    public function doctor_info(){
        $doctor = User::join('doctors', 'users.id', '=', 'doctors.doctor_id')
        ->select('users.*', 'doctors.*')
        ->where('doctors.status', '=', 1)
        ->get();

        return view('user.doctor_info',compact('doctor'));

        
    }
    public function contact(){
        return view('user.contact');
    }

    public function contact_us(Request $request){

        $contact_us=new Contact;

        $contact_us->name=$request->name;
        $contact_us->email=$request->email;
        $contact_us->subject=$request->subject;
        $contact_us->message=$request->message;
       

        $contact_us->save();

        return redirect()->back()->with('message','Message Sent, We Will Contact You Shortly'); 

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Models\PatientRecord;
use App\Models\Obgyne;
use App\Models\Vaccine;
use App\Models\MedicalHistory;
use App\Models\consultationPediatrics;
use App\Models\BaselineDiagnostics;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\InactiveUser;
use App\Models\ObgyneHistory;
use App\Models\Immunizations;
use App\Models\pediatricsConsultation;
use Illuminate\Support\Facades\Http;
use Aws\S3\S3Client; 
use DOMDocument;

class PatientController extends Controller
{
    

    public function patient_record_history(){
        $users = User::where('usertype', '=', 'user')
             ->where('is_active', '=', 'active')
             ->get();
        return view('admin.patient_record_history', ['users' => $users]);
    }

    public function inactive_users(){
        $users = User::where('usertype', '=', 'user')
             ->where('is_active', '=', 'inactive')
             ->get();
        return view('admin.inactive_users', ['users' => $users]);
    }

    public function search_user(Request $request){
        $search = $request->input('search');
    
        $users = User::where('usertype', 'user')
                        ->where('name', 'like', "%$search%")
                        ->get();
        return view('admin.patient_record_history', ['users' => $users]);
    }

    public function createPediatrics(Patient $patient){
        $pediatrics = $patient->patientRecord()->latest()->first();
        return view('admin.pediatrics', ['patient' => $patient], ['pediatrics' => $pediatrics]);
    }

    public function createObgyne(Patient $patient){
        return view('admin.obgyne', ['patient' => $patient]);
    }

    public function home(){
        return view('admin.index');
    }

    public function uploadImagePedia(Patient $patient, Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $region = env('AWS_DEFAULT_REGION'); 
        $version = env('latest'); 
        $access_key_id = env('AWS_ACCESS_KEY_ID'); 
        $secret_access_key = env('AWS_SECRET_ACCESS_KEY'); 
        $bucket = env('AWS_BUCKET'); 
        
        
        $statusMsg = ''; 
        $status = 'danger'; 
        
        if(isset($_POST["submit"])){ 
            if(!empty($_FILES["image"]["name"])) { 
                $file_name = basename($_FILES["image"]["name"]); 
                $file_type = pathinfo($file_name, PATHINFO_EXTENSION); 
                
                $allowTypes = array('pdf','jpg','png','jpeg'); 
                if(in_array($file_type, $allowTypes)){ 
                    $file_temp_src = $_FILES["image"]["tmp_name"]; 
                    
                    if(is_uploaded_file($file_temp_src)){ 
                        $s3 = new S3Client([ 
                            'version' => $version, 
                            'region'  => $region, 
                            'credentials' => [ 
                                'key'    => $access_key_id, 
                                'secret' => $secret_access_key, 
                            ] 
                        ]); 
        
                        try { 
                            $result = $s3->putObject([ 
                                'Bucket' => $bucket, 
                                'Key'    => $file_name, 
                                'ACL'    => 'public-read', 
                                'SourceFile' => $file_temp_src 
                            ]); 
                            $result_arr = $result->toArray(); 
                            
                            if(!empty($result_arr['ObjectURL'])) { 
                                $s3_file_link = $result_arr['ObjectURL']; 
                            } else { 
                                $api_error = 'Upload Failed! Image Object URL not found.'; 
                            } 
                        } catch (Aws\S3\Exception\S3Exception $e) { 
                            $api_error = $e->getMessage(); 
                        } 
                        if(empty($api_error)){ 
                            $status = 'success'; 
                            $statusMsg = "File was uploaded and scanned successfully!"; 
                            $apiUrl = 'https://pbem2315rk.execute-api.ap-southeast-1.amazonaws.com/Dev/patient-record-scanner/' . $file_name;
                            $response = Http::get($apiUrl);
                            $response = json_decode($response, true);
                           
                        }else{ 
                            $statusMsg = $api_error; 
                        } 
                    }else{ 
                        $statusMsg = "File upload failed!"; 
                    } 
                }else{ 
                    $statusMsg = 'Sorry, Image files are allowed to upload.'; 
                } 
            }else{ 
                $statusMsg = 'Please select a file to upload.'; 
            } 
        } 
        return view('admin.pediatrics',['response' => $response], ['patient' => $patient]);
    }

    public function uploadImageOb(Patient $patient, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $region = env('AWS_DEFAULT_REGION'); 
        $version = env('latest'); 
        $access_key_id = env('AWS_ACCESS_KEY_ID'); 
        $secret_access_key = env('AWS_SECRET_ACCESS_KEY'); 
        $bucket = env('AWS_BUCKET'); 
        
        
        $statusMsg = ''; 
        $status = 'danger'; 
        
        if(isset($_POST["submit"])){ 
            if(!empty($_FILES["image"]["name"])) { 
                $file_name = basename($_FILES["image"]["name"]); 
                $file_type = pathinfo($file_name, PATHINFO_EXTENSION); 
                
                $allowTypes = array('pdf','jpg','png','jpeg'); 
                if(in_array($file_type, $allowTypes)){ 
                    $file_temp_src = $_FILES["image"]["tmp_name"]; 
                    
                    if(is_uploaded_file($file_temp_src)){ 
                        $s3 = new S3Client([ 
                            'version' => $version, 
                            'region'  => $region, 
                            'credentials' => [ 
                                'key'    => $access_key_id, 
                                'secret' => $secret_access_key, 
                            ] 
                        ]); 
        
                        try { 
                            $result = $s3->putObject([ 
                                'Bucket' => $bucket, 
                                'Key'    => $file_name, 
                                'ACL'    => 'public-read', 
                                'SourceFile' => $file_temp_src 
                            ]); 
                            $result_arr = $result->toArray(); 
                            
                            if(!empty($result_arr['ObjectURL'])) { 
                                $s3_file_link = $result_arr['ObjectURL']; 
                            } else { 
                                $api_error = 'Upload Failed! Image Object URL not found.'; 
                            } 
                        } catch (Aws\S3\Exception\S3Exception $e) { 
                            $api_error = $e->getMessage(); 
                        } 
                        if(empty($api_error)){ 
                            $status = 'success'; 
                            $statusMsg = "File was uploaded and scanned successfully!"; 
                            $apiUrl = 'https://pbem2315rk.execute-api.ap-southeast-1.amazonaws.com/Dev/patient-record-scanner/' . $file_name;
                            $response = Http::get($apiUrl);
                            $response = json_decode($response, true);
                        }else{ 
                            $statusMsg = $api_error; 
                        } 
                    }else{ 
                        $statusMsg = "File upload failed!"; 
                    } 
                }else{ 
                    $statusMsg = 'Sorry, Image files are allowed to upload.'; 
                } 
            }else{ 
                $statusMsg = 'Please select a file to upload.'; 
            } 
        } 
        return view('admin.obgyne',['response' => $response], ['patient' => $patient]);
    }
    

    public function store(Patient $patient, Request $request){
        $user = Auth::user();
        $newPatientRecord = new PatientRecord();
        $newPatientRecord->patient_id = $patient->id;
        $newPatientRecord->type = $request->input("type");
        $newPatientRecord->last_name = $request->input("last_name");
        $newPatientRecord->first_name = $request->input("first_name");
        $newPatientRecord->birthdate = $request->input("birthdate");
        $newPatientRecord->sex = $request->input("sex");
        $newPatientRecord->address = $request->input("address");
        $newPatientRecord->mother_name = $request->input("mother_name");
        $newPatientRecord->mother_phone = $request->input("mother_phone");
        $newPatientRecord->father_name = $request->input("father_name");
        $newPatientRecord->father_phone = $request->input("father_phone");


        $history = $request->input("history");
        $dom = new DOMDocument();
        $dom->loadHTML($history,9);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/uplade/" . time(). $key.'png';
            file_put_contents(public_path().$image_name,$data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }
        $description = $dom->saveHTML();
        $newPatientRecord->history = $history;


        $orders = $request->input("orders");
        $dom2 = new DOMDocument();
        $dom2->loadHTML($orders,9);
        $images2 = $dom2->getElementsByTagName('img');
        foreach ($images2 as $key2 => $img2) {
            $data2 = base64_decode(explode(',',explode(';',$img2->getAttribute('src'))[1])[1]);
            $image_name2 = "/uplade/" . time(). $key2.'png';
            file_put_contents(public_path().$image_name2,$data2);

            $img2->removeAttribute('src');
            $img2->setAttribute('src',$image_name2);
        }
        $description2 = $dom2->saveHTML();
        $newPatientRecord->orders = $orders;



        
        
        $newPatientRecord->save();

        $newVaccine = new Vaccine();
        $newVaccine->patient_record_id = $newPatientRecord->id;
        $newVaccine->BCG = $request->input("BCG");
        $newVaccine->Hepatitis_B = $request->input("Hepatitis B");
        $newVaccine->DPT = $request->input("DPT");
        $newVaccine->Polio_OPU = $request->input("Polio_OPU");
        $newVaccine->Polio_IPU = $request->input("Polio_IPU");
        $newVaccine->HiB = $request->input("HiB");
        $newVaccine->PCV = $request->input("PCV");
        $newVaccine->Measles = $request->input("Measles");
        $newVaccine->Varicella = $request->input("Varicella");
        $newVaccine->Hepatitis_A = $request->input("Hepatitis_A");
        $newVaccine->Meningo = $request->input("Meningo");
        $newVaccine->Typhoid = $request->input("Typhoid");
        $newVaccine->Jap_Enceph = $request->input("Jap_Enceph");
        $newVaccine->HPV = $request->input("HPV");
        $newVaccine->Flu = $request->input("Flu");
        $newVaccine->save();


        

        


        

        return view('admin.pediatrics', ['patient' => $patient]);
    }


    public function storeConsultationPedia(Patient $patient, Request $request) {
         
        

        return view('admin.pediatrics', ['patient' => $patient]);

    }

    public function storeObgyne(Patient $patient, Request $request)
    {

        $newObgyne = new Obgyne();
        $newObgyne->patient_id = $patient->id;
        $newObgyne->type = $request->input("type");
        $newObgyne->last_name = $request->input("last_name");
        $newObgyne->first_name = $request->input("first_name");
        $newObgyne->birthdate = $request->input("birthdate");
        $newObgyne->civil_status = $request->input("civil_status");
        $newObgyne->address = $request->input("address");
        $newObgyne->contact_number = $request->input("contact_number");
        $newObgyne->occupation = $request->input("occupation");
        $newObgyne->religion = $request->input("religion");
        $newObgyne->referred_by = $request->input("referred_by");
        $newObgyne->emergency_contact_no = $request->input("emergency_contact_no");
        $newObgyne->save();

        $MedicalHistory = new MedicalHistory();
        $MedicalHistory->obgyne_id = $newObgyne->id;
        $MedicalHistory->Hypertension = $request->input("Hypertension");
        $MedicalHistory->Asthma = $request->input("Asthma");
        $MedicalHistory->Thyroid_Disease = $request->input("Thyroid_Disease");
        $MedicalHistory->Allergy = $request->input("Allergy");
        $MedicalHistory->social_history = $request->input("social_history");
        $MedicalHistory->Family_History = $request->input("Family_History");
        $MedicalHistory->save();

        $newBaselineDiagnostics = new BaselineDiagnostics();
        $newBaselineDiagnostics->obgyne_id = $newObgyne->id;
        $newBaselineDiagnostics->date = $request->input("date");
        $newBaselineDiagnostics->blood_type = $request->input("blood_type");
        $newBaselineDiagnostics->FBS = $request->input("FBS");
        $newBaselineDiagnostics->Hgb = $request->input("Hgb");
        $newBaselineDiagnostics->Hct = $request->input("Hct");
        $newBaselineDiagnostics->WBC = $request->input("WBC");
        $newBaselineDiagnostics->Platelet = $request->input("Platelet");
        $newBaselineDiagnostics->HIV = $request->input("HIV");
        $newBaselineDiagnostics->first_hr = $request->input("first_hr");
        $newBaselineDiagnostics->second_hr = $request->input("second_hr");
        $newBaselineDiagnostics->HBsAg = $request->input("HBsAg");
        $newBaselineDiagnostics->RPR = $request->input("RPR");
        $newBaselineDiagnostics->protein = $request->input("protein");
        $newBaselineDiagnostics->sugar = $request->input("sugar");
        $newBaselineDiagnostics->LMP = $request->input("LMP");
        $newBaselineDiagnostics->PMP = $request->input("PMP");
        $newBaselineDiagnostics->AOG = $request->input("AOG");
        $newBaselineDiagnostics->EDD = $request->input("EDD");
        $newBaselineDiagnostics->early_ultrasound = $request->input("early_ultrasound");
        $newBaselineDiagnostics->AOG_by_eutz = $request->input("AOG_by_eutz");
        $newBaselineDiagnostics->EDD_by_eutz = $request->input("EDD_by_eutz");
        $newBaselineDiagnostics->Other = $request->input("Other");
        $newBaselineDiagnostics->save();

        $newObgyneHistory = new ObgyneHistory();
        $newObgyneHistory->obgyne_id = $newObgyne->id;
        $newObgyneHistory->gravidity = $request->input("gravidity");
        $newObgyneHistory->parity = $request->input("parity");
        $newObgyneHistory->OB_score = $request->input("OB_score");
        $newObgyneHistory->table = $request->input("table");
        $newObgyneHistory->M = $request->input("M");
        $newObgyneHistory->I = $request->input("I");
        $newObgyneHistory->D = $request->input("D");
        $newObgyneHistory->A = $request->input("A");
        $newObgyneHistory->S = $request->input("S");
        $newObgyneHistory->save();

        $newImmunizations = new Immunizations();
        $newImmunizations->obgyne_id = $newObgyne->id;
        $newImmunizations->TT_1 = $request->input("TT_1");
        $newImmunizations->TT_2 = $request->input("TT_2");
        $newImmunizations->TT_3 = $request->input("TT_3");
        $newImmunizations->TT_4 = $request->input("TT_4");
        $newImmunizations->TT_5 = $request->input("TT_5");
        $newImmunizations->flu = $request->input("flu");
        $newImmunizations->Pneumo = $request->input("Pneumo");
        $newImmunizations->hepa_b = $request->input("hepa_b");
        $newImmunizations->save();

        return view('admin.pediatrics', ['patient' => $patient]);
    }

    public function storeMedicalHistory(Patient $patient, Request $request)
    {
        

        return redirect(route('patient.patient_record_history'))->with('success', 'Added Successfully');

    }

    public function storeBaselineDiagnostic(Patient $patient, Request $request)
    {
        
        
        return redirect(route('patient.patient_record_history'))->with('success', 'Added Successfully');

    }

    public function storeObgyneHistory(Patient $patient, Request $request)
    {
        

        return redirect(route('patient.patient_record_history'))->with('success', 'Added Successfully');
    }

    public function storeImmunizations(Patient $patient, Request $request)
    {
       

        return redirect(route('patient.patient_record_history'))->with('success', 'Added Successfully');

    }


    public function move_inactive(User $user)
    {
        $is_active = "inactive";
        $user->update([
            'is_active' => $is_active
        ]);
        return redirect(route('patient.patient_record_history'))->with('success', 'User moved to inactive list successfully.');
    }

    public function move_active(User $user)
    {
        $is_active = "active";
        $user->update([
            'is_active' => $is_active
        ]);
        $new = $user->is_active;
        return redirect(route('inactiveUsers'))->with('success', 'User moved to active list successfully.');
    }

    public function add_patientView(){
        return view('admin.add_patient');
    }

    public function add_patient(Request $request){


        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ];
    
        $messages = [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters long.',
        ];


        $validatedData = $request->validate($rules, $messages);
        $newUser = new User();
        $newUser->name = $validatedData['name'];
        $newUser->email = $validatedData['email'];
        $newUser->password = bcrypt($validatedData['password']);
        $newUser->save();

        
        $newPatient = new Patient();
        $newPatient->user_id = $newUser->id;
        $newPatient->name = $newUser->name;
        $newPatient->email = $newUser->email;
        $newPatient->save();

        return redirect(route('addPatientView'))->with('success', 'User created successfully.');
    }














    public function viewRecords(User $user){
        
        $user_id = $user->id;

        $patient = Patient::where('user_id', $user_id)->first();


        if (!$patient) {
            $user_name = $user->name;
            $user_email = $user->email;
    
            $patient = new Patient();
            $patient->user_id = $user_id;
            $patient->name = $user_name;
            $patient->email = $user_email;
            $patient->save();
        }
        return view('admin.viewRecord', ['patient' => $patient]);

    }

    public function viewPediatrics($patient) {
        $patient = PatientRecord::with('Vaccine')->find($patient);
        if ($patient && $patient->type == 'Pediatrics') {
            $bcgVaccine = $patient->vaccine;

            return view('admin.viewPediatrics', ['patient' => $patient], ['bcgVaccine' => $bcgVaccine]);
        }
    
        return view('admin.viewObgyne', ['patient' => $patient]);
    }

    public function viewObgyne($patient) {
        $patient = Obgyne::with(['MedicalHistory', 'BaselineDiagnostics', 'ObgyneHistory'])->find($patient);
        return view('admin.viewObgyne', ['patient' => $patient]);
    }

    public function store_patients(Request $request){
        $newPatient = new patient();
        if (Patient::where('name', $request->input("name"))->exists()) {
            die("Error: 404");
        } else {
            $newPatient->name = $request->input("name");
            $newPatient->email = $request->input("email");
            $newPatient->save();
        }
        $patients = Patient::with('patientRecord', 'obgyne')->get();
        return view('admin.patient_record_history', ['patients' => $patients]);
    }


   

    public function edit(Patient $patient){
        return view('admin.edit', ['patient' => $patient]);

    }





//FIX THHIS SHIT DAWG 
    public function update(Patient $patient, patientRecord $patientRecord){
        $patients = Patient::with('patientRecord', 'obgyne')->get();
        
        if ($patientRecord->type == "Obgyne"){
            return view('admin.viewRecord');
        } else {
            return view('admin.update_pediatrics', ['patient' => $patient], ['patients' => $patients]);
        }
        
    }

   
    
    public function update_patient(Patient $patient, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email'  => 'required',
        
        ]);

        $patient->update($data);

        return redirect(route('patient.patient_record_history'))->with('success', 'Updated Successfully');
    }

    public function update_pediatrics(Patient $patient, Request $request){
        $data = $request->validate([
            'sex' => 'required',
            'age'  => 'required',
            'address'  => 'required',
            'mother_name'  => 'required',
            'mother_phone'  => 'required',
            'father_name'  => 'required',
            'father_phone'  => 'required',
        ]);

        foreach($patient->patientRecord as $rr ){
            $rr->sex = $request->input("sex");
            $rr->age = $request->input("age");
            $rr->address = $request->input("address");
            $rr->mother_name = $request->input("mother_name");
            $rr->mother_phone = $request->input("mother_phone");
            $rr->father_name = $request->input("father_name");
            $rr->father_phone = $request->input("father_phone");
            $rr->save();
         }

        return redirect(route('patient.patient_record_history'))->with('success', 'Updated Successfully');
    }

    public function update_obgyne(Patient $patient, Request $request){
        $data = $request->validate([
            'sex' => 'required',
            'age'  => 'required',
            'address'  => 'required',
            'mother_name'  => 'required',
            'mother_phone'  => 'required',
            'father_name'  => 'required',
            'father_phone'  => 'required',
        ]);

        foreach($patient->patientRecord as $rr ){
            $rr->sex = $request->input("sex");
            $rr->age = $request->input("age");
            $rr->address = $request->input("address");
            $rr->mother_name = $request->input("mother_name");
            $rr->mother_phone = $request->input("mother_phone");
            $rr->father_name = $request->input("father_name");
            $rr->father_phone = $request->input("father_phone");
            $rr->save();
         }

        return redirect(route('patient.patient_record_history'))->with('success', 'Updated Successfully');
    }

    public function delete(Patient $patient){
        DB::table('patient_records')->where('patient_id', '=', $patient->id)->delete();
        return view('admin.viewRecord', ['patient' => $patient]);
    }


    public function consultations(){
        $consultationPediatrics = consultationPediatrics::all();
        $patients = Patient::all();
        return view('admin.consultation_record', compact('consultationPediatrics', 'patients'));
    }

    public function add_consultation() {
        $user = Auth::user();
        $patients = Patient::all();
        return view('admin.create_consultation', ['user' => $user], ['patients' => $patients]);
    }

    public function create_consultation(Request $request){
        $user = Auth::user();
        $consultation = $request->history;

        $dom = new DOMDocument();
        $dom->loadHTML($consultation,9);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/uplade/" . time(). $key.'png';
            file_put_contents(public_path().$image_name,$data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }
        $description = $dom->saveHTML();
        
        

        $newConsultationPediatrics = new consultationPediatrics();
        
        $newConsultationPediatrics->patient_id = $request->input("patient_id");
        $newConsultationPediatrics->consultation = $consultation;
        $newConsultationPediatrics->created_by = $user->name;
        $newConsultationPediatrics->save();


        $consultationPediatrics = consultationPediatrics::all();
        $patients = Patient::all();
        return view('admin.consultation_record', compact('consultationPediatrics', 'patients'));
    }
    

    public function show_consultationRecord($id){
        $consultationPediatrics = consultationPediatrics::find($id);

       
   
        return view('admin.show_consultationRecord', compact('consultationPediatrics'));
    }

    public function edit_consultationRecord(consultationPediatrics $consultationPediatrics, Patient $patient){
        return view('admin.edit_consultationRecord', ['consultationPediatrics' => $consultationPediatrics], ['patient' => $patient]);
    }

    public function update_consultationRecord(consultationPediatrics $consultationPediatrics, Patient $patient, Request $request){
        $consultationPediatrics = consultationPediatrics::find($consultationPediatrics->id);
        $user = Auth::user();
        $history = $request->history;

        $dom = new DOMDocument();
        $dom->loadHTML($history,9);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            if(strpos($img->getAttribute('src'), 'data:image/') ===0){
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/uplade/" . time(). $key.'png';
            file_put_contents(public_path().$image_name,$data);

            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
            }
        }
        $description = $dom->saveHTML();

        $consultationPediatrics->update([
            'history' => $history
        ]);
        $consultationPediatrics = consultationPediatrics::all();
        $patients = Patient::all();
        return view('admin.consultation_record', compact('consultationPediatrics', 'patients'));
    }
    public function delete_consultation(consultationPediatrics $consultationPediatrics){
        $consultationPediatrics->delete();
        $consultationPediatrics = consultationPediatrics::all();
        $patients = Patient::all();
        return view('admin.consultation_record', compact('consultationPediatrics', 'patients'));
    }
}

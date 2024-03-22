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
use App\Models\ObgyneHistory;
use Illuminate\Support\Facades\Http;
use Aws\S3\S3Client; 
use DOMDocument;

class PatientController extends Controller
{
    

    public function patient_record_history(){
        $users = User::where('usertype', '=' , 'user')->get();
        return view('admin.patient_record_history', ['users' => $users]);
        
    }

    public function search_user(Request $request){
        $search = $request->input('search');
    
        $users = User::where('usertype', 'user')
                        ->where('name', 'like', "%$search%")
                        ->get();
        return view('admin.patient_record_history', ['users' => $users]);
    }

    public function createPediatrics(Patient $patient){
        return view('admin.pediatrics', ['patient' => $patient]);
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
        dd($response);
        return view('admin.obgyne',['response' => $response], ['patient' => $patient]);
    }

    public function store(Patient $patient, Request $request){
        $user = Auth::user();
        $newPatientRecord = new PatientRecord();
        $newPatientRecord->patient_id = $patient->id;
        $newPatientRecord->type = $request->input("type");
        $newPatientRecord->birthdate = $request->input("birthdate");
        $newPatientRecord->sex = $request->input("sex");
        $newPatientRecord->age = $request->input("age");
        $newPatientRecord->address = $request->input("address");
        $newPatientRecord->mother_name = $request->input("mother_name");
        $newPatientRecord->mother_phone = $request->input("mother_phone");
        $newPatientRecord->father_name = $request->input("father_name");
        $newPatientRecord->father_phone = $request->input("father_phone");
        $history = $request->input("history");
        $orders = $request->input("orders");

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


        return view('admin.viewRecord', ['patient' => $patient]);
    }

    public function storeObgyne(Patient $patient, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email'  => 'required',
           
        ]);

     
        $newObgyne = new Obgyne();
        $newObgyne->patient_id = $patient->id;
        $newObgyne->type = $request->input("type");
        $newObgyne->age = $request->input("age");
        $newObgyne->civil_status = $request->input("civil_status");
        $newObgyne->address = $request->input("address");
        $newObgyne->contact_number = $request->input("contact_number");
        $newObgyne->occupation = $request->input("occupation");
        $newObgyne->religion = $request->input("religion");
        $newObgyne->referred_by = $request->input("referred_by");
        $newObgyne->emergency_contact_no = $request->input("emergency_contact_no");
        $newObgyne->save();

        $newHistory = new MedicalHistory();
        $newHistory->obgyne_id = $newObgyne->id;
        $newHistory->Hypertension = $request->input("Hypertension");
        $newHistory->Bronchial_Asthma = $request->input("Bronchial_Asthma");
        $newHistory->Thyroid_Disease = $request->input("Thyroid_Disease");
        $newHistory->Heart_Disease = $request->input("Heart_Disease");
        $newHistory->Previous_Surgery = $request->input("Previous_Surgery");
        $newHistory->Family_History = $request->input("Family_History");
        $newHistory->save();

        $newObgyneHistory = new ObgyneHistory();
        $newObgyneHistory->obgyne_id = $newObgyne->id;
        


        $newBaselineDiagnostics = new BaselineDiagnostics();
        $newBaselineDiagnostics->obgyne_id = $newObgyne->id;
        $newBaselineDiagnostics->CBC_HgB = $request->input("CBC_HgB");
        $newBaselineDiagnostics->plt = $request->input("plt");
        $newBaselineDiagnostics->DPT = $request->input("DPT");
        $newBaselineDiagnostics->Hct = $request->input("Hct");
        $newBaselineDiagnostics->WBC = $request->input("WBC");
        $newBaselineDiagnostics->Blood_Type = $request->input("Blood_Type");
        $newBaselineDiagnostics->FBS = $request->input("FBS");
        $newBaselineDiagnostics->HBsAg = $request->input("HBsAg");
        $newBaselineDiagnostics->VDRL = $request->input("VDRL");
        $newBaselineDiagnostics->HiV = $request->input("HiV");
        $newBaselineDiagnostics->TT = $request->input("TT");
        $newBaselineDiagnostics->Urinalysis = $request->input("Urinalysis");
        $newBaselineDiagnostics->Other = $request->input("Other");
        $newBaselineDiagnostics->save();

        return redirect(route('patient.patient_record_history'))->with('success', 'Added Successfully');
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
        if($patient->type == 'Pediatrics'){
            return view('admin.viewPediatrics', ['patient' => $patient]);
        }
        return view('admin.viewRecords');
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

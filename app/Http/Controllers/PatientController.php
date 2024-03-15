<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Models\patientRecord;
use App\Models\obgyne;
use App\Models\vaccine;
use App\Models\medicalHistory;
use App\Models\consultationPediatrics;
use Illuminate\Support\Facades\Auth;
use DOMDocument;

class PatientController extends Controller
{
    public function patientRecord(){
        $patients = Patient::all();
        return view('admin.patient-record', ['patients' => $patients]);
        
    }

    public function patient_record_history(){
        $patients = Patient::all();
        return view('admin.patient_record_history', ['patients' => $patients]);
        
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

    public function store(Patient $patient, Request $request){
        $patients = Patient::all();
        $user = Auth::user();
        $newPatientRecord = new patientRecord();
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


        $history = $request->history;

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
        $newConsultationPediatrics = new consultationPediatrics();
        
        $newConsultationPediatrics->patient_id = $patient->id;;
        $newConsultationPediatrics->dateTime = $request->dateTime;
        $newConsultationPediatrics->history = $history;
        $newConsultationPediatrics->orders = $request->orders;
        $newConsultationPediatrics->created_by = $user->name;
        $newConsultationPediatrics->save();


    

        return view('admin.viewRecord', ['patient' => $patient]);
    }

    public function storeObgyne(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email'  => 'required',
           
        ]);

        /*$newPatient = Patient::create($data);*/
        $newPatient = new patient();
        $newPatient->name = $request->input("name");
        $newPatient->email = $request->input("email");
        $newPatient->save();

        $newObgyne = new obgyne();
        $newObgyne->patient_id = $newPatient->id;
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

        $newHistory = new medicalHistory();
        $newHistory->obgyne_id = $newObgyne->id;
        $newHistory->history = json_decode($request->input("history"));
        $newHistory->save();

        

        return redirect(route('patient.patient-record'))->with('success', 'Added Successfully');
    }

    public function viewRecords(Patient $patient){
        /*$patients = Patient::with('patientRecord', 'obgyne')->get();
        return view('admin.viewRecord', ['patients' => $patients]);*/
        return view('admin.viewRecord', ['patient' => $patient]);

    }

    public function viewPediatrics($patient) {
        $patient = patientRecord::where('id', $patient)->get();
        if($patient[0]->type == 'Pediatrics'){
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
        $history = $request->history;

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
        
        

        $newConsultationPediatrics = new consultationPediatrics();
        
        $newConsultationPediatrics->patient_id = $request->input("patient_id");
        $newConsultationPediatrics->dateTime = $request->dateTime;
        $newConsultationPediatrics->history = $history;
        $newConsultationPediatrics->orders = $request->orders;
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

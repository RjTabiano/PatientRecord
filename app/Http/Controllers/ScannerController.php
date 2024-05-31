<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Aws\S3\S3Client; 
use Spatie\ActivityLog\Models\Activity;

class ScannerController extends Controller
{
    public function index() {



        return view('admin.ocr_scanner');

    }
    public function uploadImage($patient, Request $request)
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

        return view('admin.pediatrics', ['statusMsg' => $statusMsg], ['response' => $response], ['patient' => $patient]);
    }
}

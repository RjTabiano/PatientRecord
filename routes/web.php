<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\AnalyticsApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',  [HomeController::class, 'index'], function () {
    return view('welcome');
});

route::get('/services', [BookingController::class, 'services'])->middleware(['auth', 'verified'])->name('services');
route::get('/services/consultation', [BookingController::class, 'book_consultation'])->middleware(['auth', 'verified'])->name('bookConsultation');
route::get('/services/pediatrics', [BookingController::class, 'book_pediatrics'])->middleware(['auth', 'verified'])->name('bookPediatrics');
route::get('/services/obgyne', [BookingController::class, 'book_obgyne'])->middleware(['auth', 'verified'])->name('bookObgyne');
route::post('/services/storeBooking', [BookingController::class, 'store_booking'])->middleware(['auth', 'verified'])->name('storeBooking');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'admin'])->name('home');
route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/userInfo', [UserInfoController::class, 'user_info'])->middleware(['auth'])->name('userInfo');
Route::get('/myAppointment', [UserInfoController::class, 'get_appointment'])->middleware(['auth'])->name('myAppointment');
Route::get('/myPatientRecord', [UserInfoController::class, 'get_patientRecord'])->middleware(['auth'])->name('myPatientRecord');
Route::get('/myConsultationRecord', [UserInfoController::class, 'get_consultationRecord'])->middleware(['auth'])->name('myConsultationRecord');
Route::get('/myAppointment/{book}/cancelAppointment', [UserInfoController::class, 'cancel_myBooking'])->middleware(['auth'])->name('cancelAppointment');



Route::get('/feedback', [FeedbackController::class, 'feedback'])->middleware(['auth', 'admin'])->name('feedback');
Route::post('/feedback/storeFeedback', [FeedbackController::class, 'store_feedback'])->middleware(['auth', 'admin'])->name('storeFeedback');

Route::get('/audit', [AuditController::class, 'audit'])->middleware(['auth', 'admin'])->name('audit');

Route::get('/InactiveUsers', [PatientController::class, 'inactive_users'])->middleware(['auth', 'admin'])->name('inactiveUsers');
Route::get('/patientRecords', [PatientController::class, 'patient_record_history'])->middleware(['auth', 'admin'])->name('patient.patient_record_history');
Route::get('/searchUser', [PatientController::class, 'search_user'])->middleware(['auth', 'admin'])->name('searchUser');
Route::get('/patientRecords/{user}/inactive', [PatientController::class, 'move_inactive'])->middleware(['auth', 'admin'])->name('moveInactive');
Route::get('/patientRecords/{user}/active', [PatientController::class, 'move_active'])->middleware(['auth', 'admin'])->name('moveActive');



Route::get('/addConsultation', [PatientController::class, 'add_consultation'])->middleware(['auth', 'admin'])->name('patient.addConsultation');

Route::get('/patient/{patient}/pediatrics', [PatientController::class, 'createPediatrics'])->middleware(['auth', 'admin'])->name('patient.pediatrics');
Route::get('/patient/{patient}/obgyne', [PatientController::class, 'createObgyne'])->middleware(['auth', 'admin'])->name('patient.obgyne');
Route::put('/patient/{patient}/pediatrics/upload', [PatientController::class, 'uploadImagePedia'])->middleware(['auth', 'admin'])->name('scanner.uploadP');
Route::put('/patient/{patient}/obgyne/upload', [PatientController::class, 'uploadImageOb'])->middleware(['auth', 'admin'])->name('scanner.uploadO');
Route::post('/addPatientView/addPatient', [PatientController::class, 'add_patient'])->middleware(['auth', 'admin'])->name('addPatient');
Route::get('/addPatientView', [PatientController::class, 'add_patientView'])->middleware(['auth', 'admin'])->name('addPatientView');
Route::get('/AllPatientRecords', [PatientController::class, 'all_patient_records'])->middleware(['auth', 'admin'])->name('AllPatientRecords');
Route::get('/searchAll', [PatientController::class, 'all_search'])->middleware(['auth', 'admin'])->name('searchAll');


Route::post('/patient/{patient}/store', [PatientController::class, 'store'])->middleware(['auth', 'admin'])->name('patient.store');
Route::post('/patient/storePatients', [PatientController::class, 'store_patients'])->middleware(['auth', 'admin'])->name('patient.storePatients');
Route::post('/patient/{patient}/storeObgyne', [PatientController::class, 'storeObgyne'])->middleware(['auth', 'admin'])->name('patient.storeObgyne');
Route::get('/patient/{patient}/edit', [PatientController::class, 'edit'])->middleware(['auth', 'admin'])->name('patient.edit');
Route::get('/patient/{user}/viewRecords', [PatientController::class, 'viewRecords'])->middleware(['auth', 'admin'])->name('patient.viewRecords');
Route::get('/{patient}/viewPediatrics', [PatientController::class, 'viewPediatrics'])->middleware(['auth', 'admin'])->name('patient.viewPediatrics');
Route::get('/{patient}/viewObgyne', [PatientController::class, 'viewObgyne'])->middleware(['auth', 'admin'])->name('patient.viewObgyne');

Route::get('/patient/{patient}/update', [PatientController::class, 'update'])->middleware(['auth', 'admin'])->name('patient.update');
Route::put('/patient/{patient}/updatePatient', [PatientController::class, 'update_patient'])->middleware(['auth', 'admin'])->name('patient.updatePatient');
Route::put('/patient/{patient}/updateObgyne', [PatientController::class, 'update_obgyne'])->middleware(['auth', 'admin'])->name('patient.updateObgyne');
Route::put('/patient/{patient}/updatePediatrics', [PatientController::class, 'update_pediatrics'])->middleware(['auth', 'admin'])->name('patient.updatePediatrics');
Route::delete('/patient/{patient}/delete', [PatientController::class, 'delete'])->middleware(['auth', 'admin'])->name('patient.delete');

Route::post('/patient/createConsultation', [PatientController::class, 'create_consultation'])->middleware(['auth', 'admin'])->name('patient.createConsultation');
Route::get('/patient/Consultations', [PatientController::class, 'consultations'])->middleware(['auth', 'admin'])->name('patient.consultations');
Route::get('/patient/show/{id}', [PatientController::class, 'show_consultationRecord'])->middleware(['auth', 'admin'])->name('patient.show_consultationRecord');
Route::get('/patient/{consultationPediatrics}/edit_consultationRecord', [PatientController::class, 'edit_consultationRecord'])->middleware(['auth', 'admin'])->name('patient.edit_consultationRecord');
Route::post('/patient/{consultationPediatrics}/update_consultationRecord', [PatientController::class, 'update_consultationRecord'])->middleware(['auth', 'admin'])->name('patient.update_consultationRecord');
Route::delete('/patient/{consultationPediatrics}/deleteConsultation', [PatientController::class, 'delete_consultation'])->middleware(['auth', 'admin'])->name('patient.deleteConsultation');


Route::get('/doctor', [DoctorController::class, 'doctors'])->middleware(['auth', 'admin'])->name('doctor.doctor');
Route::post('/doctor/storeDoctor', [DoctorController::class, 'store_doctor'])->middleware(['auth', 'admin'])->name('doctor.storeDoctor');
Route::delete('/doctor/{doctor}/deleteDoctor', [DoctorController::class, 'delete_doctor'])->middleware(['auth', 'admin'])->name('doctor.deleteDoctor');
Route::post('/doctor/{doctor}/updateDoctor', [DoctorController::class, 'update_doctor'])->middleware(['auth', 'admin'])->name('doctor.updateDoctor');
Route::get('/doctor/{doctor}/editDoctor', [DoctorController::class, 'edit_doctor'])->middleware(['auth', 'admin'])->name('doctor.editDoctor');

Route::get('/accounts', [AccountController::class, 'accounts'])->middleware(['auth', 'admin'])->name('accounts');
Route::delete('/accounts/{account}/deleteAccount', [AccountController::class, 'delete_account'])->middleware(['auth', 'admin'])->name('deleteAccount');
Route::get('/searchAccount', [AccountController::class, 'search_account'])->middleware(['auth', 'admin'])->name('searchAccount');


Route::get('/staff', [StaffController::class, 'staffs'])->middleware(['auth', 'admin'])->name('staff.staff');
Route::post('/staff/storeStaff', [StaffController::class, 'store_staff'])->middleware(['auth', 'admin'])->name('staff.storeStaff');
Route::post('/staff/{staff}/updateStaff', [StaffController::class, 'update_staff'])->middleware(['auth', 'admin'])->name('staff.updateStaff');
Route::get('/staff/{staff}/editStaff', [StaffController::class, 'edit_staff'])->middleware(['auth', 'admin'])->name('staff.editStaff');
Route::delete('/staff/{staff}/deleteStaff', [StaffController::class, 'delete_staff'])->middleware(['auth', 'admin'])->name('staff.deleteStaff');

Route::get('/appointment', [AppointmentController::class, 'appointments'])->middleware(['auth', 'admin'])->name('appointment.appointment');
Route::post('/appointment/storeAppointment', [AppointmentController::class, 'store_appointment'])->middleware(['auth', 'admin'])->name('appointment.storeAppointment');
Route::delete('/appointment/{appointment}/deleteAppointment', [AppointmentController::class, 'delete_appointment'])->middleware(['auth', 'admin'])->name('appointment.deleteAppointment');
Route::get('/appointment/{appointment}/editAppointment', [AppointmentController::class, 'edit_appointment'])->middleware(['auth', 'admin'])->name('appointment.editAppointment');
Route::post('/appointment/{appointment}/updateAppointment', [AppointmentController::class, 'update_appointment'])->middleware(['auth', 'admin'])->name('appointment.updateAppointment');




Route::get('/schedule', [ScheduleController::class, 'schedules'])->middleware(['auth', 'admin'])->name('schedule.schedule');
Route::post('/schedule/storeSchedule', [ScheduleController::class, 'store_schedule'])->middleware(['auth', 'admin'])->name('schedule.storeSchedule');
Route::delete('/schedule/{schedule}/deleteSchedule', [ScheduleController::class, 'delete_schedule'])->middleware(['auth', 'admin'])->name('schedule.deleteSchedule');
Route::get('/schedule/{schedule}/editSchedule', [ScheduleController::class, 'edit_schedule'])->middleware(['auth', 'admin'])->name('schedule.editSchedule');
Route::post('/schedule/{schedule}/updateSchedule', [ScheduleController::class, 'update_schedule'])->middleware(['auth', 'admin'])->name('schedule.updateSchedule');

route::get('/booking', [BookingController::class, 'view_booking'])->middleware(['auth', 'admin'])->name('viewBooking');
route::get('/booking/{booking}/confirmBooking', [BookingController::class, 'confirm_booking'])->middleware(['auth', 'admin'])->name('confirmBooking');
route::get('/searchBooking', [BookingController::class, 'search_booking'])->middleware(['auth', 'admin'])->name('searchBooking');


Route::get('/scanner', [ScannerController::class, 'index'])->middleware(['auth', 'admin'])->name('scanner');


Route::get('/analytics-report', [AnalyticsApiController::class, 'report'])->middleware(['auth', 'admin'])->name('report');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';

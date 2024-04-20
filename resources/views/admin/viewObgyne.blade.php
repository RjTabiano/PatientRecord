<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    
   <title>The Queen's Clinic</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
</head> 
<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="{{route('home')}}">
                        <span class="icon">
                            <ion-icon name="medkit-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Panel</span>
                    </a>
                </li>
                @can('admin')
                <li>
                    <a href="{{route('accounts')}}">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Accounts</span>
                    </a>
                </li>
                @endcan

                <li>
                    <a href="{{route('patient.patient_record_history')}}">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Add Patient Accounts</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('patient.consultations')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Consultation Records</span>
                    </a>
                </li>
                @cannot('doctor')
                <li>
                    <a href="{{route('appointment.appointment')}}">
                        <span class="icon">
                            <ion-icon name="bookmark-outline"></ion-icon>
                        </span>
                        <span class="title">Appointment</span>
                    </a>
                </li>
                @endcannot
                @cannot('doctor')
                <li>
                    <a href="{{route('viewBooking')}}">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Patient's Schedule</span>
                    </a>
                </li>
                @endcannot
                @cannot('staff')
                <li>
                    <a href="{{route('schedule.schedule')}}">
                        <span class="icon">
                            <ion-icon name="calendar-number-outline"></ion-icon>
                        </span>
                        <span class="title">Doctor's Schedule</span>
                    </a>
                </li>
                @endcannot
                <li>
                    <a href="{{route('feedback')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Feedback</span>
                    </a>
                </li>
                @can('admin')
                <li>
                    <a href="{{route('audit')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Audit Trail</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('inactiveUsers')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">Inactive Archive</span>
                    </a>
                </li>
                @endcan
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" class="nav-link" 
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Logout</span>
                    </a>
                    </form>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="user">
                    
                </div>

        </div>
    <!-- =========== CONTAINER =========  -->
    <div class="patient-view">
    <h1 class="h1-print">Patient Information</h1>

        <div class="PediaView">
                <div class="grid-input ">
                    <label>&nbspType</label>
                    <input class="input-readonly" value="{{ $patient->type }}" readonly />
                </div>
                <div class="grid-input ">
                    <label>&nbspName</label>
                    <input class="input-readonly" value="{{ $patient->birthdate }}" readonly />
                </div>
                <div class="grid-input">
                    <label >&nbspBirth Date</label>
                    <input class="input-readonly" type="date" value="{{ $patient->age }}" readonly/>
                </div>
                <div class="grid-input">
                    <label  >&nbspCivil Status</label>
                    <input class="input-readonly" value="{{ $patient->civil_status }}" readonly /><br>
                </div>
                <div class="grid-input">
                    <label  >&nbspAddress</label>
                    <input class="input-readonly" value="{{ $patient->address }}" readonly /><br>
                </div>
                <div class="grid-input">
                    <label >&nbspContact Number</label>
                    <input class="input-readonly" value="{{ $patient->contact_number }}" readonly />
                </div>
                <div class="grid-input">
                    <label>&nbspOccupation</label>
                    <input class="input-readonly" value="{{ $patient->occupation }}" readonly />
                </div>
                <div class="grid-input">
                    <label>&nbspReligion</label>
                    <input class="input-readonly" value="{{ $patient->religion }}" readonly />
                </div>
                <div class="grid-input">
                    <label>&nbspReferred by</label>
                    <input class="input-readonly" value="{{ $patient->referred_by }}" readonly />
                </div>
                <div class="grid-input">
                    <label>&nbspEmergency Contact Number</label>
                    <input class="input-readonly" value="{{ $patient->emergency_contact_no }}" readonly />
                </div>

                <!-- ======= Medical History ========= -->  
                @if($patient->MedicalHistory)
                    <div class="grid-input span-2">
                        <h1 class="">Medical History</h1>
                    </div>


                    <div class="grid-input">
                    <label>Medical History</label>
                        @foreach($patient->MedicalHistory as $medHistory)
                        <input class="input-readonly" value="{{ $medHistory->Hypertension }} {{ $medHistory->Thyroid_disease }} {{ $medHistory->Allergy }}" readonly />
                        @endforeach
                    </div>
                

                    <div class="grid-input">
                        <label>Social History</label>
                            @foreach($patient->MedicalHistory as $medHistory)
                            <input class="input-readonly" value="{{ $medHistory->social_history }}" readonly />
                            @endforeach
                    </div>

                    <div class="grid-input">
                        <label>Family History</label>
                            @foreach($patient->MedicalHistory as $medHistory)
                            <input class="input-readonly" value="{{ $medHistory->Family_History }}" readonly />
                            @endforeach
                    </div>
                @else
                @endif


                <!-- ======= Baseline Diagnostics ========= -->     
                
            
                
                @if($patient->BaselineDiagnostics)
                <div class="grid-input span-2">
                    <h1 class="">Baseline Diagnostics</h1>
                </div>

                    @foreach($patient->BaselineDiagnostics as $diag)
                        <div class="grid-input">
                            <label>Blood Type</label>
                            <input class="input-readonly" value="{{ $diag->blood_type }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>FBS</label>
                            <input class="input-readonly" value="{{ $diag->FBS }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Hgb</label>
                            <input class="input-readonly" value="{{ $diag->Hgb }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Hct</label>
                            <input class="input-readonly" value="{{ $diag->Hct }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>WBC</label>
                            <input class="input-readonly" value="{{ $diag->WBC }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Platelet</label>
                            <input class="input-readonly" value="{{ $diag->Platelet }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>HIV</label>
                            <input class="input-readonly" value="{{ $diag->HIV }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>First Hr</label>
                            <input class="input-readonly" value="{{ $diag->first_hr }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Second Hr</label>
                            <input class="input-readonly" value="{{ $diag->second_hr }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>HBsAg</label>
                            <input class="input-readonly" value="{{ $diag->HBsAg }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>RPR</label>
                            <input class="input-readonly" value="{{ $diag->RPR }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Protein</label>
                            <input class="input-readonly" value="{{ $diag->protein }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Sugar</label>
                            <input class="input-readonly" value="{{ $diag->sugar }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>LMP</label>
                            <input class="input-readonly" value="{{ $diag->LMP }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>PMP</label>
                            <input class="input-readonly" value="{{ $diag->PMP }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>AOG</label>
                            <input class="input-readonly" value="{{ $diag->AOG }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>EDD</label>
                            <input class="input-readonly" value="{{ $diag->EDD }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Early Ultrasound</label>
                            <input class="input-readonly" value="{{ $diag->early_ultrasound }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>AOG By EUTZ</label>
                            <input class="input-readonly" value="{{ $diag->AOG_by_eutz }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>EDD By EUTZ</label>
                            <input class="input-readonly" value="{{ $diag->EDD_by_eutz }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Other</label>
                            <input class="input-readonly" value="{{ $diag->Other }}" readonly />
                        </div>
                    @endforeach
                @else
                    
                @endif

                <!-- ======= Obgyne History ========= -->  
                @if($patient->ObgyneHistory)
                    <div class="grid-input span-2">
                        <h1 class="">Obgyne History</h1>
                    </div>
                    @foreach($patient->ObgyneHistory as $obHistory)
                        <div class="grid-input">
                            <label>Gravidity</label>
                            <input class="input-readonly" value="{{ $obHistory->gravidity }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Parity</label>
                            <input class="input-readonly" value="{{ $obHistory->parity }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>OB Score</label>
                            <input class="input-readonly" value="{{ $obHistory->OB_score }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>Table</label>
                            <input class="input-readonly" value="{{ $obHistory->table }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>M</label>
                            <input class="input-readonly" value="{{ $obHistory->M }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>I</label>
                            <input class="input-readonly" value="{{ $obHistory->I }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>D</label>
                            <input class="input-readonly" value="{{ $obHistory->D }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>A</label>
                            <input class="input-readonly" value="{{ $obHistory->A }}" readonly />
                        </div>
                        <div class="grid-input">
                            <label>S</label>
                            <input class="input-readonly" value="{{ $obHistory->S }}" readonly />
                        </div>
                    @endforeach

                @else
                @endif
        </div>

    </div>

  
<div class="containeer">
        <button id="publishButton" data-patient-id="{{ $patient->patient_id }}" class="custom-button">Publish</button>
        <button id="printButton" class="custom-button">Print</button>
    </div>

    <section class="overlay"></section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        document.getElementById('publishButton').addEventListener('click', function() {
            var patientId = this.getAttribute('data-patient-id');
            
            html2canvas(document.querySelector(".patient-view")).then(canvas => {
                var imageData = canvas.toDataURL();
                console.log(canvas);
                sendDataToBackend(imageData, patientId);
                console.log(imageData);
            });
            
        });
        

        function sendDataToBackend(imageData, patientId) {
            fetch('/api/store-image', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken,
                },
                body: JSON.stringify({ 
                  imageData: imageData,
                  patientId: patientId
                }),
            })
            .then(response => {
                if (response.ok) {
                    console.log('Image data sent successfully');
                } else {
                    console.error('Failed to send image data to the backend');
                }
            })
            .catch(error => {
                console.error('Error occurred while sending image data:', error);
            });
        }
    </script>
    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            var patientView = document.querySelector('.patient-view');

            html2canvas(patientView).then(function(canvas) {
                var imageData = canvas.toDataURL('image/png');

                var downloadLink = document.createElement('a');
                downloadLink.href = imageData;
                downloadLink.download = 'patient_info.png';

                downloadLink.click();
            });
        });
    </script>

    <!-- ============ CONTAINER ==========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
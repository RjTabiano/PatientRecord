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
                

                @foreach($patient->MedicalHistory as $x)
                    @if($x)
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
                    @endif
                @endif
                @endforeach

                <!-- ======= Baseline Diagnostics ========= -->     
                @foreach($patient->BaselineDiagnostics as $x)
                    @if($x)
                        @if($patient->BaselineDiagnostics)
                        <div class="grid-input span-2">
                            <h1 class="">Baseline Diagnostics</h1>
                        </div>

                        @foreach($patient->BaselineDiagnostics as $diag)
                            @foreach($diag->getAttributes() as $column => $value)
                                <div class="grid-input">
                                    <label>{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                                    <input class="input-readonly" value="{{ $value }}" readonly />
                                </div>
                            @endforeach
                        @endforeach
                        @endif
                    @endif
                @endforeach
                <!-- ======= Obgyne History ========= -->  
                @if($patient->ObgyneHistory)
                    <div class="grid-input span-2">
                        <h1 class="">Obgyne History</h1>
                    </div>
                    @foreach($patient->ObgyneHistory as $obHistory)
                        @foreach($obHistory->getAttributes() as $column => $value)
                            <div class="grid-input">
                                <label>{{ ucfirst($column) }}</label>
                                <input class="input-readonly" value="{{ $value }}" readonly />
                            </div>
                        @endforeach
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
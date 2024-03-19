<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />
    
   <title>The Queen's</title>
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

                <li>
                    <a href="{{route('home')}}">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Home</span>
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
                    <a href="{{route('scanner')}}">
                        <span class="icon">
                        <ion-icon name="scan-circle-outline"></ion-icon>
                        </span>
                        <span class="title">OCR Scanner</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('patient.patient_record_history')}}">
                        <span class="icon">
                            <ion-icon name="newspaper-outline"></ion-icon>
                        </span>
                        <span class="title">Patient Records</span>
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
                        <span class="title">Booking</span>
                    </a>
                </li>
                @endcannot
                @cannot('staff')
                <li>
                    <a href="{{route('schedule.schedule')}}">
                        <span class="icon">
                            <ion-icon name="calendar-number-outline"></ion-icon>
                        </span>
                        <span class="title">Schedule</span>
                    </a>
                </li>
                @endcannot
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" class="nav-link" 
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
                        <span class="icon"><ion-icon name="bx bx-log-out icon"></ion-icon></span>
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

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    
                </div>

        </div>


    <!-- =========== CONTAINER =========  -->
    <div class="patient-view">
                                    <h1>Patient Information</h1>
                                    <div class="info-box">
                                        <label>Type:</label>
                                        <span>{{ $patient->type }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Birth Date:</label>
                                        <span>{{ $patient->birthdate }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Age:</label>
                                        <span>{{ $patient->age }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Gender:</label>
                                        <span>{{ $patient->sex }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Address:</label>
                                        <span>{{ $patient->address }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Mother's Name:</label>
                                        <span>{{ $patient->mother_name }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Mother's Phone Number:</label>
                                        <span>{{ $patient->mother_phone }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Father's Name:</label>
                                        <span>{{ $patient->father_name }}</span>
                                    </div>
                                    <div class="info-box">
                                        <label>Father's Phone Number:</label>
                                        <span>{{ $patient->father_phone }}</span>
                                    </div>
                                    @if($patient->Vaccine->isNotEmpty())
                                        <div class="info-box">
                                            <label>Vaccines:</label>
                                            <ul>
                                                @foreach($patient->Vaccine as $vaccine)
                                                    <li>{{ $vaccine }} </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="info-box">
                                        <label>P.E./History:</label>
                                        <span></span>
                                    </div>
                                    <div class="info-box">
                                        <label>Orders:</label>
                                        <span></span>
                                    </div>
                                </div>
                                <button id="publishButton" data-patient-id="{{ $patient->patient_id }}">Publish</button>
    <section class="overlay"></section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        document.getElementById('publishButton').addEventListener('click', function() {
            var patientId = this.getAttribute('data-patient-id');
            
            html2canvas(document.querySelector(".container")).then(canvas => {
                var imageData = canvas.toDataURL();
                sendDataToBackend(imageData, patientId);
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



    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
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
                    <input class="input-readonly" value="{{ $patient->first_name }} {{ $patient->last_name }}" readonly />
                </div>
                <div class="grid-input">
                    <label >&nbspBirth Date</label>
                    <input class="input-readonly" type="date" value="{{ $patient->birthdate }}" readonly/>
                </div>
                <div class="grid-input">
                    <label  >&nbspSex</label>
                    <input class="input-readonly" value="{{ $patient->sex }}" readonly /><br>
                </div>
                <div class="grid-input">
                    <label  >&nbspAddress</label>
                    <input class="input-readonly" value="{{ $patient->address }}" readonly /><br>
                </div>
                <div class="grid-input">
                    <label >&nbspMother's Name (Last Name, First Name)</label>
                    <input class="input-readonly" value="{{ $patient->mother_name }}" readonly />
                </div>
                <div class="grid-input">
                    <label>&nbspMother's Phone Number</label>
                    <input class="input-readonly" value="{{ $patient->mother_phone }}" readonly />
                </div>
                <div class="grid-input">
                    <label>&nbspFather's Name (Last Name, First Name)</label>
                    <input class="input-readonly" value="{{ $patient->father_name }}" readonly />
                </div>
                <div class="grid-input">
                    <label>&nbspFather's Phone Number</label>
                    <input class="input-readonly" value="{{ $patient->father_phone }}" readonly />
                </div>

                
                <table class="vaccine_table span-2">
                <tr>
                    <th>Vaccine</th>
                    <th>Dose</th>
                </tr>
                <tr>
                    <td class="firstTD">BCG</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->BCG)
                            @foreach($vaccines->BCG as $BCG)
                            {{$BCG}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Hepatitis B:</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Hepatitis_B)
                            @foreach($vaccines->Hepatitis_B as $Hepatitis_B)
                            {{$Hepatitis_B}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">DPT</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->DPT)
                            @foreach($vaccines->DPT as $DPT)
                            {{$DPT}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Polio-OPU</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Polio_OPU)
                            @foreach($vaccines->Polio_OPU as $Polio_OPU)
                            {{$Polio_OPU}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Polio-IPU</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Polio_IPU)
                            @foreach($vaccines->Polio_IPU as $Polio_IPU)
                                {{$Polio_IPU}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">HiB</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->HiB)
                            @foreach($vaccines->HiB as $HiB)
                            {{$HiB}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">PCV</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->PCV)
                            @foreach($vaccines->PCV as $PCV)
                            {{$PCV}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Measles</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Measles)
                            @foreach($vaccines->Measles as $Measles)
                            {{$Measles}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Varicella</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Varicella)
                            @foreach($vaccines->Varicella as $Varicella)
                            {{$Varicella}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">mmra</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->mmra)
                            @foreach($vaccines->mmra as $mmra)
                            {{$mmra}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Hepatitis A</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Hepatitis_A)
                            @foreach($vaccines->Hepatitis_A as $Hepatitis_A)
                            {{$Hepatitis_A}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Meningo</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Meningo)
                            @foreach($vaccines->Meningo as $Meningo)
                            {{$Meningo}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Typhoid</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Typhoid)
                            @foreach($vaccines->Typhoid as $Typhoid)
                            {{$Typhoid}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Jap. Enceph</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Jap_Enceph)
                            @foreach($vaccines->Jap_Enceph as $Jap_Enceph)
                            {{$Jap_Enceph}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">HPV</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->HPV)
                            @foreach($vaccines->HPV as $HPV)
                            {{$HPV}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <td class="firstTD">Flu</td>
                    <td class="secondTD">
                    @foreach($bcgVaccine as $vaccines)
                        @if($vaccines->Flu)
                            @foreach($vaccines->Flu as $Flu)
                            {{$Flu}}
                            @endforeach
                        @endif
                    @endforeach
                    </td>
                </tr>
                </table>

                <div class="grid-input span-2">
                <label>P.E./History</label>
                <textarea  readonly>{{ $patient->history }}</textarea>
                </div>
                <div class="grid-input span-2">
                <label>Orders</label>
                <textarea readonly>{{ $patient->orders }}</textarea>
                </div>

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
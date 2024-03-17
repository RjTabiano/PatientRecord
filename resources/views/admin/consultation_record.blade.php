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
                    <a href="{{route('patient.patient-record')}}">
                        <span class="icon">
                            <ion-icon name="medkit-outline"></ion-icon>
                        </span>
                        <span class="title">Admin Panel</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('patient.patient-record')}}">
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
                            <ion-icon name="people-outline"></ion-icon>
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

    <h1 class="heading">Patient Consultation Records</h1>
        <a href="{{route('patient.addConsultation')}}" class="btn btn-md btn-primary">Add Consultation Record</a>
        <hr>

        <table >
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created By</th>
                </tr>
            </thead>
            <tbody>
                @foreach($consultationPediatrics as $consultationPediatric)
                <tr>
                    @foreach($patients as $patient)
                    <th scope="row">{{$patient->name}}</th>
                    @endforeach
                    <td>{{$consultationPediatric->created_by}}</td>
                    <td>
                        <a href="/patient/show/{{$consultationPediatric->id}}" class="btn btn-sucess">Show</a>
                        <a href="{{route('patient.edit_consultationRecord', ['consultationPediatrics' => $consultationPediatric], ['patient' => $patient])}}" class="btn btn-info">Edit</a>
                        <button  type="button" data-toggle="modal" data-target="#deletePatient" class="btn btn-danger">
                        Delete
                         </button>
                        <!-- DELETE Modal -->
                        <div class="modal" id="myModal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <form method="post" action="{{route('patient.deleteConsultation', ['consultationPediatrics' => $consultationPediatric])}}" class="form">
                                    @csrf
                                    @method('delete')
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" valaue="Delete" class="btn btn-primary">Delete Patient</button>
                                </div>
                                </form>
                        </div>
                        </div>
        <!-- END DELETE MODAL -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    <!-- =========== END CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
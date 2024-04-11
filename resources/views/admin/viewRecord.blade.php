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
    <!-- ================= Navigation ================ -->
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
                    <a href="{{route('feedback')}}">
                        <span class="icon">
                            <ion-icon name="folder-open-outline"></ion-icon>
                        </span>
                        <span class="title">feedback</span>
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
                @endcan
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{route('logout')}}" class="nav-link" 
                    onclick="event.preventDefault();
                            this.closest('form').submit();">
                            
                        <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        
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
    <header class="heading">Patient Records</header>
        @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Add Patient Record
            </button>
            
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('patient.pediatrics', ['patient' => $patient])}}">Pediatrics</a>
                <a class="dropdown-item" href="{{route('patient.obgyne', ['patient' => $patient])}}">Obgyne</a>
            </div>
        </div>
        <div class="table-wrapper">  
            
            <table>
                <thead>
                <tr>
                    <th>Record</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody style="height: 200x; overflow-y: scroll;">
                    <div style="height: auto; width: 100%;">
                        @foreach ($patient->patientRecord as $patientRecords)
                        <tr>
                            <td>{{$patientRecords['type']}}</td>
                            <td>{{$patient->name}}</td>
                            <td>{{$patient->email}}</td>
                            <td>
                                <a href="{{route('patient.viewPediatrics', ['patient' => $patientRecords['id']])}}">View</a>
                            </td>
                            <td>
                                <a href="{{route('patient.update', ['patient' => $patient])}}">Edit</a>
                            </td>
                            @can('admin')
                            <td>
                                <form class="cancelForm" method="post" action="{{route('patient.delete', ['patient' => $patient])}}">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" value="Delete" class="save1">Delete</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>
    </div>
    <!-- =========== CONTAINER =========  -->
    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>
    <!-- ====== ionicons ======= -->
    <script>
  
    document.querySelectorAll(".cancelForm").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var confirmation = confirm("Are you sure you want to delete this record?");
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });
</script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
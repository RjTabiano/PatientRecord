<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
                <div class="search">
                    <form action="{{ route('searchAll') }}" method="GET">
                        <label>
                            <input type="text" name="search" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </form>
                </div>
                <div class="user">
                </div>
        </div> 


    <!-- =========== CONTAINER =========  -->
    <br>
    <header>
      <h3>Patient Records</h3>
    </header>
    <br>
    <div class="table-wrapper" style="height: 700px; overflow: auto">  
            
            <table style="box-shadow: 5px 10px 8px 10px rgba(0,0,0,0.2);">
                <thead class="fixed">
                <tr>
                    <th>Record</th>
                    <th>Full Name</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
                </thead>
                <tbody >
                    <div >
                    @foreach ($obgyneRecords as $obgyneRecord)
                        <tr>
                            <td>{{$obgyneRecord->type}}</td>
                            <td>{{$obgyneRecord->first_name}}, {{$obgyneRecord->last_name}}</td>
                            <td></td>
                            <td></td>
                            
                            <td>
                                <a href="{{route('patient.viewObgyne', ['patient' => $obgyneRecord->id])}}"class="btn btn-sucess"><ion-icon name="eye-sharp"></ion-icon></a>
                            </td>
                            <td>
                                <a href=""class="btn btn-info"><ion-icon name="create-outline"></ion-icon></a>
                            </td>
                            @can('admin')
                            <td>
                                <form class="cancelForm" method="post" action="">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" value="Delete" class="save1"><ion-icon name="trash-outline"></ion-icon></button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                        @foreach ($pediatricsRecords as $pediatricsRecord)
                        <tr>
                            <td>{{$pediatricsRecord->type}}</td>
                            <td>{{$pediatricsRecord->first_name}}, {{$pediatricsRecord->last_name}}</td>
                            <td></td>
                            <td></td>
                            
                            <td>
                                <a href="{{route('patient.viewObgyne', ['patient' => $pediatricsRecord->id])}}"class="btn btn-sucess"><ion-icon name="eye-sharp"></ion-icon></a>
                            </td>
                            <td>
                                <a href=""class="btn btn-info"><ion-icon name="create-outline"></ion-icon></a>
                            </td>
                            @can('admin')
                            <td>
                                <form class="cancelForm" method="post" action="">
                                    @csrf
                                    @method('delete')

                                    <button type="submit" value="Delete" class="save1"><ion-icon name="trash-outline"></ion-icon></button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>
    </div>

    <!-- ======================================================== CONTAINER  ========================================  -->


    <!-- ========================================================  Scripts   ========================================  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ========================================================  ionicons  ==========================================-->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="" href="{{ asset('images/logocircle.png') }}" />

    <title>The Queen's</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                    <form action="{{ route('searchAccount') }}" method="GET">
                        <label>
                            <input type="text" name="search" placeholder="Search here">
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </form>
                </div>
                <div class="user">
                </div>

        </div>
        <h1 class="heading">Accounts</h1>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false">
                        Add Account
                   </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('staff.staff')}}">Staff</a>
                        <a class="dropdown-item" href="{{route('doctor.doctor')}}">Doctor</a>
                    </div>
                </div>
                <div class="table_container">
                    <div class="row">
                        <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Account Type</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($accounts as $account)                         
                            <tr>
                                <td>{{$account->name}}</td>
                                <td>{{$account->email}}</td>
                                <td>{{$account->usertype}}</td>
                                <td>
                               
                                    <form class="cancelForm" method="post" action="{{route('deleteAccount', ['account' => $account])}}" >
                                            @csrf
                                            @method('delete')
                                        
                                            <button class="save1" type="submit" valaue="Delete" class="btn btn-primary">Delete</button>
                                        </form>
                              
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        
    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>
    <script>
  

    document.querySelectorAll(".cancelForm").forEach(function(form) {
        form.addEventListener("submit", function(event) {
            var confirmation = confirm("Are you sure you want to deleete this user?");
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });
</script>
    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
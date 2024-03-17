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
    <h1 class="heading">Booking List</h1>
    <br>
    <div class="table_container">
        <div class="row">
            <div class="col-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Service</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Confirmation</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    
                @foreach($booking as $book)
                    @foreach($book->booking as $booked)                    
                <tr>
                    <td>{{$book->name}}</td>
                    <td>{{$booked->service}}</td>
                    <td>{{$booked->date}}</td>
                    <td>{{$booked->time}}</td>
                    <td>{{$booked->status}}</td>
                    @if($booked->status == "Unconfirmed" || $booked->status == "Cancelled")
                    <td>
                    <button class="but1"onclick="openModal()">
                        Confirm
                    </button>
                    <!-- =========== CONFIRM MODAL  =========  -->
                    <div class="modal" id="myModal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                            <h1>Confirm Booking?</h1>
                            <form method="put" action="{{route('confirmBooking', ['booking' => $booked])}}">
                                @csrf
                                <input type="hidden" name="status" value="Confirmed"></input>
                                <button class="save1" type="submit">Save</button>
                            </form>
                    </div>
                    </div>
                    <!-- =========== END CONFIRM MODAL  =========  -->
                    </td>
                    @else
                    <td>
                    <button class="uncon1"onclick="openModal()">
                        Unconfirmed
                    </button>
                    <!-- =========== CONFIRM MODAL  =========  -->
                    <div class="modal" id="myModal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                            <h1>Unconfirm Booking?</h1>
                            <form method="put" action="{{route('confirmBooking', ['booking' => $booked])}}">
                                @csrf
                                <input type="hidden" name="status" value="Unconfirmed"></input>
                                <button class="save1" type="submit">Save</button>
                            </form>
                    </div>
                    </div>
                    <!-- =========== END CONFIRM MODAL  =========  -->
                    </td>
                    @endif
                    <td>
                    @if($booked->status != "Cancelled")
                                        <button class="can1"onclick="openModal2()">Cancel</button>
                                        <!-- =========== CANCEL MODAL  =========  -->
                                        <div class="modal2" id="myModal2">
                                            <div class="modal2-content2">
                                                <span class="close2" onclick="closeModal2()">&times;</span>
                                                <h1>Cancel Booking?</h1>
                                                <form method="put" action="{{route('confirmBooking', ['booking' => $booked])}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="Cancelled">
                                                    <button class="save1" type="submit">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- =========== END CANCEL MODAL  =========  -->
                    @endif
                    </tr>
                    @endforeach
                @endforeach
                </tbody>

            </table>

    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
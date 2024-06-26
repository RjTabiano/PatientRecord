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
                        <span class="title active">Add Patient Accounts</span>
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

        <form method="GET" action="{{ route('patient.viewRecords', ['user' => $patient->user_id]) }}" class="flex-form">
            <div>
                <label for="filter_type" class="sort-label" >Filter by Type:</label>
                <select name="filter_type" id="filter_type">
                    <option value="">Select Type</option>
                    <option value="1" {{ request('filter_type') == '1' ? 'selected' : '' }}>Pediatrics</option>
                    <option value="2" {{ request('filter_type') == '2' ? 'selected' : '' }}>Obgyne</option>
                </select>
            </div>
            <div>
                <label for="sort_field"  style="margin-left: 30px;" class="sort-label">Sort by:</label>
                <div class="flex-form">
                    <select name="sort_field" id="sort_field">
                        <option value="id" {{ request('sort_field') == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="type" {{ request('sort_field') == 'type' ? 'selected' : '' }}>Type</option>
                    </select>
                    <select name="sort_order" id="sort_order">
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>
                    <button type="submit" class="sort-button button-10">Apply</button>
                </div>     
            </div>
                
        </form>

        <div class="table-wrapper" style="height: 350px; overflow: auto; padding-bottom: 15px;">  
            <table style="box-shadow: 5px 10px 8px 10px rgba(0,0,0,0.2);">
                <thead class="fixed">
                <tr>
                    <th class="optimized-spacing-th">ID</th>
                    <th class="optimized-spacing-th">Type</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($records as $record)
                    <tr>
                        <td class="optimized-spacing-td">{{ $record->id }}</td>
                        <td class="optimized-spacing-td">{{ $record->type }}</td>
                        <td class="flex-button" >
                            @if ($record->type == 'Pediatrics')
                            <a href="{{ route('patient.viewPediatrics', ['patient' => $record->id]) }}" class="btn btn-sucess"><ion-icon name="eye-sharp"></ion-icon></a>
                            @elseif ($record->type == 'Obgyne')
                            <a href="{{ route('patient.viewObgyne', ['patient' => $record->id]) }}" class="btn btn-sucess"><ion-icon name="eye-sharp"></ion-icon></a>
                            @endif
                            <a href="{{ route('patient.update', ['patient' => $patient]) }}" class="btn btn-info"><ion-icon name="create-outline"></ion-icon></a>
                            @can('admin')
                            <form class="cancelForm" method="post" action="{{ route('patient.delete', ['patient' => $patient]) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" value="Delete" class="save1"><ion-icon name="trash-outline"></ion-icon></button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <!-- =========== CONTAINER ==========  -->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $('form').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function(response){
                    $('.table-wrapper').html($(response).find('.table-wrapper').html());
                },
                error: function(response){
                    alert('An error occurred while processing your request.');
                }
            });
        });
    });
    </script>
</body>

</html>
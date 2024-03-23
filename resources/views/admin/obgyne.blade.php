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
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    
                </div>

        </div>

    <!-- =========== CONTAINER =========  -->
    <header>OCR Scanner (Optional)</header>
    <form action="{{ route('scanner.uploadO', ['patient' => $patient]) }}" method="post" accept="image/*" enctype="multipart/form-data">
                @csrf
               @method('PUT')
                  <input type="file" class="form-control" name="image" accept="image/*">
                  <input type="submit" class="custom-button" name="submit" value="Upload">
              </form>
    <header>Obgyne Form</header>
      <form method="post" action="{{route('patient.storeObgyne' , ['patient' => $patient])}}" class="form">
        @csrf
        @method('post')
        <div class="input-box">
          <input type="hidden" name="type" value="Obgyne" />
          <label>Full Name</label>
          <input type="text" placeholder="Enter full name" name="name" value="<?php echo !empty($response["Patient's Name: (Surname, First Name, Middle Name)"]) ? $response["Patient's Name: (Surname, First Name, Middle Name)"] : ''; ?>" required />
        </div>

        <div class="input-box">
          <label>Email Address</label>
          <input type="text" placeholder="Enter email address" name="email" value="<?php echo !empty($response["Email:"]) ? $response["Email:"] : ''; ?>" required />
        </div>

        <div class="column">
          <div class="input-box">
            <label>Age</label>
            <input type="number" placeholder="Enter Age" name="age" value="<?php echo !empty($response["Age:"]) ? $response["Age:"] : ''; ?>" required />
          </div>
        <div class="gender-box">
          <h3>Civil Status</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="check-male" name="civil_status" value="female" <?php echo (!empty($response['Single']) && strtolower($response['Single']) === 'SELECTED') ? 'checked' : ''; ?> />
              <label for="check-male">Single</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="civil_status" <?php echo (!empty($response['Married']) && strtolower($response['Married']) === 'SELECTED') ? 'checked' : ''; ?> />
              <label for="check-female">Married</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="civil_status" <?php echo (!empty($response['Widowed']) && strtolower($response['Widowed']) === 'SELECTED') ? 'checked' : ''; ?> />
              <label for="check-female">Widowed</label>
            </div>
            <div class="gender">
              <input type="radio" id="check-female" name="civil_status" <?php echo (!empty($response['Separated']) && strtolower($response['Separated']) === 'SELECTED') ? 'checked' : ''; ?> />
              <label for="check-female">Separated</label>
            </div>
          </div>
        </div>
        </div>
        
        <div class="input-box address">
          <label class="form-control" >Address</label>
          <input class="form-control" type="text" placeholder="Enter address" name="address" value="<?php echo !empty($response['Address:']) ? $response['Address:'] : ''; ?>" required />
          <div class="input-box">
            <label class="form-control">Contact Number</label>
            <input class="form-control" type="number" placeholder="Enter contact number" name="contact_number" value="<?php echo !empty($response['Contact No.:']) ? $response['Contact No.:'] : ''; ?>" required />
          </div>
          <div class="input-box">
            <label class="form-control">Occupation</label>
            <input class="form-control" type="text" placeholder="Enter occupation" name="occupation" value="<?php echo !empty($response['Occupation:']) ? $response['Occupation:'] : ''; ?>" required />
          </div>
          <div class="input-box">
            <label class="form-control" >Religion</label>
            <input class="form-control" type="text" placeholder="Enter religion" name="religion" value="<?php echo !empty($response['Religion:']) ? $response['Religion:'] : ''; ?>" required />
          </div>
          <div class="input-box">
            <label class="form-control" >Referred by:</label>
            <input class="form-control" type="text" placeholder="Referred by:" name="referred_by" value="<?php echo !empty($response['Referred By:']) ? $response['Referred By:'] : ''; ?>" required />
          </div>
          <div class="input-box">
            <label class="form-control" >Emergency Contact Number: </label>
            <input class="form-control" type="number" placeholder="" name="emergency_contact_no" value="<?php echo !empty($response["Person to notify in case of Emergency / Contact No.:"]) ? $response["Person to notify in case of Emergency / Contact No.:"] : ''; ?>" required />
          </div>
        </div>
        <h2>Medical History</h2>

        <div class="form-group">
        <label for="Hypertension">Hypertension</label>
        <input type="checkbox" id="Hypertension" name="Hypertension" value="Hypertension" <?php echo (!empty($response['Hypertension']) && strtolower($response['Hypertension']) === 'SELECTED') ? 'checked' : ''; ?> >
    </div>
        <div class="form-group">
        <label for="Asthma">Asthma</label>
        <input type="checkbox" id="Hypertension" name="Asthma" value="Asthma" <?php echo (!empty($response['Hypertension']) && strtolower($response['Hypertension']) === 'SELECTED') ? 'checked' : ''; ?>>
    </div>

    <div class="form-group">
        <label for="Thyroid_disease">Thyroid Disease</label>
        <input type="checkbox" id="Bronchial_Asthma" name="Thyroid_disease" value="Thyroid Disease" <?php echo (!empty($response['Thyroid Disease']) && strtolower($response['Thyroid Disease']) === 'SELECTED') ? 'checked' : ''; ?> >
    </div>

    <div class="form-group">
        <label for="Allergy">Allergy</label>
        <input type="text" id="Thyroid_Disease" name="Allergy" value="<?php echo !empty($response['Allergy:']) ? $response['Allergy:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="social_history">Social History</label>
        <input type="text" id="Heart_Disease" name="social_history" >
    </div>

    <div class="form-group">
        <label for="Family_History">Family History</label>
        <input type="text" id="Previous_Surgery" name="Family_History" value="<?php echo !empty($response['Family History:']) ? $response['Family History:'] : ''; ?>">
    </div>

    <h2>Baseline Diagnostics</h2>
    <div class="form-group">
        <label for="date">date</label>
        <input type="date" id="CBC_HgB" name="date" value="<?php echo !empty($response['Date:']) ? $response['Date:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="blood_type">Blood Type</label>
        <input type="text" id="plt" name="blood_type" value="<?php echo !empty($response['Blood Type:']) ? $response['Blood Type:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="FBS">FBS</label>
        <input type="text" id="DPT" name="FBS" value="<?php echo !empty($response['FBS:']) ? $response['FBS:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="Hgb">Hct</label>
        <input type="text" id="Hct" name="Hgb" value="<?php echo !empty($response['Hgb:']) ? $response['Hgb:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="Hct">Hct</label>
        <input type="text" id="WBC" name="Hct" value="<?php echo !empty($response['Hct:']) ? $response['Hct:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="WBC">WBC</label>
        <input type="text" id="Blood_Type" name="WBC" value="<?php echo !empty($response['WBC:']) ? $response['WBC:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="Platelet">Platelet</label>
        <input type="text" id="FBS" name="Platelet" value="<?php echo !empty($response['FBS:']) ? $response['FBS:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="HIV">HIV</label>
        <input type="text" id="HBsAg" name="HIV" value="<?php echo !empty($response['HIV:']) ? $response['HIV:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="first_hr">1st hr</label>
        <input type="text" id="VDRL" name="first_hr" value="<?php echo !empty($response['1st hr.:']) ? $response['1st hr.:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="second_hr">2nd hr</label>
        <input type="text" id="HiV" name="second_hr" value="<?php echo !empty($response['2nd hr.:']) ? $response['2nd hr.:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="HBsAg">HBsAg</label>
        <input type="text" id="75g_OTT" name="HBsAg" value="<?php echo !empty($response['HBsAg:']) ? $response['HBsAg:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="RPR">RPR</label>
        <input type="text" id="Urinalysis" name="RPR" value="<?php echo !empty($response['RPR/VDRL']) ? $response['RPR/VDRL'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="protein">protein</label>
        <input type="text" id="Other" name="protein" value="<?php echo !empty($response['PROTEIN:']) ? $response['PROTEIN:'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="sugar">sugar</label>
        <input type="text" id="Other" name="sugar" value="<?php echo !empty($response['SUGAR:']) ? $response['SUGAR:'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="LMP">LMP</label>
        <input type="text" id="Other" name="LMP" value="<?php echo !empty($response['LMP:']) ? $response['LMP:'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="PMP">PMP</label>
        <input type="text" id="Other" name="PMP" value="<?php echo !empty($response['PMP:']) ? $response['PMP:'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="AOG">AOG</label>
        <input type="text" id="Other" name="AOG" value="<?php echo !empty($response['AOG:']) ? $response['AOG:'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="early_ultrasound">Early Ultrasound</label>
        <input type="text" id="Other" name="early_ultrasound" value="<?php echo !empty($response['ULTRASOUND']) ? $response['ULTRASOUND'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="AOG_by_eutz">AOG by eutz</label>
        <input type="text" id="Other" name="AOG_by_eutz" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="EDD_by_eutz">EDD by eutz</label>
        <input type="text" id="Other" name="EDD_by_eutz" value="<?php echo !empty($response['EDD by EUTZ:']) ? $response['EDD by EUTZ:'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="Other">Other</label>
        <input type="text" id="Other" name="Other" value="<?php echo !empty($response['Others']) ? $response['Others'] : ''; ?>">
    </div>
    <!-- Obgyne History -->
    <h2>Obgyne History</h2>
    <div class="form-group">
        <label for="g">Gravitiy</label>
        <input type="text" id="gravitiy" name="g" value="<?php echo !empty($response['G']) ? $response['G'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="parity">Parity</label>
        <input type="text" id="parity" name="parity" value="<?php echo !empty($response['G']) ? $response['G'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="OB_score">OB Score</label>
        <input type="text" id="OB_score" name="OB_score" value="<?php echo !empty($response['EDD by EUTZ:']) ? $response['EDD by EUTZ:'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="table">Table</label>
        <textarea name="table" style="width: 100;%" id="history" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <label for="M">M</label>
        <input type="text" id="Blood_Type" name="M" value="<?php echo !empty($response['M']) ? $response['M'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="I">I</label>
        <input type="text" id="I" name="I" value="<?php echo !empty($response['I']) ? $response['I'] : ''; ?>">
    </div>

    <div class="form-group">
        <label for="D">D</label>
        <input type="text" id="PMP" name="D" value="<?php echo !empty($response['D']) ? $response['D'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="A">A</label>
        <input type="text" id="EDD" name="A" value="<?php echo !empty($response['A']) ? $response['A'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="S">S</label>
        <input type="text" id="early_ultrasound" name="S" value="<?php echo !empty($response['S']) ? $response['S'] : ''; ?>">
    </div>
        <button type="submit">Submit</button>
      </form>
    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
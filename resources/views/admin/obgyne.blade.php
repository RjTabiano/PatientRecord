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
        <!-- ======================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    
                </div>

        </div>
    <br><br>
    <!-- =========== CONTAINER =========  -->
    <header>OCR Scanner (Optional)</header>
    <br> 
    <table style="margin: 0 auto;  width:10%">
    <tr>
        <td>
            <form action="{{ route('scanner.uploadP', ['patient' => $patient]) }}" method="post" accept="image/*" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" class="form-control" name="image" accept="image/*">
                <br>
                <input type="submit" class="custom-button" name="submit" value="Upload">
            </form>
        </td>
    </tr>
</table>
<br><br>
    <header>Obgyne Form</header>
    <button type="button" class="collapsible">Patient Information</button>
    <div class="content">
    <form method="post" action="{{route('patient.storeObgyne' , ['patient' => $patient])}}">
        @csrf
        @method('post')
        <div class="input-box">
          <input type="hidden" name="type" value="Obgyne" />
          <label>Name</label>
          <input type="text" placeholder="Enter Last Name" name="last_name" value="" required />
          <input type="text" placeholder="Enter First Name" name="first_name" value="" required />
        </div>

        <div class="input-box">
          <label>Email Address</label>
          <input type="text" placeholder="Enter email address" name="email" value="<?php echo !empty($response["Email:"]) ? $response["Email:"] : ''; ?>" required />
        </div>

        <div class="column">
            <div class="input-box">
                <label >Birth Date</label>
                <input class=""  type="date" name="birthdate" value="" placeholder="Enter birth date"/>
            </div>
          <div class="gender-box">
            <h3>Civil Status</h3>
            <div class="gender-option">
                <select name="civil_status">
                <option value="Single">Single</option>
                <option value="Married" >Married</option>
                <option value="Widowed" >Widowed</option>
                <option value="Separated" >Separated</option>
                </select>
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
        <button type="submit">Submit</button>
        </form>
    </div>
    <button type="button" class="collapsible">Medical History</button>
    <div class="content">
        <form>
            @csrf
            @method('post')
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
        </form>
    </div>
    <button type="button" class="collapsible">Baseline Diagnostics</button>
    <div class="content">
        <form>
            <div class="form-group">
                <label for="date">date</label>
                <input type="date" id="CBC_HgB" name="date" value="<?php echo !empty($response['Date:']) ? $response['Date:'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="blood_type">Blood Type</label>
                <select id="blood_type" name="blood_type">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>

            <div class="form-group">
            <div class="tooltip">FBS
                <span class="tooltiptext">Fasting Blood Sugar - This is the level of glucose in the blood after fasting for at least 8 hours. It is commonly used to diagnose and monitor diabetes mellitus.</span>
            </div>
                <input type="text" id="DPT" name="FBS" value="">
            </div>

            <div class="form-group">
            <div class="tooltip">Hgb
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Hct" name="Hgb" value="<?php echo !empty($response['Hgb:']) ? $response['Hgb:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">Hct
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="WBC" name="Hct" value="<?php echo !empty($response['Hct:']) ? $response['Hct:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">WBC
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Blood_Type" name="WBC" value="<?php echo !empty($response['WBC:']) ? $response['WBC:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">Platelet
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="FBS" name="Platelet" value="<?php echo !empty($response['FBS:']) ? $response['FBS:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">HIV
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="HBsAg" name="HIV" value="<?php echo !empty($response['HIV:']) ? $response['HIV:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">1st hr
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="VDRL" name="first_hr" value="<?php echo !empty($response['1st hr.:']) ? $response['1st hr.:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">2nd hr
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="HiV" name="second_hr" value="<?php echo !empty($response['2nd hr.:']) ? $response['2nd hr.:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">HBsAg
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="75g_OTT" name="HBsAg" value="<?php echo !empty($response['HBsAg:']) ? $response['HBsAg:'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">RPR
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Urinalysis" name="RPR" value="<?php echo !empty($response['RPR/VDRL']) ? $response['RPR/VDRL'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">Protein
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="protein" value="<?php echo !empty($response['PROTEIN:']) ? $response['PROTEIN:'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">Sugar
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="sugar" value="<?php echo !empty($response['SUGAR:']) ? $response['SUGAR:'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">LMP
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="LMP" value="<?php echo !empty($response['LMP:']) ? $response['LMP:'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">PMP
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="PMP" value="<?php echo !empty($response['PMP:']) ? $response['PMP:'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">AOG
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="AOG" value="<?php echo !empty($response['AOG:']) ? $response['AOG:'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">Early Ultrasound
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="early_ultrasound" value="<?php echo !empty($response['ULTRASOUND']) ? $response['ULTRASOUND'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">AOG By EUTZ
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="AOG_by_eutz" value="<?php echo !empty($response['AOG by EUTZ:']) ? $response['AOG by EUTZ:'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">EDD By EUTZ
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Other" name="EDD_by_eutz" value="<?php echo !empty($response['EDD by EUTZ:']) ? $response['EDD by EUTZ:'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="Other">Other</label>
                <input type="text" id="Other" name="Other" value="<?php echo !empty($response['Others']) ? $response['Others'] : ''; ?>">
            </div>
        </form>
    </div>
    <button type="button" class="collapsible">Obgyne History</button>
    <div class="content">
        <form>
            <div class="form-group">
            <div class="tooltip">Gravidity
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="gravitiy" name="g" value="<?php echo !empty($response['G']) ? $response['G'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">Parity
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="parity" name="parity" value="<?php echo !empty($response['G']) ? $response['G'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">OB Score
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="OB_score" name="OB_score" value="<?php echo !empty($response['EDD by EUTZ:']) ? $response['EDD by EUTZ:'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="table">Table</label>
                <textarea name="table" style="width: 100;%" id="history" cols="30" rows="10"></textarea>
            </div>

            <div class="form-group">
            <div class="tooltip">M
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="Blood_Type" name="M" value="<?php echo !empty($response['M']) ? $response['M'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">I
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="I" name="I" value="<?php echo !empty($response['I']) ? $response['I'] : ''; ?>">
            </div>

            <div class="form-group">
            <div class="tooltip">D
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="PMP" name="D" value="<?php echo !empty($response['D']) ? $response['D'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">A
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="EDD" name="A" value="<?php echo !empty($response['A']) ? $response['A'] : ''; ?>">
            </div>
            <div class="form-group">
            <div class="tooltip">S
                <span class="tooltiptext">BLABLABLABLABLABLAL</span>
            </div>
                <input type="text" id="early_ultrasound" name="S" value="<?php echo !empty($response['S']) ? $response['S'] : ''; ?>">
            </div>
                <button type="submit">Submit</button>
      </form>
    </div>
   
    <!-- =========== CONTAINER =========  -->


    <!-- =========== Scripts =========  -->
    <script src="{{ asset('javascript/main.js') }}"></script>

    <!-- ====== ionicons ======= -->
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
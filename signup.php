<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['username']) && isset($_SESSION['email'])) {
    // Redirect to home page if user is already logged
    header("Location: ./dashboard/overview");
}
if (isset($_SESSION['form_errors'])) {
    $errors = $_SESSION['form_errors'];
    unset($_SESSION['form_errors']);
}

// Repopulate form data if available
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
unset($_SESSION['form_data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - INFund</title>
    <link rel="stylesheet" href="./assets/css/login.css">
    <link rel="stylesheet" href="./assets/css/signup.css">
    <link rel="icon" href="./assets/icons/favicon.ico">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <!-- Left Side - Hero Section -->
        <div class="hero-section">
            <div class="hero-content">
                <h2 class="hero-title">Your next door crowdfunding solutions for universities</h2>
                <img src="./assets/images/static/hero.png" alt="INFund" class="hero-image">
            </div>
        </div>

        <!-- Right Side - Registration Form -->
        <div class="form-section">
            <div class="form-container registration">
                <div class="logo-container">
                    <div class="logo-circle">
                        <img src="./assets/images/static/logo.png" alt="INFund Logo" class="logo">
                    </div>
                </div>
                <h1 class="welcome-text">Create Account</h1>
                <p class="subtitle">Join our community today</p>

                <form id="registrationForm" action="./includes/signup_handler" method="POST" class="registration-form">

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="username">Username*</label>
                            <input type="text" id="username" name="username" class="form-input" required>
                            <span class="error-message" id="usernameError"></span>
                        </div>

                        <div class="form-group">
                            <label for="fullname">Full Name*</label>
                            <input type="text" id="fullname" name="fullname" class="form-input" required>
                            <span class="error-message" id="fullnameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender*</label>
                            <select id="gender" name="gender" class="form-input" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                                <option value="prefer_not_to_say">Prefer not to say</option>
                            </select>
                            <span class="error-message" id="genderError"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number*</label>
                            <input type="tel" id="phone" name="phone" class="form-input" required>
                            <span class="error-message" id="phoneError"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address*</label>
                            <input type="email" id="email" name="email" class="form-input" required>
                            <span class="error-message" id="emailError"></span>
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth*</label>
                            <input type="date" id="dob" name="dob" class="form-input" required>
                            <span class="error-message" id="dobError"></span>
                        </div>

                        <div class="form-group">
                            <label for="country">Country*</label>
                            <select id="country" name="country" class="form-input" required>
                                <option value="">Select Country</option>
                                <option value="Nigeria">Nigeria</option>
                            </select>
                            <span class="error-message" id="countryError"></span>
                        </div>

                        <div class="form-group">
                            <label for="state">State*</label>
                            <select id="state" name="state" class="form-input" required>
                                <option value="">Select State</option>
                                <option value="Ogun">Ogun</option>
                            </select>
                            <span class="error-message" id="stateError"></span>
                        </div>

                        <div class="form-group">
                            <label for="university">University*</label>
                            <select id="university" name="university" class="form-input" required>
                                <option value="">Select University</option>
                                <optgroup label="Federal Universities">
                                    <option value="ATBU">Abubakar Tafawa Balewa University, Bauchi (ATBU)</option>
                                    <option value="ABU">Ahmadu Bello University, Zaria (ABU)</option>
                                    <option value="AE-FUNAI">Alex Ekwueme Federal University Ndufu Alike Ikwo (AE-FUNAI)</option>
                                    <option value="BUK">Bayero University, Kano (BUK)</option>
                                    <option value="FUNAAB">Federal University of Agriculture, Abeokuta (FUNAAB)</option>
                                    <option value="FUBK">Federal University Birnin Kebbi (FUBK)</option>
                                    <option value="FUD">Federal University Dutse (FUD)</option>
                                    <option value="FUDMA">Federal University Dutsin Ma (FUDMA)</option>
                                    <option value="FUG">Federal University Gashua (FUG)</option>
                                    <option value="FUGUS">Federal University Gusau (FUGUS)</option>
                                    <option value="FUHSO">Federal University of Health Sciences, Otukpo (FUHSO)</option>
                                    <option value="FUHSA">Federal University of Health Sciences, Azare (FUHSA)</option>
                                    <option value="FUK">Federal University Kashere (FUK)</option>
                                    <option value="FUL">Federal University Lafia (FUL)</option>
                                    <option value="FULOKOJA">Federal University Lokoja (FULOKOJA)</option>
                                    <option value="FUMA">Federal University of Agriculture, Makurdi (FUMA)</option>
                                    <option value="FUPRE">Federal University of Petroleum Resources, Effurun (FUPRE)</option>
                                    <option value="FUTA">Federal University of Technology, Akure (FUTA)</option>
                                    <option value="FUTMINNA">Federal University of Technology, Minna (FUTMINNA)</option>
                                    <option value="FUTY">Federal University of Technology, Yola (FUTY)</option>
                                    <option value="FUO">Federal University Otuoke (FUO)</option>
                                    <option value="FUWUKARI">Federal University Wukari (FUWUKARI)</option>
                                    <option value="IBBUL">Ibrahim Badamasi Babangida University, Lapai (IBBUL)</option>
                                    <option value="JABU">Joseph Ayo Babalola University, Ikeji-Arakeji (JABU)</option>
                                    <option value="KWASU">Kwara State University, Malete (KWASU)</option>
                                    <option value="MOUA">Michael Okpara University of Agriculture, Umudike (MOUA)</option>
                                    <option value="NAUB">Nigerian Army University Biu (NAUB)</option>
                                    <option value="NSUK">Nasarawa State University, Keffi (NSUK)</option>
                                    <option value="OAU">Obafemi Awolowo University, Ile-Ife (OAU)</option>
                                    <option value="UNIJOS">University of Jos (UNIJOS)</option>
                                    <option value="UNILAG">University of Lagos (UNILAG)</option>
                                    <option value="UNILORIN">University of Ilorin (UNILORIN)</option>
                                    <option value="UNIMAID">University of Maiduguri (UNIMAID)</option>
                                    <option value="UNIPORT">University of Port Harcourt (UNIPORT)</option>
                                    <option value="UNN">University of Nigeria, Nsukka (UNN)</option>
                                </optgroup>

                                <optgroup label="State Universities">
                                    <option value="ABSU">Abia State University, Uturu (ABSU)</option>
                                    <option value="ADSU">Adamawa State University, Mubi (ADSU)</option>
                                    <option value="AAUA">Adekunle Ajasin University, Akungba-Akoko (AAUA)</option>
                                    <option value="AKSU">Akwa Ibom State University, Uyo (AKSU)</option>
                                    <option value="ADUSTECH">Aliko Dangote University of Science and Technology, Wudil (ADUSTECH)</option>
                                    <option value="AAU">Ambrose Alli University, Ekpoma (AAU)</option>
                                    <option value="ANSU">Anambra State University, Uli (ANSU)</option>
                                    <option value="BAUCHISTATE">Bauchi State University, Gadau (BAUCHISTATE)</option>
                                    <option value="BSU">Benue State University, Makurdi (BSU)</option>
                                    <option value="YUMSUK">Yusuf Maitama Sule University, Kano (YUMSUK)</option>
                                    <option value="COOU">Chukwuemeka Odumegwu Ojukwu University, Uli (COOU)</option>
                                    <option value="CRUTECH">Cross River University of Technology, Calabar (CRUTECH)</option>
                                    <option value="DSU">Delta State University, Abraka (DSU)</option>
                                    <option value="EBSU">Ebonyi State University, Abakaliki (EBSU)</option>
                                    <option value="EUI">Edo University, Iyamho (EUI)</option>
                                    <option value="ESUT">Enugu State University of Science and Technology, Enugu (ESUT)</option>
                                    <option value="GOMSU">Gombe State University, Gombe (GOMSU)</option>
                                    <option value="GSU">Gombe State University of Science and Technology (GSU)</option>
                                    <option value="IAUE">Ignatius Ajuru University of Education, Port Harcourt (IAUE)</option>
                                    <option value="IKUN">Ibrahim Gbadamosi Babangida University, Lapai (IKUN)</option>
                                    <option value="IMSU">Imo State University, Owerri (IMSU)</option>
                                    <option value="KASU">Kaduna State University, Kaduna (KASU)</option>
                                    <option value="KSUSTA">Kebbi State University of Science and Technology, Aliero (KSUSTA)</option>
                                    <option value="KSUST">Kogi State University, Anyigba (KSUST)</option>
                                    <option value="LAUTECH">Ladoke Akintola University of Technology, Ogbomoso (LAUTECH)</option>
                                    <option value="LASU">Lagos State University, Ojo (LASU)</option>
                                </optgroup>

                                <optgroup label="Uniformed Universities">
                                    <option value="AFIT">Nigeria Airforce University, Kaduna (AFIT)</option>
                                    <option value="NMU">Nigeria Maritime University, Warri (NMU)</option>
                                    <option value="POLAC">Nigeria Police Academy Wudil, Kano (POLAC)</option>
                                    <option value="NUAB">Nigerian Army University Biu, Borno (NUAB)</option>
                                    <option value="NDA">Nigerian Defence Academy, Kaduna (NDA)</option>
                                </optgroup>

                                <optgroup label="Private Universities">
                                    <option value="AC">Achievers University, Owo (AC)</option>
                                    <option value="AUE">Adeleke University, Ede (AUE)</option>
                                    <option value="ABUAD">Afe Babalola University, Ado-Ekiti (ABUAD)</option>
                                    <option value="AUST">African University of Science and Technology, Abuja (AUST)</option>
                                    <option value="APU">Ahman Pategi University, Pategi (APU)</option>
                                    <option value="ACU">Ajayi Crowther University, Oyo (ACU)</option>
                                    <option value="ALHIKMAH">Al-Hikmah University, Ilorin (ALHIKMAH)</option>
                                    <option value="AUN">American University of Nigeria, Yola (AUN)</option>
                                    <option value="AB">Augustine University, Ilara (AB)</option>
                                    <option value="BabcockU">Babcock University, Ilishan Remo (BabcockU)</option>
                                    <option value="BU">Baze University, Abuja (BU)</option>
                                    <option value="BCU">Bells University of Technology, Ota (BCU)</option>
                                    <option value="BNU">Benson Idahosa University, Benin City (BNU)</option>
                                    <option value="BUI">Bingham University, Karu (BUI)</option>
                                    <option value="BUK">Bowen University, Iwo (BUK)</option>
                                    <option value="BUK">Caleb University, Imota (CU)</option>
                                    <option value="CBU">Chrisland University, Abeokuta (CBU)</option>
                                    <option value="CU">Covenant University, Ota (CU)</option>
                                    <option value="EBSU">Elizade University, Ilara-Mokin (EBSU)</option>
                                    <option value="FUO">Fountain University, Osogbo (FUO)</option>
                                    <option value="GOU">Godfrey Okoye University, Enugu (GOU)</option>
                                    <option value="GU">Gregory University, Uturu (GU)</option>
                                    <option value="HEGT">Hallmark University, Ijebu-Itele (HEGT)</option>
                                    <option value="IBBU">Ibrahim Babangida University, Lapai (IBBU)</option>
                                    <option value="KCU">Kwararafa University, Wukari (KCU)</option>
                                    <option value="LSU">Landmark University, Omu-Aran (LSU)</option>
                                    <option value="LU">Lead City University, Ibadan (LU)</option>
                                    <option value="MCU">McPherson University, Seriki Sotayo (MCU)</option>
                                </optgroup>

                            </select>
                            <span class="error-message" id="universityError"></span>
                        </div>

                        <div class="form-group">
                            <label for="faculty">Faculty/College*</label>
                            <select id="faculty" name="faculty" class="form-input" required>
                                <option value="">Select Faculty/College</option>
                                <option value="Engineering">Engineering</option>
                            </select>
                            <span class="error-message" id="facultyError"></span>
                        </div>

                        <div class="form-group">
                            <label for="department">Department/Course *</label>
                            <select id="department" name="department" class="form-input" required>
                                <option value="">Select Department</option>
                                <optgroup label="Agriculture">
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Agricultural Economics">Agricultural Economics</option>
                                    <option value="Agricultural Economics/Extension">Agricultural Economics/Extension</option>
                                    <option value="Agricultural Education">Agricultural Education</option>
                                    <option value="Agricultural Engineering">Agricultural Engineering</option>
                                    <option value="Agricultural Extension">Agricultural Extension</option>
                                    <option value="Agricultural Science">Agricultural Science</option>
                                    <option value="Agronomy">Agronomy</option>
                                    <option value="Animal Production">Animal Production</option>
                                    <option value="Animal Science">Animal Science</option>
                                    <option value="Crop Production">Crop Production</option>
                                    <option value="Crop Science">Crop Science</option>
                                    <option value="Family, Nutrition And Consumer Sciences">Family, Nutrition And Consumer Sciences</option>
                                    <option value="Fisheries">Fisheries</option>
                                    <option value="Food Science and Technology">Food Science and Technology</option>
                                    <option value="Forestry">Forestry</option>
                                    <option value="Plant Science">Plant Science</option>
                                    <option value="Soil Science">Soil Science</option>
                                    <option value="Water Resources Management And Agrometerorology">Water Resources Management And Agrometerorology</option>
                                </optgroup>

                                <optgroup label="Engineering">
                                    <option value="Engineering">Engineering</option>
                                    <option value="Automobile Engineering">Automobile Engineering</option>
                                    <option value="Biomedical Engineering">Biomedical Engineering</option>
                                    <option value="Chemical Engineering">Chemical Engineering</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Computer Engineering">Computer Engineering</option>
                                    <option value="Electrical Engineering">Electrical Engineering</option>
                                    <option value="Engineering Physics">Engineering Physics</option>
                                    <option value="Food Science and Engineering">Food Science and Engineering</option>
                                    <option value="Industrial and Production Engineering">Industrial and Production Engineering</option>
                                    <option value="Information Communication Engineering">Information Communication Engineering</option>
                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    <option value="Mechatronics Engineering">Mechatronics Engineering</option>
                                    <option value="Metallurgical Engineering">Metallurgical Engineering</option>
                                    <option value="Water Resources and Environmental Engineering">Water Resources and Environmental Engineering</option>
                                    <option value="Software Engineering">Software Engineering</option>
                                    <option value="System Engineering">System Engineering</option>
                                    <option value="Petroleum Engineering">Petroleum Engineering</option>
                                </optgroup>

                                <optgroup label="Medicine & Pharmacy">
                                    <option value="Anatomy">Anatomy</option>
                                    <option value="Biochemistry">Biochemistry</option>
                                    <option value="Human Nutrition and Dietetics">Human Nutrition and Dietetics</option>
                                    <option value="Medical Laboratory Technology/Science">Medical Laboratory Technology/Science</option>
                                    <option value="Medicine & Surgery">Medicine & Surgery</option>
                                    <option value="Nursing">Nursing</option>
                                    <option value="Pharmacy">Pharmacy</option>
                                    <option value="Physiology">Physiology</option>
                                    <option value="Public Health Technology">Public Health Technology</option>
                                    <option value="Veterinary medicine">Veterinary medicine</option>
                                </optgroup>

                                <optgroup label="Arts, Management & Social Science">
                                    <option value="Accounting">Accounting</option>
                                    <option value="Arabic">Arabic</option>
                                    <option value="Banking and Finance">Banking and Finance</option>
                                    <option value="Business Administration">Business Administration</option>
                                    <option value="Communication Arts">Communication Arts</option>
                                    <option value="Criminology and Security Studies">Criminology and Security Studies</option>
                                    <option value="Curriculum studies">Curriculum studies</option>
                                    <option value="Demography and Social Statistics">Demography and Social Statistics</option>
                                    <option value="Economics">Economics</option>
                                    <option value="English Language">English Language</option>
                                    <option value="Entrepreneurship">Entrepreneurship</option>
                                    <option value="Fine Arts">Fine Arts</option>
                                    <option value="French">French</option>
                                    <option value="Hausa">Hausa</option>
                                    <option value="History">History</option>
                                    <option value="Home Economics">Home Economics</option>
                                    <option value="Hospitality and Tourism Management">Hospitality and Tourism Management</option>
                                    <option value="Human Resource Management">Human Resource Management</option>
                                    <option value="Igbo">Igbo</option>
                                    <option value="Insurance">Insurance</option>
                                    <option value="International Relations">International Relations</option>
                                    <option value="Islamic Studies">Islamic Studies</option>
                                    <option value="Linguistics">Linguistics</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Mass Communication">Mass Communication</option>
                                    <option value="Media and Communication Studies">Media and Communication Studies</option>
                                    <option value="Music">Music</option>
                                    <option value="Peace and Conflict Resolution">Peace and Conflict Resolution</option>
                                    <option value="Performing Arts">Performing Arts</option>
                                    <option value="Philosophy">Philosophy</option>
                                    <option value="Political Science">Political Science</option>
                                    <option value="Project management">Project management</option>
                                    <option value="Psychology">Psychology</option>
                                    <option value="Public Administration">Public Administration</option>
                                    <option value="Religious Studies">Religious Studies</option>
                                    <option value="Social Works">Social Works</option>
                                    <option value="Sociology">Sociology</option>
                                    <option value="Taxation">Taxation</option>
                                    <option value="Tourism Studies">Tourism Studies</option>
                                    <option value="Theology">Theology</option>
                                    <option value="Yoruba">Yoruba</option>
                                </optgroup>

                                <optgroup label="Science & Technology">
                                    <option value="Architecture">Architecture</option>
                                    <option value="Biochemistry">Biochemistry</option>
                                    <option value="Bio-Infomatics">Bio-Infomatics</option>
                                    <option value="Biology">Biology</option>
                                    <option value="Botany">Botany</option>
                                    <option value="Building Technology">Building Technology</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Cyber Security Science">Cyber Security Science</option>
                                    <option value="Estate Management">Estate Management</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Geography">Geography</option>
                                    <option value="Geophysics">Geophysics</option>
                                    <option value="Geology">Geology</option>
                                    <option value="Human Nutrition and Dietetics">Human Nutrition and Dietetics</option>
                                    <option value="Information Resource Management">Information Resource Management</option>
                                    <option value="Information Systems">Information Systems</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Library and Information Science">Library and Information Science</option>
                                    <option value="Management Information System">Management Information System</option>
                                    <option value="Mathematics">Mathematics</option>
                                    <option value="MicroBiology">MicroBiology</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Plant Science">Plant Science</option>
                                    <option value="Statistics">Statistics</option>
                                    <option value="Urban and Regional Planning">Urban and Regional Planning</option>
                                    <option value="Veterinary medicine">Veterinary medicine</option>
                                    <option value="Zoology">Zoology</option>
                                </optgroup>

                                <optgroup label="Education">
                                    <option value="Adult Education">Adult Education</option>
                                    <option value="Agricultural Education">Agricultural Education</option>
                                    <option value="Business Education">Business Education</option>
                                    <option value="Counselor Education">Counselor Education</option>
                                    <option value="Early Childhood Education">Early Childhood Education</option>
                                    <option value="Education Administration">Education Administration</option>
                                    <option value="Education & Accounting">Education & Accounting</option>
                                    <option value="Education & Arabic">Education & Arabic</option>
                                    <option value="Education & Biology">Education & Biology</option>
                                    <option value="Education & Business Administration">Education & Business Administration</option>
                                    <option value="Education & Chemistry">Education & Chemistry</option>
                                    <option value="Education & Computer Science">Education & Computer Science</option>
                                    <option value="Education & Christian Religious Studies">Education & Christian Religious Studies</option>
                                    <option value="Education & Economics">Education & Economics</option>
                                    <option value="Education & Fine Art">Education & Fine Art</option>
                                    <option value="Education & English Language">Education & English Language</option>
                                    <option value="Education & French">Education & French</option>
                                    <option value="Education & Geography">Education & Geography</option>
                                    <option value="Education & History">Education & History</option>
                                    <option value="Education & Integrated Science">Education & Integrated Science</option>
                                    <option value="Education & Introductory Technology">Education & Introductory Technology</option>
                                    <option value="Education & Islamic Studies">Education & Islamic Studies</option>
                                    <option value="Education & Mathematics">Education & Mathematics</option>
                                    <option value="Education & Music">Education & Music</option>
                                    <option value="Education & Physics">Education & Physics</option>
                                    <option value="Education & Political Science">Education & Political Science</option>
                                    <option value="Education & Religious Studies">Education & Religious Studies</option>
                                    <option value="Education & Social Studies">Education & Social Studies</option>
                                    <option value="Education Arts">Education Arts</option>
                                    <option value="Education Foundation">Education Foundation</option>
                                    <option value="Environmental Education">Environmental Education</option>
                                    <option value="Guidance and Counseling">Guidance and Counseling</option>
                                    <option value="Health Education">Health Education</option>
                                    <option value="Vocational Education">Vocational Education</option>
                                    <option value="Special Education">Special Education</option>
                                </optgroup>

                                <optgroup label="Law">
                                    <option value="Law">Law</option>
                                    <option value="Civil Law">Civil Law</option>
                                    <option value="Sharia/Islamic Law">Sharia/Islamic Law</option>
                                    <option value="Private law">Private law</option>
                                    <option value="Public law">Public law</option>
                                    <option value="Commercial Law">Commercial Law</option>
                                    <option value="International Law & Jurisprudence">International Law & Jurisprudence</option>
                                </optgroup>
                            </select>
                            <span class="error-message" id="department Error"></span>
                        </div>

                        <div class="form-group">
                            <label for="matricno">Matric Number*</label>
                            <input type="text" id="matricno" name="matricno" class="form-input" required>
                            <span class="error-message" id="matricnoError"></span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password*</label>
                            <div class="password-input-container">
                                <input type="password" id="password" name="password" class="form-input" required>
                                <button type="button" class="toggle-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <span class="error-message" id="passwordError"></span>
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password*</label>
                            <div class="password-input-container">
                                <input type="password" id="confirmPassword" name="confirmPassword" class="form-input" required>
                                <button type="button" class="toggle-password">
                                    <i class="far fa-eye"></i>
                                </button>
                            </div>
                            <span class="error-message" id="confirmPasswordError"></span>
                        </div>
                    </div>

                    <div class="form-group terms-group">
                        <label class="checkbox-label">
                            <input type="checkbox" name="terms" required>
                            <span class="checkmark"></span>
                            I agree to the <a href="./terms">Terms of Service</a> and <a href="./privacy">Privacy Policy</a>
                        </label>
                        <span class="error-message" id="termsError"></span>
                    </div>

                    <input type="submit" class="submit-button" value="Create Account">

                    <!--  <div class="social-login">
                        <button type="button" class="google-login">
                            <img src="google-icon.png" alt="Google">
                            Or sign up with Google
                        </button>
                    </div> -->

                    <p class="login-prompt">
                        Already have an account?
                        <a href="./login">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options.progressBar = true;
    </script>
    <script>
        <?php if (isset($_SESSION['success_message'])) : ?>
            toastr.success("<?php echo $_SESSION['success_message']; ?>");
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])) : ?>
            toastr.error("<?php echo $_SESSION['error_message']; ?>");
           alert("Error");
            <?php unset($_SESSION['error_message']); ?>

        <?php endif; ?>
    </script>
    <script src="./assets/js/auth_pages/signup.js"></script>
</body>

</html>
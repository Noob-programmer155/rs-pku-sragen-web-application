@include("User.Component.Utils.header")

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Appointment</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>appointment</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="appointment page section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="appointment-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="appointment-title">
                                <h2>Book An Appointment</h2>
                                <p>Please feel welcome to contact our friendly reception staff with any general or
                                    medical
                                    enquiry. Our doctors will receive or return any urgent calls.</p>
                            </div>
                        </div>
                    </div>
                    <form action="/get-janji-temu" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 p-0">
                                <div class="appointment-input">
                                    <label for="name"><i class="lni lni-user"></i></label>
                                    <input type="text" name="name" id="name-appointment" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-0">
                                <div class="appointment-input">
                                    <label for="email"><i class="lni lni-envelope"></i></label>
                                    <input type="email" name="email" id="email-appointment" placeholder="Your Email">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-0">
                                <div class="appointment-input">
                                    <label for="number"><i class="lni lni-phone-set"></i></label>
                                    <input type="text" name="number" id="number-appointment" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-0">
                                <div class="appointment-input">
                                    <label for="department"><i class="lni lni-notepad"></i></label>
                                    <select name="department" id="department-appointment">
                                        <option value="none" selected disabled>Department</option>
                                        @foreach($department_list as $dept)
                                            <option value="{{$dept -> id}}">{{$dept -> name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-0">
                                <div class="appointment-input">
                                    <label for="doctor"><i class="lni lni-sthethoscope"></i></label>
                                    <select name="doctor" id="doctor-appointment">
                                        <option value="none" selected disabled>Doctor</option>
                                        @foreach($doctor_list as $doc)
                                            <option value="{{$doc -> id}}" data-department="{{$doc -> department}}">{{$doc -> username}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-0">
                                <div class="appointment-input">
                                    <input type="date" name="date" id="date-appointment" style="padding-right: 10px;">
                                </div>
                            </div>
                            <div class="col-12 p-0">
                                <div class="appointment-input">
                                    <textarea placeholder="Write Your Message Here....." name="message" id="message-appointment"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-0">
                                <div class="appointment-btn button">
                                    <button type="submit" class="btn">Get Appointment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<!--Tiny js -->
<script src="{{asset('js/tiny-slider.js')}}"></script>
<!-- Glightbox js -->
<script src="{{asset('js/glightbox.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<!-- Appointment js -->
<script src="{{asset('js/appointment.js')}}"></script>

@include("User.Component.Utils.footerHome")

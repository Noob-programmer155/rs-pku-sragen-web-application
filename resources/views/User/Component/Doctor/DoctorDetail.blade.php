@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Doctors</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/doctors">Our Doctor</a></li>
                    <li>{{$doctor['data'][0] -> username}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="doctor-details section">
    <div class="container">
        <div class="inner">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="image">
                                <img src="/images/doctors/{{$doctor['data'][0] -> image}}" alt="{{$doctor['data'][0] -> username}}">
                            </div>
                            <div class="doctor-left-bar">
                                <div class="single-bar">
                                    <h4>Specialty</h4>
                                    <p>{{$doctor['data'][0] -> doctor_specialty}}</p>
                                </div>
                                <div class="single-bar">
                                    <h4>Conditions</h4>
                                    <p>{{$doctor['data'][0] -> conditions}}</p>
                                </div>
                                <div class="single-bar">
                                    <h4>Memberships</h4>
                                    <ul class="list">
                                        @foreach($doctor['organization'] as $orgaization)
                                            <li><a href="{{$orgaization -> link}}">{{$orgaization -> name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="single-bar">
                                    <h4>Doctor Schedule</h4>
                                    <ul class="opening-hour">
                                        @foreach($doctor['schedule'] as $schedule)
                                            <li>
                                                <span class="day"><i class="lni lni-timer"></i>{{$schedule -> days}}</span>
                                                <span class="time">{{$schedule -> timestart}} - {{$schedule -> timeend}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="content">
                                <h3 class="name">{{$doctor['data'][0] -> username}}
                                    <span>{{$doctor['data'][0] -> wise_words}}</span>
                                </h3>
                                <ul class="list-info">
                                    <li><span>Profession:</span>{{$doctor['data'][0] -> profession}}</li>
                                    <li><span>Experience:</span>{{$doctor['data'][0] -> experience}}</li>
                                    <li><span>Phone:</span> <a href="tel:{{$doctor['data'][0] -> phone}}">{{$doctor['data'][0] -> phone}}</a> </li>
                                    <li><span>Email:</span> <a class="" href="mailto:{{$doctor['data'][0] -> email}}" >{{$doctor['data'][0] -> email}}</a>
                                    </li>
                                    <li><span>Address:</span>{{$doctor['data'][0] -> address}}</li>
                                    <li>
                                        <ul class="social">
                                            <li><span>Follow On:</span></li>
                                            @foreach($doctor['social'] as $social)
                                                <li><a href="{{$social -> link}}"><i class="lni lni-{{$social -> social}}"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                <h4>Biography</h4>
                                {!! $doctor['data'][0] -> biography !!}
                                <h4>Education</h4>
                                <ul class="normal-list-info">
                                    @foreach($doctor['educations'] as $education)
                                        <li>{{$education -> name_place}}</li>
                                    @endforeach
                                </ul>
                                <h4>Awards & Honours</h4>
                                <ul class="normal-list-info">
                                    @foreach($doctor['awards'] as $award)
                                        <li>{{$award -> years}} {{$award -> title}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('User.Component.Utils.footerHome')

<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>

@include('User.Component.Utils.footer')

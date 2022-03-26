<footer class="footer overlay">

    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="cta">
                        <h3>Need Help?</h3>
                        @foreach($global as $desc)
                          @if($desc -> name === 'telp')
                            <p>Please feel free to contact our friendly reception staff with any medical enquiry, or
                                call <a href="tel:{{$desc -> description}}">{{$desc -> description}}</a></p>
                          @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form">
                        <h3>Subscribe Newsletter</h3>
                        <form action="#" method="get" target="_blank" class="newsletter-form">
                            <input name="EMAIL" placeholder="Your email address" type="email">
                            <div class="button">
                               <button class="btn" type="button">
                                    Subscribe<span class="dir-part"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">

                    <div class="single-footer f-about">
                        <div class="logo">
                            <a href="/">
                                <img src="/images/logo/white-logo.svg" alt="#">
                            </a>
                        </div>
                        <p>There’s nothing in this story to make us think he was dreaming about riches.</p>
                        <ul class="social">
                            @foreach($social_global as $desc)
                              <li><a href="{{$desc -> description}}"><i class="lni lni-{{$desc -> name}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-footer f-link">
                        <h3>Useful Links</h3>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="/about">About</a></li>
                                    <li><a href="/doctors">Team</a></li>
                                    <li><a href="/departments">department</a></li>
                                    <li><a href="#">Cost Calculator</a></li>
                                    <li><a href="/table-workhours">Working Hours</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <ul>
                                    <li><a href="/appointment">Appointment</a></li>
                                    <li><a href="/blogs">Blogs</a></li>
                                    <li><a href="/services">services</a></li>
                                    <li><a href="/contact">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">

                    <div class="single-footer opening-hours">
                        <h3>Opening Hours</h3>
                        <ul>
                            @foreach($time_works as $time)
                              @php
                                $times = explode(',',$time -> description);
                                $time -> day = $times[0];
                                $time -> time = $times[1];
                              @endphp
                                <li>
                                    <span class="day"><i class="lni lni-timer"></i> {{$time -> day}}</span>
                                    <span class="time">{{$time -> time}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-6 col-12">

                    <div class="single-footer last f-contact">
                        <h3>Contact</h3>
                        <ul>
                            @foreach($global as $desc)
                              @if($desc -> name === 'location')
                                <li><i class="lni lni-map-marker"></i>{{$desc -> description}}</li>
                              @elseif($desc -> name === 'telp')
                                <li><i class="lni lni-phone"></i> <a class="color" href="tel:{{$desc -> description}}">{{$desc -> description}}</a></li>
                              @else
                                <li><i class="lni lni-envelope"></i><a href="mailto:{{$desc -> description}}">{{$desc -> description}}</a></li>
                              @endif
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="footer-bottom">
        <div class="container">
            <div class="inner">
                <div class="row">
                    <div class="col">
                        <div class="content align-center">
                            <p class="copyright-text">Designed and Developed by <a>AFSD Team</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>

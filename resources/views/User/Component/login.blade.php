@include("User.Component.Utils.headerComponent")

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Login</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li>Login</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<section class="login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <div class="form-head">
                    <h4 class="title">Login To Your Account</h4>
                    <form action="/login" method="post">
                        @csrf
                        <div class="form-group">
                            <input name="email" type="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" placeholder="Password">
                        </div>
                        <div class="check-and-pass">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input width-auto"
                                            id="exampleCheck1">
                                        <label class="form-check-label">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <a href="/lost-password" class="lost-pass">Lost your password?</a>
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" class="btn">Login Now</button>
                        </div>
                        <div class="alt-option">
                            <span>Or</span>
                        </div>
                        <div class="socila-login">
                            <div class="row">
                                <div class="col-12">
                                    <ul>
                                        <li><a href="javascript:void(0)" class="google">
                                            <img src="/images/google.png"><span>Sign in With Google</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <p class="outer-link">Don't have an account? <a href="/signup">Register here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@include("User.Component.Utils.footerHome")

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

@include("User.Component.Utils.footer")

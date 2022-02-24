@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Department</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/departemen-kami">Department</a></li>
                    <li>{{$dep_name}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<main>
  <article class="department-detail">
    @foreach($department as $dept)
      <section class="container global wow fadeInDown">
        <div class="row title">
          <div class="col-12">
            <h1>{{$dept[0] -> name}}</h1>
            <img src="/images/departments/{{$dept[0] -> image}}" alt="{{$dept[0] -> name}}">
          </div>
          <div class="col-12">
            <table>
              <tbody>
                <tr>
                  <td>Department Icon</td>
                  <td><i class="lni {{$dept[0] -> icon}}"></i></td>
                </tr>
                <tr>
                  <td>Department Rating</td>
                  <td><span><ins>{{$dept['rating']['rating']}}</ins>/4.0</span></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row wow fadeInDown">
          <div class="col-12">
            <h3>Description</h3>
            {!! $dept[0] -> description !!}
          </div>
        </div>
      </section>
      <section class="container services section pt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="services-content">
                    <div class="row pl-4 pr-4 justify-content-center">
                        <h3 class="wow fadeInDown pb-4">Department Services</h3>
                        @foreach($dept['services'] as $serv)
                          <div class="col-lg-4 col-md-6 col-12 p-0">
                              <div class="single-list custom-border-right wow fadeInDown m-0"
                                  data-wow-delay=".2s">
                                  <img class="shape1" src="/images/service/shape1.svg" alt="#">
                                  <img class="shape2" src="/images/service/shape2.svg" alt="#">
                                  <i class="lni {{$serv -> icon}}"></i>
                                  <h4><a href="/pelayanan/{{$serv -> name}}?idserv={{$serv -> id}}">{{$serv -> name}}</a></h4>
                                  <p>{{$serv -> description_title}}</p>
                              </div>
                          </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
      </section>
      <section class="container image pt-1">
        <div class="row">
          <div class="container-image col-12">
            <button>
              <svg
                class="reverse"
                xmlns="http://www.w3.org/2000/svg"
                height="4rem"
                viewBox="0 50 400 250"
                width="4rem"
                style="--rotate:-90deg"><path d="M 50 300 L 350 300 Q 400 300 400 250 L 200 50 L 0 250 Q 0 300 50 300 L 350 300 "/></svg>
            </button>
            <div class="item-image-container">
              @foreach($dept['image'] as $img)
                <div class="item-image">
                  <button>
                    <img src="/images/departments/{{$img -> media}}" alt="{{$dep_name}}">
                  </button>
                </div>
              @endforeach
            </div>
            <button><svg
              class="reverse"
              xmlns="http://www.w3.org/2000/svg"
              height="4rem"
              viewBox="0 50 400 250"
              width="4rem"
              style="--rotate:90deg"><path d="M 50 300 L 350 300 Q 400 300 400 250 L 200 50 L 0 250 Q 0 300 50 300 L 350 300 "/></svg>
            </button>
          </div>
        </div>
      </section>
    @endforeach
  </article>
</main>

<!--bootstrap js-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Wow js -->
<script src="{{asset('js/wow.min.js')}}"></script>
<!-- Glightbox js -->
<script src="{{asset('js/glightbox.min.js')}}"></script>
<!-- Main js -->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{asset('js/department-detail.js')}}"></script>

@include('User.Component.Utils.footerHome')

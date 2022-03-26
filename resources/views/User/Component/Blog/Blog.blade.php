@include('User.Component.Utils.header')

<div class="breadcrumbs overlay">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">Blog Single</h1>
                </div>
                <ul class="breadcrumb-nav">
                    <li><a href="/">Home</a></li>
                    <li><a href="/blogs">Blogs</a></li>
                    <li>{{$blog[0] -> title}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<section class="section blog-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                <div class="single-inner">
                    <div class="post-thumbnils">
                        <img src="/images/blog/{{$blog[0] -> image}}" alt="{{$blog[0] -> title}}" />
                    </div>
                    <div class="post-details">
                        <div class="detail-inner">
                            <h2 class="post-title">
                                <a href="#">{{$blog[0] -> title}}</a>
                            </h2>

                            <ul class="meta-info">
                                <li>
                                    <a href="/doctor/{{$blog[0] -> doc_username}}?iddoc={{$blog[0] -> doc_id}}">
                                      <img src="/images/doctors/{{$blog[0] -> doc_image}}" alt="{{$blog[0] -> doc_username}}" />
                                      {{$blog[0] -> doc_username}}
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">
                                      <i class="lni lni-timer"></i> {{$blog[0] -> date}}
                                    </a>
                                </li>
                            </ul>

                            {!! $blog[0] -> description !!}

                            <div class="post-social-media">
                                <h5 class="share-title">Social Share</h5>
                                <ul>
                                    @foreach($blog[0] -> doc_social as $doc_social)
                                        <li>
                                            <a href="{{$doc_social -> link}}">
                                                <i class="lni lni-{{$doc_social -> social}}"></i>
                                                <span>{{$doc_social -> helper}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="post-comments">
                            <h3 class="comment-title"><span>Post comments</span></h3>
                            <ul id="comments-list-container" class="comments-list"></ul>
                        </div>
                        <div class="comment-form">
                            <h3 class="comment-reply-title">Leave a comment</h3>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-box form-group">
                                        <textarea id="text-form-comments" class="form-control form-control-custom"
                                            placeholder="Your Comments"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="button">
                                        <button id="btn-submit-form-comments" type="button" class="btn">
                                            Post Comment
                                        </button>
                                    </div>
                                </div>
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
<!-- Blog js -->
<script src="{{asset('js/blog.js')}}"></script>
<script type="text/javascript">
(
  function () {
    let idBlog = {{$blog[0] -> id}};
    const commentsRoot = document.getElementById('comments-list-container');
    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    getData(idBlog).then((data)=>{
      let elem = '';
      data.forEach((item, i) => {
        item['dates_upload'] = new Date(item.dates_upload).toLocaleDateString("ID",options);
        let bool = false;
        if(item.replays !== ""){
          bool = true;
        }
        elem += element1(item,bool);
      });
      commentsRoot.innerHTML = elem;
    });
    const btnSubmitComment = document.getElementById('btn-submit-form-comments');
    btnSubmitComment.addEventListener('click',() => {
      const commentTextArea = document.getElementById('text-form-comments');
      commentFunc(null,commentTextArea.value,'{{csrf_token()}}');
    });
  }
)()
</script>

@include('User.Component.Utils.footer')

<?php
use App\Models\Setting;
use App\Models\Language;
 $setting = setting::find(1);
 $language = language::get();
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset=UTF-8>
    <title>{{ $setting->sitename }} - @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" sizes="32x32" href="{{ asset('img/profile/' . $setting->favicon) }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    
</head>

<body>
@if(Auth::guard('admin')->guest())
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">{{ config('app.name', 'Laravel') }}</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>  
</header>
<div class="container-fluid">
  @yield('frontcontent')  
</div>

@else    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow header_logo">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 pt-0 pb-0" href="#">
    <img src="{{ asset('img/profile/' . $setting->image) }}" height=50 width=70>
  </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    

    <div class="lang_selection">
    <li class="nav-item dropdown lang_dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ strtoupper(app()->getLocale()) }}
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          @foreach($language as  $lang)
              <a class="dropdown-item" href="{{ url('/')}}/lang/{{ $lang->slug }}">{{ strtoupper($lang->slug) }} <img src="{{ asset('img/profile/' . $lang->flag) }}" height=20 width=20 class="flag">)</a>
          @endforeach
      </div>
    </li>

    <li class="nav-item dropdown pull-right m-1 mb-0 mt-0">
      <a id="navbarDropdown" class="nav-link dropdown-toggle username" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><img class="rounded-circle" src="{{ asset('img/profile/' . Auth::user()->image) }}" hight=40 width=40>   {{ Auth::user()->name }}  </a>


        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('admin.profile')}}">{{ __('Profile') }}</a>
        
          <a class="dropdown-item" href="{{ route('adminLogout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">{{ __('Logout') }}
          </a>
        </div>
    </li>
  </div>  

</header>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        @include('partials.sidebar')
      </div>
    </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <!--<h1 class="h2">Dashboard</h1>-->
        </div>
        @yield('content')
      </main>
  </div>
</div>

   <form id="logout-form" action="{{ route('adminLogout') }}" method="POST" class="d-none">
    @csrf
    </form>
@endguest    
</body>
    <!-- Scripts -->
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.11.3/sorting/datetime-moment.js"></script>
    
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}" defer></script>
    
    <script type="text/javascript">
     var t = $("#table_users,#table_pages").DataTable({
            "aLengthMenu": [[10, 25, 50, 100,200,300,400,500, -1], [10, 25, 50, 100,200,300,400,500, "All"]],
            "order": [[ 2, 'desc' ]]
        });
        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
        } ).draw();

    </script>
    <script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            
            url: '/changeStatus',
            data: {'status': status, 'id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script>

<script>
  $(document).ready(function(){
    $('.delete_language').click(function(){ 
      if(confirm("{{__('Are you sure to delete language ?')}}")==true)
      { 
        var lang_id = $(this).data('id'); 
        //console.log(lang_id);
        $.ajax({ 
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: "POST",
          url: '/admin/languages/'+lang_id,         
          success: function(data)
          {
            console.log(data.success)
            window.location.href = '/admin/languages';
          }
        });
      }
    })
  })
</script>

<script>
  $(document).ready(function(){
    $('.deletepage').click(function(){ 
      if(confirm("{{__('Are you sure to delete page ?')}}")==true)
      { 
        var page_id = $(this).data('id'); 
        console.log(page_id);
        $.ajax({ 
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: "DELETE",
          url: '/admin/pages/'+page_id, 
          data: {'id': page_id},   
          success: function(data)
          {
            console.log(data.success)
            window.location.href = '/admin/pages';
          }
        });
      }
    })
  })
</script>

<script>
  $(document).ready(function(){
    $('.delete_translate').click(function(){ 
      if(confirm("{{__('Are you sure to delete translation ?')}}")==true)
      { 
        var translate_id = $(this).data('id'); 
        console.log(translate_id);
        $.ajax({ 
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: "DELETE",
          url: '/admin/translation/'+translate_id, 
          data: {'id': translate_id},   
          success: function(data)
          {
            console.log(data.success)
            window.location.href = '/admin/translation';
          }
        });
      }
    })
  })
</script>

<script>
  $(document).ready(function(){
    $('.delete_user').click(function(){ 
      if(confirm("{{__('Are you sure to delete translation ?')}}")==true)
      { 
        var user_id = $(this).data('id'); 
        console.log(user_id);
        $.ajax({ 
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type: "DELETE",
          url: '/admin/users/'+user_id, 
          data: {'id': user_id},   
          success: function(data)
          {
            console.log(data.success)
            window.location.href = '/admin/users';
          }
        });
      }
    })
  })
</script>

<!-- <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script> -->
</html>
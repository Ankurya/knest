@if(Session::has('message'))
  <div style="padding:11px;font-weight: 400;" class="alert alert-success alert-dismissible text-center alertz">{{ Session::get('message') }}</div>
@endif

@if(Session::has('success'))
  <div style="padding:11px;font-weight: 400;" class="alert alert-success alert-dismissible text-center alertz">{{ Session::get('success') }}</div>
@endif

@if(Session::has('danger'))
  <div style="padding:11px;font-weight: 400;" class="alert alert-danger alert-dismissible text-center alertz">{{ Session::get('danger') }}</div>
@endif

@if($errors->any())
    <!-- <div class="row alertz" id="alert1">
        <div class="alert alert-danger alert-dismissible fade in text-center">            
            <span>{!! $errors->first() !!}</span>
        </div>
        <div class="clearfix"></div>
    </div> -->
    <!-- <script type="text/javascript">
        $(function() {
            setTimeout(function(){
                $("#alert1").hide();
            }, 5000);
        });
    </script> -->
@endif

@if(Session::has('notification'))
    <div class="row alertz" id="alert2">
        <div class="alert alert-{{ Session::get('notification')['status'] == 'success' ? 'success' : 'danger'}} alert-dismissible fade in text-center">
            <span>{!! Session::get('notification')['message'] !!}</span>
        </div>
        <div class="clearfix"></div>
    </div>

    
@endif




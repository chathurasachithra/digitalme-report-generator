<div class="sidebar-inner slimscrollleft">

    <!--- Divider -->
    <div class="clearfix"></div>
    <hr class="divider" />
    <div class="clearfix"></div>
    <!--- Divider -->
    <div id="sidebar-menu">
        <ul>
            {{--<li class='has_sub'>--}}
                {{--<a href='javascript:void(0);'><i class='icon-user-3'></i><span>Profile</span> <span class="pull-right"><i class="fa fa-angle-down"></i></span></a>--}}
                {{--<ul>--}}
                    {{--<li><a class="user-profile" href='/user/profile'><span>View</span></a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}

            <li><a class="search-personlist" href="{{ url('user/dashboard') }}">
                    <b>Home</b><hr style="margin-bottom: 0px;">
                </a>
            </li>

            <li><a class="search-personlist" href="{{ url('report/email') }}">
                    <b>Email campaign</b> <span class="pull-right"></span><hr style="margin-bottom: 0px;">
                </a>
            </li>
            <li><a class="search-personlist" href="{{ url('report/sms') }}">
                    <b>Sms campaign</b> <span class="pull-right"></span><hr style="margin-bottom: 0px;">
                </a>
            </li>
            <li><a class="search-personlist" href="{{ url('report/whatsapp') }}">
                    <b>Whatsapp campaign</b> <span class="pull-right"></span><hr style="margin-bottom: 0px;">
                </a>
            </li>


        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div class="clearfix"></div><br><br><br>
</div>
<div class="left-footer">
    <div class="progress progress-xs">
        <div class="progress-bar bg-green-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
            <span class="progress-precentage">80%</span>
        </div>
        <a data-toggle="tooltip" title="See task progress" class="btn btn-default md-trigger" data-modal="task-progress"><i class="fa fa-inbox"></i></a>
    </div>
</div>

<script>
  jQuery(document).ready(function(){

      //auto select left side ul li items
      setTimeout(function(){
          var url = window.location.href;
          var uparams = url.split('/');
          var countstart = 3;
          var urlclassname = "";
          for(var i=countstart; i < uparams.length; i++){
              if(i == countstart) urlclassname = uparams[i];
              else urlclassname = urlclassname+"-"+uparams[i];
          }
          if(jQuery('.'+urlclassname).length == 0){
              var urlclassname = "";
              for(var i=countstart; i < uparams.length-1; i++){
                  if(i == countstart) urlclassname = uparams[i];
                  else urlclassname = urlclassname+"-"+uparams[i];
              }
          }
          if(jQuery('.'+urlclassname).length == 0){
              var urlclassname = "";
              for(var i=countstart; i < uparams.length-2; i++){
                  if(i == countstart) urlclassname = uparams[i];
                  else urlclassname = urlclassname+"-"+uparams[i];
              }
          }

          jQuery('.'+urlclassname).parents('.has_sub').find('a').first().click();
          jQuery('.'+urlclassname).addClass('slidebar-selected-item');
      }, 500*1);

  });

</script>
<!-- menu.blade.php -->
<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

        <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- ========================================================= -->
      <!-- ========== Top menu right items (ordered left) ========== -->
      <!-- ========================================================= -->

      <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->
        <li>
            <form method="post" action="{{ URL::route('language-chooser') }}"
                  style="padding:10px;"
                  class="form-horizontal" role="form">
                    <label class="" for="locale" style="float:left;color:#fff; padding-top:8px;">{{trans('backpack::crud.lang_switch')}}:</label>
                    <select class="form-control col-sm-2" name="locale" onchange="this.form.submit()" style="width:80px;">
                        <option value="tw"{{ Session::get('locale') === "tw" ? " selected" : "" }}>中文</option>
                        <option value="en"{{ Session::get('locale') === "en" ? " selected" : "" }}>English</option>
                        <option value="kr"{{ Session::get('locale') === "kr" ? " selected" : "" }}>한국어</option>
                    </select>
                {{--<input type="submit" value="Choose">--}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </li>

        @if (Auth::guest())
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/login') }}">{{ trans('backpack::base.login') }}</a></li>
            @if (config('backpack.base.registration_open'))
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/register') }}">{{ trans('backpack::base.register') }}</a></li>
            @endif
        @else
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('backpack::base.logout') }}</a></li>
        @endif

       <!-- ========== End of top menu right items ========== -->
    </ul>
</div>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">


    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/img/avatars/{{Sentinel::getUser()->avatar}}" class="img-circle" alt="User Image" />

            </div>
            <div class="pull-left info">

                <p><a href="/myprofile">{{Sentinel::getUser()->getFullName()}}</a></p>
                <a>@Today</a>
                
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="https://www.google.com/search?q=" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Google Search..." />
                <span class="input-group-btn">
                  <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
          </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"></li>

        <li class="{{(\Request::route()->getName() === 'dashboard') ? 'active' : ''}}"><a href="/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li class="{{(\Request::route()->getName() === 'altium') ? 'active' : ''}}"><a href="/altiumCmp"><i class="fa fa-cubes"></i><span>Altium Library</span></a></li>
        <li class="treeview">
        <a href="#"><i class="fa fa-bar-chart"></i><span>Projects</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="/yproject/show/dev">PCB</a></li>
                <li><a href="/yproject/manufacturers">Manufacturers</a></li>
                <li><a href="/yproject/orders">Orders</a></li>
                <!-- <li><a href="/yproject/show/cs2">CS2</a></li>
                <li><a href="/yproject/show/ts">TS</a></li> -->
            </ul>
        </li>
        <li class="treeview">
            <a href="#"><i class="fa fa-users"></i><span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="/myprofile"><i class="fa fa-user"></i>My Profile</a></li>
                <li><a href="/user"><i class="fa fa-user-md"></i>Manage Users</a></li>
                <li><a href="#"><i class="fa fa-briefcase"></i>Groups</a></li>
                <li><a href="/permissions"><i class="fa fa-lock"></i>Permissions</a></li>
            </ul>
        </li>

        <li class="treeview">
        <a href="#"><i class="fa fa-cogs"></i><span>Settings</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="/Settings/Altium/SVN">SVN</a></li>

            </ul>
        </li>
    </ul><!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>
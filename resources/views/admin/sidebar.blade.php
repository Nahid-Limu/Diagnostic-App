<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">WelCome <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="{{route ('dashbord')}}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Seetings
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link" href="{{route ('testSetting')}}">
        <i class="fas fa-fw fa-cog"></i>
        <span>Setting Test</span></a>
    </li>

    @if(Auth::user()->is_role == 'admin' || Auth::user()->is_role == 'superadmin')
    
    <li class="nav-item">
      <a class="nav-link" href="{{route ('userSetting')}}">
        <i class="fas fa-users"></i>
        <span>Setting User</span></a>
    </li>
    @endif
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Tables -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="far fa-money-bill-alt"></i>
        <span>Expense</span></a>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Expense Module:</h6>
          <a class="collapse-item" href="{{route ('dailyExpense')}}">Daily Expense</a>
          <a class="collapse-item" href="{{route ('expenseHistory')}}">Expense History</a>
          <a class="collapse-item" href="{{route ('expenseSetting')}}">Expense Settings</a>
        </div>
      </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    @if(Auth::user()->is_role == 'admin' || Auth::user()->is_role == 'superadmin')
        
    <li class="nav-item">
      <a class="nav-link" href="{{route ('report')}}">
        <i class="fas fa-file-csv"></i>
        <span>Report</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
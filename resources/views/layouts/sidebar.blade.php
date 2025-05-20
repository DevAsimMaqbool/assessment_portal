<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu">

  <div class="app-brand demo">
    <a href="/dashboard" class="app-brand-link">
      <img style="width: 175px;" src="{{ asset('admin/assets/img/avatars/superior.svg') }}">
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
      <i class="icon-base ti tabler-x d-block d-xl-none"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    
    <li class="menu-item active open">
      @if(auth()->user()->hasRole('admin'))
      <a href="{{ route('admin.dashboard') }}"  class="menu-link">
      <i class="menu-icon icon-base ti tabler-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
        </a>
      @endif
      @if(auth()->user()->hasRole('user'))
      <a href="{{ route('dashboard') }}"  class="menu-link">
      <i class="menu-icon icon-base ti tabler-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
        </a>
      @endif
      <!-- <ul class="menu-sub">
        <li class="menu-item active">
          <a href="" class="menu-link">
            <div data-i18n="Analytics">Analytics</div>
          </a>
        </li>
      </ul> -->
    </li>


    <li class="menu-item">
      <a href="/questions" class="menu-link">
        <i class="menu-icon icon-base ti tabler-message-star"></i>
        <div data-i18n="Self-Assessment Form">Self-Assessment Form</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="/stakeholder" class="menu-link">
        <i class="menu-icon icon-base ti tabler-users-group"></i>
        <div data-i18n="Stakeholder Submission Status">Stakeholder Submission Status</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="{{ route('selfFeedback') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-message-heart"></i>
        <div data-i18n="View Reports">View Reports</div>
      </a>
    </li>
    <li class="menu-item">
    @if(auth()->user()->hasRole('admin'))
      <a href="{{ route('admin.users.index') }}"  class="menu-link">
      <i class="menu-icon icon-base ti tabler-users"></i>
        <div data-i18n="Users">Users</div>
        </a>
      @endif
    </li>
     <li class="menu-item">
      <a href="{{ route('complanits.index') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-message-heart"></i>
        <div data-i18n="View Reports">Complaints</div>
      </a>
    </li>
    <!-- <li class="menu-item active">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon icon-base ti tabler-settings"></i>
        <div data-i18n="Roles & Permissions">Roles & Permissions</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="" class="menu-link">
            <div data-i18n="Roles">Roles</div>
          </a>
        </li>
        <li class="menu-item active">
          <a href="{{ route('permission.index') }}" class="menu-link">
            <div data-i18n="Permission">Permission</div>
          </a>
        </li>
      </ul>
    </li> -->
    <!-- Charts & Maps -->
    <li class="menu-header small">
      <span class="menu-header-text" data-i18n="Charts & Maps">Charts &amp; Maps</span>
    </li>
    <li class="menu-item active">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon icon-base ti tabler-chart-pie"></i>
        <div data-i18n="Reports">Reports</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item active">
          <a href="/chart" class="menu-link">
            <div data-i18n="Reports">Reports</div>
          </a>
        </li>
      </ul>
    </li>

  </ul>

</aside>

<div class="menu-mobile-toggler d-xl-none rounded-1">
  <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
    <i class="ti tabler-menu icon-base"></i>
    <i class="ti tabler-chevron-right icon-base"></i>
  </a>
</div>
<!-- / Menu -->
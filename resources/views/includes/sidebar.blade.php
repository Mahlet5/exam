<?php

use App\Role;

?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset(Auth::user()->profile->avatar) }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      {{-- Its an admin :) --}}
      @if(Auth::user()->role_id==1){
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Site</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('users') }}"><i class="fa fa-circle-o"></i> Users</a></li>
            <li><a href="{{ route('roles') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
            <li><a href="{{ route('site.settings') }}"><i class="fa fa-circle-o"></i> Settings</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Lookups</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Log Viewer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/log-viewer"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            {{-- <li><a href="{{ route('items') }}"><i class="fa fa-circle-o"></i> Logs</a></li> --}}
          </ul>
        </li>
      }@endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

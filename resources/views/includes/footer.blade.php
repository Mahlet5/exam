<?php
  use App\Setting;
?>
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b></b> 
  </div>
  <strong>Copyright &copy; {{ date('Y') }} {{ Setting::find(1)->site_name }}
</footer>

@php
  $setting = \Modules\Setting\Entities\Setting::first();
@endphp
<footer class="footer">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4"> </div>
      <div class="col-lg-6">
        <div class="copyright text-sm text-muted text-lg-end">
          {!! $setting->copyright !!}
        </div>
      </div>
    </div>
  </div>
</footer>

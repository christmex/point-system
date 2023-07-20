@extends(backpack_view('layouts.plain'))

@once
  @push('befor_styles')
  <livewire:styles/>
  @endpush
@endonce

@section('content')
<header class="d-print-none {{ backpack_theme_config('classes.topHeader') ?? 'd-none d-lg-block px-3 navbar navbar-expand-md navbar-light' }}">
    <div class="{{ backpack_theme_config('options.useFluidContainers') ? 'container-fluid' : 'container-xl' }}">
        <div class="{{ backpack_theme_config('options.useFluidContainers') ? 'container-fluid' : 'container-xl' }} d-flex align-items-center justify-content-between">
            <a class="h2 text-decoration-none mb-0" href="{{ url(backpack_theme_config('home_link')) }}" title="{{ backpack_theme_config('project_name') }}">
                {!! backpack_theme_config('project_logo') !!}
            </a>
            <div class="navbar-nav">
                @include(backpack_view('inc.menu'))
            </div>
        </div>
    </div>
</header>

<div class="page-body">
    <div class="container-xl">
        <livewire:guest.check-student-reward />
    </div>
</div>
@endsection

@once
  @push('after_scripts')
    <livewire:scripts/>
    <script>
    window.addEventListener('alert_dispatch', event => {
      new Noty({
          type: event.detail.type,
          text: event.detail.text,
      }).show();
    })
    </script>
  @endpush
@endonce
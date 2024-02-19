    {{-- start header --}}
        @include('admin_layout.header')
    {{-- end header --}}

    {{-- start left sidebar --}}
        @include('admin_layout.leftsidebar')
    {{-- end left sidebar --}}

  {{-- start content --}}
    @yield('content')
  {{-- end content --}}


  {{-- start of footer --}}
    @include('admin_layout.footer')
 {{-- end of footer --}}

    @yield('scripts')

</body>
</html>


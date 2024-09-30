@yield('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}"/>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link href='//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css' rel='stylesheet'>
@yield('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}"/>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ localized_route('tourist.publish') }}">{{ __('Publish a project') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ localized_route('tourist.login') }}">{{ __('Tourist login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ localized_route('pro.login') }}">{{ __('Tourism professionals access') }}</a>
                    </li>
                @else
                    @php
                        $type = Auth::user()->type
                    @endphp

                    @if ($type == 'tourist')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ localized_route('tourist.publish') }}">{{ __('Publish a project') }}</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>
                        </li>
                    @else
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->name }}</span>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form id="logout-form" action="{{ localized_route($type . '.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="nav-link" href="{{ localized_route($type . '.logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>

                @endguest

                <li class="nav-item">
                    @php
                        $languages = Config::get('constants.languages')[locale()];
                    @endphp
                    @foreach ($languages as $code => $label)
                        @if ($code == locale())
                            @continue
                        @endif
                        <a class="nav-link" href="{{ current_route($code) }}">{{ $label }}</a>
                    @endforeach
                </li>
            </ul>
        </div>
    </div>
</nav>
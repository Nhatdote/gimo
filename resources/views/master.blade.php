<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GIMO DEMO</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>

    <div id="gimo" class="d-flex flex-column" style="height: 100vh; overflow: hidden">
        <div id="header" class="pb-3">
            <div class="p-2 bg-success text-center">
                <h3 class="text-white">{{ __('🙆‍♂️ HELLO GIMO 🙆‍♂️') }}</h3>
            </div>

            @if ($crumbs = config('gimo.crumbs'))
                <div id="crumb" style="background-color: whitesmoke">
                    <div class="container">
                        <div class="d-flex p-2 align-items-center">
                            @foreach ($crumbs as $k => $c)
                                @if (empty($c['url']))
                                    <span class="d-flex align-items-center text-muted">
                                        <ion-icon name="{{ $c['icon'] }}" class="mr-1"></ion-icon>
                                        {{ $c['label'] }}
                                    </span>
                                @else
                                    <a href="{{ $c['url'] }}" class="d-flex align-items-center">
                                        <ion-icon name="{{ $c['icon'] }}" class="mr-1"></ion-icon>
                                        {{ $c['label'] }}
                                    </a>
                                @endif

                                @if ($k < count($crumbs) - 1)
                                    <ion-icon name="chevron-forward-outline" class="text-muted mx-2"></ion-icon>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div id="main" style="overflow: auto; flex-grow: 1">
            @yield('content')
        </div>
    </div>

</body>

</html>

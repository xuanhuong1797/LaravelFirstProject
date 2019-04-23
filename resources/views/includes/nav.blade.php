<div class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Foodzi</a>
        <button class="navbar-toggler order-first" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <!-- account toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#account" aria-controls="navbarResponsive"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-user"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Categories</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach ($allCategories as $category)
                        <a class="dropdown-item" href="{{ route('category.show',[$category->slug]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" id="searchInput" type="search" placeholder="Search" aria-label="Search">
                <div id="livesearch">
                </div>
            </form>
        </div>
        <div class="collapse navbar-collapse" id="account">
            <ul class="navbar-nav ml-auto">
                @guest
                <li>
                    <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                            <img src="{{ URL::to('/') }}/{{ Auth::user()->avatar_url }}" alt="Profile Avatar" class="profile-image rounded-circle "> {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a href="{{ URL::to('/') }}/user/{{ Auth::user()->username }}" class="dropdown-item">My Profile</a>
                        <a href="{{ URL::to('/') }}/product/create" class="dropdown-item">Upload your product</a>
                        <a href="{{ URL::to('/') }}/changepassword" class="dropdown-item">Change password</a> @if (Auth::user()->can('view
                        admin'))
                        <a href="{{ route('admin.i>ndex') }}" class="dropdown-item">Admin page</a> @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</div>

@section('script')
<script>
    $('#searchInput').on('keyup', function () {
            var input = $(this).val();
            var html = '';
            if (input.length == 0) {
                $('#livesearch').html('');
                $('#livesearch').css("border:0px");
                return;
            } else {
                $.ajax({
                    url: '/product/search',
                    method: 'post',
                    data: {
                        data: input,
                    },
                    success: function (data) {

                        $.each(JSON.parse(data), function (i, item) {
                            html += '<div class="liveSearchResult">';
                            html += '<div class="liveSearchResult-name">';
                            html += '<a href="' + document.location.origin +
                                '/product/' +
                                item.slug +
                                '">';
                            html += item.name + '</a>';
                            html += '</div>';
                            html += '<div clss="liveSearchResult-address">';
                            html += item.address;
                            html += '</div>'
                            html += '</div>';
                        });
                        $('#livesearch').html(html);
                        $('.liveSearchResult').css({
                            "background-color": "#fff",

                            "margin-bot": "10px",
                        });
                    }
                });

            }
        });
    });
</script>
@endsection

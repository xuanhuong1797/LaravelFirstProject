@extends('layouts.master') 
@section('style')
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-img-top">
                    <img src="{{ URL::to('/') }}/{{ $user->avatar_url }}" class="rounded-circle" style=" display: block;margin: auto; width: 200px;width: 200px"
                        alt="">
                </div>
                <div class="card-body">
                    <h3 style="font-size: 25px">{{ $user->name }}</h3>
                    <p style="font-size: 15px">Tham gia ngày: {{ $user->created_at->format('d-m-Y') }}</p>
                </div>
                <div class="card-footer">
                    @if(Auth::check())
                        @if($user->id === Auth::user()->id || Auth::user()->hasRole('admin'))
                            <a href="{{ route('user.edit',[$user->id]) }}" class="btn btn-primary">Edit Profile</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#posted" role="tab" aria-controls="pills-home" aria-selected="true">Sản phẩm đã đăng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#loved" role="tab" aria-controls="pills-profile" aria-selected="false">Sản phẩm đã thích</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="posted" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="list-group">
                        @foreach($products as $product)
                            @if(!$product->published)
                                @if(Auth::check())
                                    @if(Auth::user()->id != $product->user_id)
                                        @continue
                                    @endif
                                    @else
                                    @continue
                                @endif
                            @endif
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        @foreach($product->image as $item) 
                                            @if($item->first())
                                                <figure class="float-left">
                                                    <img class="img-thumbnail" src="{{ URL::to('/') }}/{{ $item->image_url }}" alt="" style="height: 150px;">
                                                </figure>
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <a class="list-group-item-heading" href="{{ route('product.show',[$product->slug]) }}">{{ $product->name }}</a>
                                        <p>Giá tiền : {{ $product->price }}</p>
                                        <p>Địa chỉ : {{ str_limit($product->address,35) }}</p>
                                        {{--
                                        <p class="list-group-item-text">{{ $product->description }}</p> --}}
                                        <p style="display: inline">{{ Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</p>
                                        <button class="item-add-love" id="{{ $product->id }}">
                                            <i class="fa fa-heart item-love" aria-hidden="true" style="color :{{ Auth::check()?Auth::user()->love()->where('product_id', $product->id)->first() ? Auth::user()->love()->where('product_id', $product->id)->first()->loved == 1 ? 'red' : 'gray' : 'gray': 'gray' }}">
                                                {{ $product->love }}</i>
                                        </button>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{ str_limit($product->description,80) }}</p>
                                        <div class="product-status">
                                            @if($product->published)
                                                <i class="fas fa-check-circle"></i>
                                                @else
                                                <i class="fas fa-times-circle"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $products->links() }}
                </div>
                <div class="tab-pane fade" id="loved" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="list-group">
                        <div class="list-group">
                            @foreach($lovedProducts as $product)
                                @if(!$product->published) 
                                    @continue
                                @endif
                                <div class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            @foreach($product->image as $item) 
                                                @if($item->first())
                                                    <figure class="float-left">
                                                        <img class="img-thumbnail" src="{{ URL::to('/') }}/{{ $item->image_url }}" alt="">
                                                    </figure>
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-md-6">
                                            <a class="list-group-item-heading" href="{{ route('product.show',[$product->slug]) }}">{{ $product->name }}</a>
                                            <p>Giá tiền : {{ $product->price }}</p>
                                            <p>Địa chỉ : {{ str_limit($product->address,35) }}</p>
                                            {{--
                                            <p class="list-group-item-text">{{ $product->description }}</p> --}}
                                            <p style="display: inline">{{ Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</p>
                                            <button class="item-add-love" id="{{ $product->product_id }}">
                                                <i class="fa fa-heart item-love" aria-hidden="true" style="color :{{ Auth::check()?Auth::user()->love()->where('product_id', $product->product_id)->first() ? Auth::user()->love()->where('product_id', $product->product_id)->first()->loved == 1 ? 'red' : 'gray' : 'gray': 'gray' }}">
                                                    {{ $product->love }}</i>
                                            </button>
                                        </div>
                                        <div class="col-md-3">
                                            <p>{{ str_limit($product->description,80) }}</p>
                                            <div class="product-status">
                                                @if($product->published)
                                                    <i class="fas fa-check-circle"></i>
                                                    @else
                                                    <i class="fas fa-times-circle"></i>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $lovedProducts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/addlove.js') }}"></script>
@endsection
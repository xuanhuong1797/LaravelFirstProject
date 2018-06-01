@extends('layouts.master') 
@section('style')
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content') 
    @foreach($categories as $category)
        <div class="card-deck-wraper">
            <h3 style="background-image: url('{{ URL::to('/') }}/{{ $category->image_url }}')">{{ $category->name }}</h1>
                <div class="card-deck">
                    @foreach($category->productPublished->sortByDesc('created_at')->take(5) as $item)
                        <div class="card">
                            <div class="card-img-top">
                                @foreach($item->image as $image)
                                    @if($image->first())
                                        <img class="card-img-top img-fluid" src="{{ URL::to('/') }}/{{ $image->image_url }}" alt="">
                                        @break
                                    @endif
                                @endforeach
                                <button class="item-add-love btn btn-light" id="{{ $item->id }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <a class="card-title item-name" href="{{ route('product.show',[$item->slug]) }}">{{ $item->name }}</a>
                                <span class="card-text item-address" href="">{{ $item->address }}</span>
                                <i class="fa fa-heart float-right item-love" aria-hidden="true" style="color: {{ Auth::check() ? Auth::user()->love()->where('product_id', $item->id)->first() ? Auth::user()->love()->where('product_id', $item->id)->first()->loved == 1 ? 'red' : 'gray' : 'gray' : 'gray' }}">
                                    <span class=""> {{ $item->love }}</span>
                                </i>
                            </div>
                            <div class="card-footer">
                                <img src="{{ URL::to('/') }}/{{ $item->user->avatar_url }}" class="rounded-circle item-creator-avatar"
                                    alt="">
                                <a href="{{ URL::to('/') }}/user/{{ $item->user->username }}" class="item-creator-name">{{ $item->user->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="float-right category-show" href="{{ route('category.show',['id' => $category->slug]) }}">Xem toàn bộ
                    <i class="fas fa-angle-right"></i>
                </a>
        </div>
    @endforeach
@endsection

@section('script')
    <script src="{{ asset('js/index.js') }}"></script>
    
    <!-- <script src="{{ asset('js/addlove.js') }}"></script> -->
@endsection
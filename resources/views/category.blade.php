@extends('layouts.master')
@section('style')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2 hidden-sm left-sidebar">
            <ul class="category-sidebar-list">
                @foreach($allCategories as $item)
                    <li>
                        <a href="{{ route('category.show',[$item->slug]) }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-10 main-content">
            <div class="list-group">
                @foreach($products as $product)
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-md-3">
                                @foreach($product->image as $item)
                                    @if($item->first())
                                        <figure class="float-left">
                                            <img class="img-fluid" src="{{ URL::to('/') }}/{{ $item->image_url }}" alt="">
                                        </figure>
                                        @break
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <a class="list-group-item-heading" href="{{ route('product.show',[$product->slug]) }}">{{ $product->name }}</a>
                                <p>Gía tiền : {{ $product->price }}</p>
                                <p>Địa chỉ : {{ $product->address }}</p>
                                {{--
                                <p class="list-group-item-text">{{ $product->description }}</p> --}}
                                <p style="display: inline">{{ Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</p>
                                <button class="item-add-love" id="{{ $product->id }}">
                                    <i class="fa fa-heart item-love" aria-hidden="true" style="color :{{ Auth::check()?Auth::user()->love()->where('product_id', $product->id)->first() ? Auth::user()->love()->where('product_id', $product->id)->first()->loved == 1 ? 'red' : 'gray' : 'gray': 'gray' }}">
                                        {{ $product->love }}</i>
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('user.show',[$product->user->username]) }}">{{ $product->user->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $products->links() }}
        </div>

    </div>
@endsection

@section('script')

    <script src="{{ asset('js/addlove.js') }}"></script>
@endsection

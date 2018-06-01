@extends('layouts.master') 
@section('style')
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row item-container">
        <div class="col-md-6">
            <div class="image-top" style="display: block">
                <img src="{{ URL::to('/') }}/{{ $images->first()->image_url }}" alt="">
            </div>
            <div class="image-bot d-flex justify-content-center">
                @foreach ($images->take(4) as $item)
                    <div class="image-bot-container">
                        <img src="{{ URL::to('/') }}/{{ $item->image_url }}" alt="" class="">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="name-container">
                <h3>{{ $product->name }}</h3>
            </div>
            <div class="price-container">
                <span class="lable">Price : </span>
                <span class="price">{{ $product->price }} đ</span>
            </div>
            <div class="address-contrainer">
                <span class="lable">Address : </span>
                <span class="address">{{ $product->address }}</span>
            </div>

            <div class="creator-container">
                <img src="{{ URL::to('/') }}/{{ $user->avatar_url }}" alt="">
                <a class="creator-name" href="{{ URL::to('/') }}/user/{{ $user->username }} ">{{ $user->name }}</a>
                @if (Auth::check())
                    @if (Auth::user()->id != $product->user_id)
                        <button>Follow</button>
                    @endif
                @endif
            </div>
            <div class="description-container">
                <p>{{ $product->description }}</p>
            </div>
            <div class="button-container">
                <button class="item-add-love" id="{{ $product->id }}">
                    <i class="fa fa-heart item-love" aria-hidden="true" style="color :{{ Auth::check() ? Auth::user()->love()->where('product_id', $product->id)->first() ? Auth::user()->love()->where('product_id', $product->id)->first()->loved == 1 ? 'red' : 'gray' : 'gray': 'gray' }}">
                        {{ $product->love }}</i>
                </button>
                <div class="product-control">
                    @if (Auth::check())
                        @if (Auth::user()->can('edit products') || Auth::user()->id == $user->id)
                            <a class="btn btn-info" id="editProduct" href="{{ route('product.edit',[$product->id]) }}">
                                Edit Product
                            </a>
                        @endif
                        @if (Auth::user()->can('delete products') || Auth::user()->id == $user->id)
                            <button class="btn btn-danger" id="deleteProduct">
                                Delete Product
                            </button>
                        @endif
                        @if (Auth::user()->can('publish products') ||Auth::user()->can('unpublish products') )
                            @if ($product->published)
                                <button class="btn btn-primary" id="publishProduct">
                                    Unpublish
                                </button>
                                @else
                                <button class="btn btn-primary" id="publishProduct">
                                    Publish
                                </button>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>

    </div>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-3">
            <div class="card" style="margin:2.5rem auto 0;">
                <div class="card-block text-center">
                    <div class="rating-block">
                        <h4>Average user rating</h4>

                        <h2 class="bold padding-bottom-7">
                            @php
                                $avg = 0; $j =0; $sum = 0; $t = 0; $count = 0; foreach($rating as $item){ $sum +=$item->value*$item->count; $count+=$item->count;
                                } if($count == 0){ $avg = 0; } else { $avg=$sum/$count; }
                            @endphp
                            <small>{{ number_format($avg, 1, '.', ',') }}
                                / 5
                            </small>
                        </h2>
                        @for ($i = 1; $i <= $avg; $i ++)
                            <i class="fas fa-star"></i>
                        @endfor

                    </div>
                    <br>
                    <div class="rating-process">

                        @for ($i = 1; $i <= 5; $i ++)
                            @php
                                if(isset($rating[$j])){ if($rating[$j]->value == $i){ $t = $rating[$j]->count; $j++; } else{ $t = 0; } } else{ $t = 0; }
                            @endphp
                            <span style="float: left; margin-right: 10px;margin-top: -5px">{{ $i }}</span>
                            <div class="progress" style="height: 10px;width: 80%; float: left;">
                                <div class="progress-bar bg-info" style="width:{{ $sum == 0 ? 0 : ($t/$sum)*100 }}%"></div>
                            </div>
                            <span style="float: right;margin-right: 10px;margin-top: -5px">{{ $t }}</span>
                            <br>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="comments">
                <ul>
                    @if (Auth::check() && !isset($userComment))
                        <li>
                            <div class="comment-wrap">
                                <div class="photo">
                                    <div class="avatar" style="background-image: url(
                            '{{ URL::to('/') }}/{{ Auth::user()->avatar_url }}')"></div>
                                </div>
                                <div class="comment-block">
                                    <form id="commentForm">
                                        <textarea name="commentBody" id="" cols="30" rows="5" name="commentText
                           " placeholder="Add review..."></textarea>
                                        <div class="rating-wrapper" style="right: 0%">
                                            <input type="radio" class="rating-input" id="rating-input-1-5" value="5
                           " name="rating" />
                                            <label for="rating-input-1-5" class="rating-star"></label>
                                            <input type="radio" class="rating-input" id="rating-input-1-4" value="4
                           " name="rating" />
                                            <label for="rating-input-1-4" class="rating-star"></label>
                                            <input type="radio" class="rating-input" id="rating-input-1-3" value="3" name="rating" />
                                            <label for="rating-input-1-3" class="rating-star"></label>
                                            <input type="radio" class="rating-input" id="rating-input-1-2" value="2" name="rating" />
                                            <label for="rating-input-1-2" class="rating-star"></label>
                                            <input type="radio" class="rating-input" id="rating-input-1-1" value="1" name="rating" />
                                            <label for="rating-input-1-1" class="rating-star"></label>
                                        </div>
                                        <button type="submit" style="float: right;" class="btn btn-success" id="comment-add">Save</button>
                                        <button type="reset" style="float: right;" class="btn btn-default">Cannel</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endif
                    <!-- Comment from Auth::user -->
                    @if (isset($userComment))
                        @if ($userComment->parent_id == null)

                            <li>
                                <div class="comment-wrap">
                                    <div class="photo">
                                        <div class="avatar" style="background-image: url(
                            '{{ URL::to('/') }}/{{ $userComment->user->avatar_url }}')"></div>
                                    </div>
                                    <div class="comment-block">
                                        <div class="comment-user">
                                            <a href="{{ URL::to('/') }}/user/{{ $userComment->user->username }}">{{ $userComment->user->username }} </a>
                                            @if (isset($userComment->rating->value))
                                                <span class="user-rating" id="{{ $userComment->rating->value }}">
                                                    {{ $userComment->rating->value }}
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <p class="comment-text">{{ $userComment->body }}</p>
                                        <div class="bottom-comment">
                                            <div class="comment-id" id="{{ $userComment->id }}">#{{ $userComment->id }} </div>
                                            <div class="comment-date">{{ $userComment->updated_at->diffForHumans() }}</div>
                                            <ul class="comment-actions">
                                                @if ($userComment->user_id === Auth::user()->id || Auth::user()->can('edit comments'))
                                                    <li class="edit">Edit</li>
                                                @endif
                                                @if ($userComment->user_id === Auth::user()->id || Auth::user()->can('delete comments'))
                                                    <li class="delete">Delete</li>
                                                @endif
                                                <li class="reply">Reply</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if ($userComment->replies)
                                    <ul class="comment-reply">
                                        @foreach ($userComment->replies as $reply)
                                            <li>
                                                <div class="comment-wrap">
                                                    <div class="photo">
                                                        <div class="avatar" style="background-image: url( '{{ URL::to('/') }}/{{ $reply->user->avatar_url }}')"></div>
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-user">
                                                            <a href="{{ URL::to('/') }}/user/{{ $reply->user->username }}">{{ $reply->user->username }} </a>
                                                        </div>

                                                        <p class="comment-text">{{ $reply->body }}</p>

                                                        <div class="bottom-comment">
                                                            <div class="comment-id" id="{{ $reply->id }}">#{{ $reply->id }}</div>
                                                            <div class="comment-date">{{ $reply->updated_at->diffForHumans() }}</div>
                                                            <ul class="comment-actions">
                                                                @if (Auth::check())
                                                                    @if ($reply->user_id == Auth::user()->id || Auth::user()->can('edit comments'))
                                                                        <li class="editReply">Edit</li>
                                                                    @endif
                                                                    @if ($reply->user_id == Auth::user()->id || Auth::user()->can('delete comments'))
                                                                        <li class="delete">Delete</li>
                                                                    @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endif
                    <!-- Comment diffirent from Auth::user -->
                    @foreach ($comments as $comment)
                        @if ($comment->parent_id == null)
                            <li>
                                <div class="comment-wrap">
                                    <div class="photo">
                                        <div class="avatar" style="background-image: url(
                            '{{ URL::to('/') }}/{{ $comment->user->avatar_url }}')"></div>
                                    </div>
                                    <div class="comment-block">
                                        <div class="comment-user">
                                            <a href="{{ URL::to('/') }}/user/{{ $comment->user->username }}">{{ $comment->user->username }} </a>
                                            @if (isset($comment->rating->value))
                                                <span class="user-rating" id="{{ $comment->rating->value }}">
                                                    {{ $comment->rating->value }}
                                                </span>
                                                <i class="fas fa-star"></i>
                                            @endif
                                        </div>
                                        <p class="comment-text">{{ $comment->body }}</p>
                                        <div class="bottom-comment">
                                            <div class="comment-id" id="{{ $comment->id }}">#{{ $comment->id }}</div>
                                            <div class="comment-date">{{ $comment->updated_at->diffForHumans() }}</div>
                                            <ul class="comment-actions">
                                                @if (Auth::check())
                                                    @if ($comment->user_id == Auth::user()->id || Auth::user()->can('edit comments'))
                                                        <li class="edit">Edit</li>
                                                    @endif
                                                    @if ($comment->user_id == Auth::user()->id || Auth::user()->can('delete comments'))
                                                        <li class="delete">Delete</li>
                                                    @endif
                                                @endif
                                                <li class="reply">Reply</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @if ($comment->replies)
                                    <ul class="comment-reply">
                                        @foreach ($comment->replies as $reply)
                                            <li>
                                                <div class="comment-wrap">
                                                    <div class="photo">
                                                        <div class="avatar" style="background-image: url('{{ URL::to('/') }}/{{ $reply->user->avatar_url }}')"></div>
                                                    </div>
                                                    <div class="comment-block">
                                                        <div class="comment-user">
                                                            <a href="{{ URL::to('/') }}/user/{{ $reply->user->username }}">{{ $reply->user->username }} </a>

                                                        </div>
                                                        <p class="comment-text">{{ $reply->body }}</p>
                                                        <div class="bottom-comment">
                                                            <div class="comment-id" id="{{ $reply->id }}">#{{ $reply->id }}</div>
                                                            <div class="comment-date">{{ $reply->updated_at->diffForHumans() }}</div>
                                                            <ul class="comment-actions">
                                                                @if (Auth::check())
                                                                    @if ($reply->user_id == Auth::user()->id || Auth::user()->can('edit comments'))
                                                                        <li class="edit">Edit</li>
                                                                    @endif
                                                                    @if ($reply->user_id == Auth::user()->id || Auth::user()->can('delete comments'))
                                                                        <li class="delete">Delete</li>
                                                                    @endif
                                                                @endif

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/addlove.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
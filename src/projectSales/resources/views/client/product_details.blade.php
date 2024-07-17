@extends('layout.newlayout')

@section('title', 'Chi tiết sản phẩm')

<link rel="stylesheet" href="{{ asset('css/prodetail.css') }}">

@section('content')
<div class="main-content">
    <div class="product-details left-aligned">
        <div class="product-info">
            <h2>{{ $product->name }}</h2>
            <div class="product-images">
                @foreach($product->productColors as $productColor)
                    <img class="product-image" src="{{ asset('images/' . $productColor->img) }}" alt="Product Image">
                @endforeach
            </div>
            <p class="price">Giá: {{ number_format($product->price_sell) }} VNĐ</p>
            <p>Mô tả: {!! $product->description !!}</p>
        </div>
    </div>

    <div>
        <form id="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="form-group">
                <label for="product_color_id">Màu sắc:</label>
                <select name="product_color_id" id="product_color_id" required>
                    @foreach($product->productColors as $productColor)
                        <option value="{{ $productColor->id }}">{{ $productColor->color->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="size_id">Size:</label>
                <select name="size_id" id="size_id" required>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
        </form>
    </div>
</div>

<div class="product-feedback">
    <form action="{{ route('product_feedback.store', $product->id) }}" method="POST">
        @csrf
        <div class="form-header">
            <h2 id="ratingTitle" class="form-title">Đánh giá sản phẩm</h2>
            <h2 id="commentTitle" class="form-title" style="display: none;">Bình luận</h2>
        </div>
        <div class="product-rating">
            <div>
                <p>Đánh giá của bạn:</p>
                <label>
                    <input value="1" type="radio" name="ratingStar">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </label>
            </div>
            <div>
                <label>
                    <input value="2" type="radio" name="ratingStar">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </label>
            </div>
            <div>
                <label>
                    <input value="3" type="radio" name="ratingStar">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </label>
            </div>
            <div>
                <label>
                    <input value="4" type="radio" name="ratingStar">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </label>
            </div>
            <div>
                <label>
                    <input value="5" type="radio" name="ratingStar">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="content">Nội dung đánh giá:</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
    </form>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h3>Đánh giá của khách hàng</h3>
    <div class="average-rating">
        <p>Trung bình: {{ number_format($averageRating, 1) }} <i class="fa fa-star" aria-hidden="true"></i></p>
    </div>
    <div class="swiper-wrapper">
        <div class="swiper-slide_item" style="width: 100px;">
            <button class="tab-btn button button-rating rating-all active" style="padding-left: 20px;" role="tab" id="all-class-content" aria-selected="true" data-filter="0" tabindex="-1" aria-controls="tab-all-class">
                Tất cả
                <span class="rating-all-length ml1">({{ $feedbacks->count() }})</span>
            </button>
        </div>
        <div class="swiper-slide_item">
            <button class="tab-btn button button-rating rating-5" role="tab" id="rating-5" aria-selected="false" data-filter="5" tabindex="-1" aria-controls="tab-5-rating-class">
                5 sao <span class="rating-5-length ml1">({{ $feedbacks->where('rating', 5)->count() }})</span>
            </button>
        </div>
        <div class="swiper-slide_item">
            <button class="tab-btn button button-rating rating-4" role="tab" id="rating-4" aria-selected="false" data-filter="4" tabindex="-1" aria-controls="tab-4-rating-class">
                4 sao <span class="rating-4-length ml1">({{ $feedbacks->where('rating', 4)->count() }})</span>
            </button>
        </div>
        <div class="swiper-slide_item">
            <button class="tab-btn button button-rating rating-3" role="tab" id="rating-3" aria-selected="false" data-filter="3" tabindex="-1" aria-controls="tab-3-rating-class">
                3 sao <span class="rating-3-length ml1">({{ $feedbacks->where('rating', 3)->count() }})</span>
            </button>
        </div>
        <div class="swiper-slide_item">
            <button class="tab-btn button button-rating rating-2" role="tab" id="rating-2" aria-selected="false" data-filter="2" tabindex="-1" aria-controls="tab-2-rating-class">
                2 sao <span class="rating-2-length ml1">({{ $feedbacks->where('rating', 2)->count() }})</span>
            </button>
        </div>
        <div class="swiper-slide_item swiper-slide-last">
            <button class="tab-btn button button-rating rating-1" role="tab" id="rating-1" aria-selected="false" data-filter="1" tabindex="-1" aria-controls="tab-1-rating-class">
                1 sao <span class="rating-1-length ml1">({{ $feedbacks->where('rating', 1)->count() }})</span>
            </button>
        </div>
    </div>

    <div id="feedback-container">
        @foreach($feedbacks as $feedback)
        <div class="feedback-item" data-rating="{{ $feedback->rating }}">
            <div class="feedback-header">
                <strong>{{ $feedback->user->name }}</strong> - {{ $feedback->created_at->format('d/m/Y') }}
            </div>
            <div class="feedback-rating">
                @for($i = 0; $i < $feedback->rating; $i++)
                    <i class="fa fa-star" aria-hidden="true"></i>
                @endfor
            </div>
            <div class="feedback-content">
                <p>{{ $feedback->content }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

<script src="{{ asset('js/xuli_chon_size.js') }}"></script>

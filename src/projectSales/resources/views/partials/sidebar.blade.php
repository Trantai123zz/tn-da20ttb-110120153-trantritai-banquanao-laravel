<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<div class="sidebar-container">
    <div class="category-section">
        <h5>Danh mục</h5>
        <ul class="category-list">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('categories.filter', ['categoryId' => $category->id]) }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="brand-section">
        <h5>Thương hiệu</h5>
        <ul class="brand-list">
            @foreach($brands as $brand)
                <li>
                    <a href="{{ route('product.filterByBrand', ['brandId' => $brand->id]) }}">
                        {{ $brand->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

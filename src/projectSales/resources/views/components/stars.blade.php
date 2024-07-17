@for($i = 1; $i <= 5; $i++)
    @if($i <= $number)
        <i class="fas fa-star" style="color: gold;"></i>
    @else
        <i class="fas fa-star" style="color: lightgray;"></i>
    @endif
@endfor

<ul>
    <style>
       .media {
    width: 312px;
    padding: 10px;
    margin-top: -14px;
    border: none;
     }
     .media-body p {
    float: left;
    font-size: 14px;
    font-weight: normal;
    line-height: 16px;
    margin-left: 8px;
}
    </style>
    @forelse ( $adsList as $item)
    <li>
        <div class="media">
            <img class="rounded" src="{{ uploaded_asset($item->photos) }}" height="40px" width="40px" alt="" />
            <div class="media-body">
              <a href="{{ route('customer.product', $item->slug) }}"><p class="ads-name">{{ $item->name }}</p></a>
            </div>
          </div>

    </li>
    @empty
    <li class="text-danger text-center">Product Not Found!</li>
    @endforelse

</ul>

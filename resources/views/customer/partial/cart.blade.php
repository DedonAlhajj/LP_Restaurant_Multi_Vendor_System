<div class="offcanvas offcanvas-bottom rounded-0" tabindex="-1" id="offcanvasBottom1">
  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
      <i class="fa-solid fa-xmark"></i>
  </button>
  <div class="offcanvas-body container fixed">
      <div class="item-list style-2">

          <ul>
            @if(Cart::isEmpty())
            <h3 class="text-center">Your Cart is Empty</h3>
            @else
            @foreach(Cart::getContent() as $item)
              <li class="item_{{$item->id}}"> 
                  <div class="item-content">
                      <div class="item-media media media-60">
                          <img src="{{asset('customer/assets/images/food/pic6.png')}}" alt="logo">
                      </div>
                      <div class="item-inner">
                          <div class="item-title-row">
                              <h6 class="item-title"><a href="order-list.html">{{ $item->name }}</a></h6>
                              <div class="item-subtitle">Coffe, Milk</div>
                          </div>


                          <div class="item-footer">
                              <div class="d-flex align-items-center">
                                  <h6 class="me-3">$ {{ $item->price }}</h6>
                                  {{-- <del class="off-text"><h6>$ 8.9</h6></del> --}}
                              </div>
                              <div class="d-flex align-items-center">
                                  <div class="dz-stepper border-1 ">
                                      <input class="stepper" type="text" value="{{ $item->quantity }}" name="demo3">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <form action="{{ route('cart.remove',$slug) }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button class="btn btn-icon btn-icon-end btn-primary btn-remove" type="submit"><i class="fa-solid fa-trash"></i></button>
                    </form>
                  </div>
              </li>
              @endforeach
          </ul>
      </div>
      <div class="view-title">
          <div class="container">
              <ul>
                  {{-- <li>
                      <a href="javascript:void(0);" class="promo-bx">
                          Apply Promotion Code
                          <span>2 Promos</span>
                      </a>
                  </li> --}}
                  <li>
                      <span>Subtotal</span>
                      <span>$ {{ Cart::getTotal() }}</span>
                  </li>
                  {{-- <li>
                      <span>TAX (2%)</span>
                      <span>-$1.08</span>
                  </li> --}}
                  <li>
                      <h5>Total</h5>
                      <h5>$ {{ Cart::getTotal() }}</h5>
                  </li>
              </ul>
              <a href="{{ route('order.confirmation',$slug) }}" class="btn btn-primary btn-rounded btn-block flex-1 ms-2">CONFIRM</a>
          </div>
      </div>
      @endif
  </div>
</div>

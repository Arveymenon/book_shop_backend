<div class="o-page__sidebar js-page-sidebar">
        <aside class="c-sidebar">
          <div class="c-sidebar__brand" style="margin: 10px">
            {{--  <a href="#"><img src="{{ asset('public/assets/prahar_logo.png') }}" alt="Neat"></a>  --}}
          </div>

          <!-- Scrollable -->
          <div class="c-sidebar__body">
            <ul class="c-sidebar__list">
              {{--  <li>
                <a class="c-sidebar__link" href="{{ url('/home') }}">
                <i class="c-sidebar__icon feather icon-menu"></i>Inventory
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/retailers-book') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>Books
                </a>
              </li>  --}}
              <li>
                <a class="c-sidebar__link" href="{{ url('/master/books/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>Books Master
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/master/packages/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>Packages
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/order/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>Orders
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/resale-order/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>Resale Orders
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/coupon/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>Coupons
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/push-notification/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>Bulk Notification
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/user-management/users/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>User Managment
                </a>
              </li>
              <li>
                <a class="c-sidebar__link" href="{{ url('/user-management/roles/view') }}">
                    <i class="c-sidebar__icon far fa-newspaper" style="font-size:1.5em;"></i>User Roles
                </a>
              </li>
            </ul>
          </div>


          {{--  <a class="c-sidebar__footer" href="{{ url('/logout') }}">
            Users <i class="c-sidebar__footer-icon feather icon-power"></i>
          </a>  --}}
          <a class="c-sidebar__footer" href="{{ url('/logout') }}">
            Logout <i class="c-sidebar__footer-icon feather icon-power"></i>
          </a>
        </aside>
      </div>

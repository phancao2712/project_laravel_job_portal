<footer class="footer pt-165">
    <div class="container">
      <div class="row justify-content-between">
        <div class="footer-col-1 col-md-3 col-sm-12">
          <a class="footer_logo" href="index.html">
            <img alt="joblist" src="{{ asset($footer?->logo) }}">
          </a>
          <div class="mt-20 mb-20 font-xs color-text-paragraph-2">{!! $footer?->description !!}</div>
          <div class="footer-social">
            <a class="icon-socials icon-facebook" href="#"><i class="fab fa-facebook-f"></i></a>
            <a class="icon-socials icon-twitter" href="#"><i class="fab fa-twitter"></i></a>
            <a class="icon-socials icon-linkedin" href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="footer-col-2 col-md-2 col-xs-6">
            @php
                $footerMenu1 = \Menu::getByName('Footer Menu One');
                $footerMenu2 = \Menu::getByName('Footer Menu Two');
                $footerMenu3 = \Menu::getByName('Footer Menu Three');
                $footerMenu4 = \Menu::getByName('Footer Menu Four');
            @endphp
          <h6 class="mb-20">Resources</h6>
          <ul class="menu-footer">
            @foreach ($footerMenu1 as $menu)
            <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="footer-col-3 col-md-2 col-xs-6">
          <h6 class="mb-20">Community</h6>
          <ul class="menu-footer">
            @foreach ($footerMenu2 as $menu)
            <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="footer-col-4 col-md-2 col-xs-6">
          <h6 class="mb-20">Quick links</h6>
          <ul class="menu-footer">
            @foreach ($footerMenu3 as $menu)
            <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="footer-col-5 col-md-2 col-xs-6">
          <h6 class="mb-20">More</h6>
          <ul class="menu-footer">
            @foreach ($footerMenu4 as $menu)
            <li><a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="footer-bottom mt-50">
        <div class="row">
          <div class="col-md-6"><span class="font-xs color-text-paragraph">Copyright &copy; 2023. JOBLIST all right
              reserved</span></div>
          <div class="col-md-6 text-md-end text-start">
            <div class="footer-social"><a class="font-xs color-text-paragraph" href="#">Privacy Policy</a><a
                class="font-xs color-text-paragraph mr-30 ml-30" href="#">Terms &amp; Conditions</a><a
                class="font-xs color-text-paragraph" href="#">Security</a></div>
          </div>
        </div>
      </div>
    </div>
  </footer>

<section class="banner-colombia">
  <div class="banner-colombia__container">
    <div class="banner-colombia__grid banner-colombia__grid--{{ $data['config']['position'] }}">
      @notempty($data['desktop']['url'])
        <picture class="banner-colombia__picture">
          @notempty($data['mobile']['url'])
            <source
              srcset="{{ $data['mobile']['url'] }}"
              media="(max-width: 576px)"
            >
          @endnotempty

          <img
            src="{{ $data['desktop']['url'] }}"
            alt="{{ $data['desktop']['alt'] }}"
          >
        </picture>
      @endnotempty

      <div class="banner-colombia__content">
        @notempty($data['title'])
          <div class="banner-colombia__title">
            {!! $data['title'] !!}
          </div>
        @endnotempty

        @notempty($data['sub_title'])
          <div class="banner-colombia__subtitle">
            {!! $data['sub_title'] !!}
          </div>
        @endnotempty

        @notempty($data['link']['url'])
          <a
            class="banner-colombia__link"
            href="{{  $data['link']['url'] }}"
            target="{{  $data['link']['target'] }}"
          >
            {{  $data['link']['title'] }}
            @include('assets.svgs.arrow-right')
          </a>
        @endnotempty
      </div>
    </div>
  </div>
</section>
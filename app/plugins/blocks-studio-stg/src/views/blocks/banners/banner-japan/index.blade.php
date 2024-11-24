<style>
  .banner-japan {
    color: {{ $data['config']['color_text'] }};
  }
</style>

<section class="banner-japan">
  <div class="banner-japan__container">
    @notempty($data['desktop']['url'])
      <picture class="banner-japan__cover">
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

    <div class="banner-japan__grid banner-japan__grid--{{ $data['config']['position_text'] }}">
      <div class="banner-japan__blank"></div>

      <div class="banner-japan__content">
        @notempty($data['title'])
          <div class="banner-japan__title">
            {!! $data['title'] !!}
          </div>
        @endnotempty

        @notempty($data['sub_title'])
          <div class="banner-japan__subtitle">
            {!! $data['sub_title'] !!}
          </div>
        @endnotempty

        @notempty($data['link']['url'])
          <a
            class="banner-japan__link"
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
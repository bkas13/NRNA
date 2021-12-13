<div class="col-md-6">
    <div class="event_card_title">{{ $news->title }}</div>
    <div class="event_card">
        <div class="event_card_content">
            <div class="event_card_date">
                {{ $news->created_date() }}
            </div>
            <div class="event_card_description">
                {{ $news->excerpt }}
                {{ $news->moreText ? '.....' : '' }}
            </div>
            <a class="btn-sm"
                href="{{ route('front.singleNews', [$currentUser->username, $news->slug]) }}">
                Read More
            </a>
        </div>
        <div class="img_wrapper">
            <img src="{{ $news->featureImage ?
                getMediaUrl($news->featureImage->path) : asset('front/images/news1.jpg') }}"
                alt="{{ $news->title }}" />
        </div>
    </div>
</div>

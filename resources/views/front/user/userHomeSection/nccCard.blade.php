<div class="col-md-3">
    <a href="{{ route('front.userHome', $ncc->username) }}" class="other_card">
        @if($ncc->id == 2)  @endif
        <div class="img_container">
            <img src="{{ $ncc->regionalMaster && $ncc->regionalMaster->feature_image ?
                getMediaUrl($ncc->regionalMaster->feature_image->path) : asset('front/images/politicalparty1.png') }}"
                alt="" />
        </div>
        <div class="other_card_content_wrap">
            <div class="other_card_title">{{ $ncc->name }}</div>
        </div>
    </a>
</div>

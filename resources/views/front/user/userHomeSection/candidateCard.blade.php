<div class="col-md-3">
    <a href="{{ route('front.userHome', [$candidate->username]) }}"
        class="candidateCard">
        <div class="img_container">
            <img src="{{ $candidate->regionalMaster && $candidate->regionalMaster->feature_image ?
                getMediaUrl($candidate->regionalMaster->feature_image->path) : asset('front/images/politicalparty1.png') }}"
                alt="" />
        </div>
        <div class="candidateCard_content_wrap">
            <div class="candidateCard_title text-center">{{ $candidate->name }}</div>
            {{-- <div class="candidateCard_subtitle">
                {{ $candidate->name }}
            </div> --}}
        </div>
    </a>
</div>

<div class="col-md-3">
    <a href="{{ route('front.singleCommittee', [$currentUser->username, $committee->slug]) }}"
        class="candidateCard">
        <div class="img_container">
            <img src="{{ $committee->profileImage ?
                getMediaUrl($committee->profileImage->path) :  asset('front/images/politicalparty1.png') }}"
                alt="" />
        </div>
        <div class="candidateCard_content_wrap">
            <div class="candidateCard_title text-center">{{ $committee->fullName() }}</div>
            <div class="candidateCard_subtitle">
                {{ $committee->designation() }}
            </div>
        </div>
    </a>
</div>

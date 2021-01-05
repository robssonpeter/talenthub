<section class="pt40 pb80" id="job-post">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12 mb20">
            <h2 class="capitalize"><i class="fa fa-clipboard"></i> {{ __('web.home_menu.notices') }}</h2>
        </div>
        <marquee direction="up" scrolldelay="200" id="notices">
            @foreach($notices as $notice)
                <span class="font-weight-bold">
                    {{ $notice->title }} | {{ $notice->created_at->diffForHumans() }}<br>
                    {{ date('jS M, Y', strtotime($notice->created_at)) }},
                </span><br>
                {!! nl2br(strip_tags($notice->description)) !!}<br>
                <br>
            @endforeach
        </marquee>
    </div>
</section>

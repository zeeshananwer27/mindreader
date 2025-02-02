<aside class="aside">
    @php
        $user = auth_user('web');
        $subscription           = $user->runningSubscription;
        $webhookAccess          = @optional($subscription->package->social_access)->webhook_access;
        $accessPlatforms         = (array) ($subscription ? @$subscription?->package?->social_access?->platform_access : []);

        $platforms = get_platform()
                        ->whereIn('id', $accessPlatforms )
                        ->where("status",App\Enums\StatusEnum::true->status())
                        ->where("is_integrated",App\Enums\StatusEnum::true->status());

        $platform = $platforms?->first()
    @endphp

    @if(request()->routeIs('user.book.edit.*'))
        <div class="side-content">
            <a href="{{route('user.home')}}" class="sidebar-logo d-block">
                <div class="site-logo">
                    <img class="img-fluid" src="{{imageURL(@site_logo('user_site_logo')->file,'user_site_logo',true)}}"
                         alt="{{ @site_logo('user_site_logo')->file->name ?? 'site-logo.jpg'}}"/>
                </div>
            </a>

            <div class="d-flex flex-column gap-2">
                <div class="text-muted small">Book Title:</div>
                <p class="text-xl fw-medium text-break">{{$book->title}}</p>
                <div class="d-flex gap-2 pt-2">
                    <a href="{{route('book.view', $book->uid)}}" target="_blank" class="w-100">
                        <button class="btn btn-primary btn-sm w-100">Preview</button>
                    </a>
                    <a href="{{route('book.landing', $book->uid)}}" class="w-100">
                        <button class="btn btn-secondary btn-sm w-100">Public View</button>
                    </a>
                </div>

                <div class="pt-2">
                    <button class="btn btn-primary btn-sm w-100">Download for KDP</button>
                </div>
            </div>
            <hr>
            <div class="sidemenu-wrapper book-menu">
                <div class="sidebar-body" data-simplebar>
                    <ul class="sidemenu-list">
                        <li class="sidemenu-item">
                            <a href="{{route('user.book.edit.details', $book->uid)}}"
                               class="sidemenu-link m-0 {{request()->routeIs('user.book.edit.details') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-journal-richtext"></i>
                                </div>
                                <span class="fs-12">{{translate("Detail")}}</span>
                            </a>
                        </li>
                        <li class="sidemenu-item">
                            <a href="{{route('user.book.edit.synopsis', $book->uid)}}"
                               class="sidemenu-link m-0 {{request()->routeIs('user.book.edit.synopsis') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-journal-text"></i>
                                </div>
                                <span class="fs-12">{{translate("Synopsis")}}</span>
                            </a>
                        </li>
                        <li class="sidemenu-item">
                            <a href="{{route('user.book.edit.outlines', $book->uid)}}"
                               class="sidemenu-link m-0 {{request()->routeIs('user.book.edit.outlines') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-list-columns-reverse"></i>
                                </div>
                                <span class="fs-12">{{translate("Outlines")}}</span>
                            </a>
                        </li>
                        <li class="sidemenu-item">
                            <a href="{{route('user.book.edit.cover', $book->uid)}}"
                               class="sidemenu-link m-0 {{request()->routeIs('user.book.edit.cover') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-file-image"></i>
                                </div>
                                <span class="fs-12">{{translate("Cover")}}</span>
                            </a>
                        </li>
                        <li class="sidemenu-item">
                            <a href="#"
                               class="sidemenu-link m-0 sidemenu-collapse {{request()->routeIs('user.book.edit.chapters') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-body-text"></i>
                                </div>
                                <span class="fs-12">{{translate("Chapters")}}
                                     <small><i class="bi bi-chevron-down"></i></small>
                                </span>
                            </a>
                            <div
                                class="side-menu-dropdown @if(request()->routeIs('user.book.edit.chapters')) show-sideMenu @endif">
                                <ul class="sub-menu">

                                    @foreach($book->chapters as $chapter)
                                        <li class="sub-menu-item">
                                            <a class="sidebar-menu-link {{ request()->routeIs('user.book.edit.chapters') && request()->route('id') == $book->uid && request()->route('chapter') == $chapter->uid ? 'active' : '' }}"                                               href="{{route('user.book.edit.chapters',['id' => $book->uid, 'chapter' => $chapter->uid])}}">
                                                <p>{{str_replace("Chapter ", "", $chapter->title)}}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="sidemenu-item">
                            <a href="{{route('user.book.edit.audio', $book->uid)}}"
                               class="sidemenu-link m-0 {{request()->routeIs('user.book.edit.audio') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-music-note-list"></i>
                                </div>
                                <span class="fs-12">{{translate("Audio Book")}}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="sidebar-footer">
                    <a href="{{route('user.logout')}}"><span><i class="bi bi-gear"></i></span>
                        {{translate('Settings')}}
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="side-content">
            <a href="{{route('user.home')}}" class="sidebar-logo d-block">
                <div class="site-logo">
                    <img class="img-fluid" src="{{imageURL(@site_logo('user_site_logo')->file,'user_site_logo',true)}}"
                         alt="{{ @site_logo('user_site_logo')->file->name ?? 'site-logo.jpg'}}"/>
                </div>
            </a>

            <div class="sidemenu-wrapper">
                <div class="sidebar-body" data-simplebar>
                    <ul class="sidemenu-list">
                        <li class="side-menu-title">
                            {{translate("Main")}}
                        </li>

                        <li class="sidemenu-item">
                            <a href="{{route('user.home')}}"
                               class="sidemenu-link {{request()->routeIs('user.home') ? 'active' :''}}">
                                <div
                                    class="sidemenu-icon">
                                    <i class="bi bi-grid-1x2"></i>
                                </div>
                                <span>
                            {{translate('Dashboard')}}
                        </span>
                            </a>
                        </li>

                        @php
                            $lastSegment = collect(request()->segments())->last();
                        @endphp

                        <li class="sidemenu-item">
                            <a href="javascript:void(0)" class="sidemenu-link sidemenu-collapse
                            @if(request()->routeIs('user.social.post.*'))
                                active
                            @endif">
                                <div
                                    class="sidemenu-icon">
                                    <i class="bi bi-stickies"></i>
                                </div>
                                <span>
                                {{translate("Post Feed")}}
                                <small><i class="bi bi-chevron-down"></i></small>
                            </span>
                            </a>

                            <div
                                class="side-menu-dropdown @if(request()->routeIs('user.social.post.*')) show-sideMenu @endif">
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.social.post.create') ? 'active' :''}}"
                                           href="{{route('user.social.post.create')}}">
                                        <span>
                                            <i class="bi bi-pencil-square"></i>
                                        </span>
                                            <p>
                                                {{translate('Create Post')}}
                                            </p>
                                        </a>
                                    </li>

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.social.post.show') || request()->routeIs('user.social.post.list')  ? 'active' :''}}"
                                           href="{{route('user.social.post.list')}}">
                                        <span>
                                           <i class="bi bi-newspaper"></i>
                                        </span>
                                            <p>
                                                {{translate('All Post')}}
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="sidemenu-item">
                            <a href="javascript:void(0)" class="sidemenu-link sidemenu-collapse
                            @if(request()->routeIs('user.social.account.*'))
                                active
                            @endif">
                                <div
                                    class="sidemenu-icon">
                                    <i class="bi bi-person-gear"></i>
                                </div>
                                <span>
                            {{translate("Social Accounts")}}
                            <small><i class="bi bi-chevron-down"></i></small>
                        </span>
                            </a>

                            <div
                                class="side-menu-dropdown @if(request()->routeIs('user.social.account.*')) show-sideMenu @endif">
                                <ul class="sub-menu">
                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.social.account.list') || request()->routeIs('user.social.account.show') || request()->routeIs('user.social.account.create')   ? 'active' :''}}"
                                           href="{{ $platform ? route('user.social.account.list',['platform' => $platform->slug]) : route('user.social.account.list')    }}"
                                        >
                                        <span>
                                            <i class="bi bi-person-lines-fill"></i>
                                        </span>
                                            <p>
                                                {{translate('Account list')}}
                                            </p>
                                        </a>
                                    </li>

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.social.account.platform')   ? 'active' :''}}"
                                           href="{{route('user.social.account.platform')}}">
                                        <span>
                                            <i class="bi bi-gear-wide-connected"></i>
                                        </span>
                                            <p>
                                                {{translate('Platform')}}
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="sidemenu-item">
                            <a href="{{route('user.ai.content.list')}}"
                               class="sidemenu-link  {{request()->routeIs('user.ai.content.*') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-robot"></i>
                                </div>

                                <span>
                                {{translate("AI Contents")}}
                            </span>
                            </a>
                        </li>
                        <li class="sidemenu-item">
                            <a href="{{route('user.book.dashboard')}}"
                               class="sidemenu-link  {{request()->routeIs('user.book.*') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-book"></i>
                                </div>

                                <span>
                                {{translate("AI Books")}}
                            </span>
                            </a>
                        </li>

                        <li class="sidemenu-item">
                            <a href="{{route('user.plan')}}"
                               class="sidemenu-link  {{request()->routeIs('user.plan') ? 'active' :''}}">
                                <div class="sidemenu-icon" data-bs-toggle="tooltip" data-bs-placement="right"
                                     data-bs-custom-class="custom-tooltip" data-bs-title="{{translate('Plans')}}">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <span>
                               {{translate("Plans")}}
                            </span>
                            </a>
                        </li>

                        <li class="sidemenu-item">
                            <a href="javascript:void(0)" class='sidemenu-link sidemenu-collapse
                                @if($lastSegment == "reports")
                                    active
                                @endif'>
                                <div class="sidemenu-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <span>
                                    {{translate("Reports")}}  <small><i class="bi bi-chevron-down"></i></small>
                                </span>
                            </a>

                            <div class="side-menu-dropdown  @if($lastSegment == 'reports')
                                    show-sideMenu
                                @endif">
                                <ul class="sub-menu">

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.subscription.report.*') ? 'active' :''}}"
                                           href="{{route('user.subscription.report.list')}}">
                                        <span>
                                            <i class="bi bi-bookmarks"></i>
                                        </span>

                                            <p>
                                                {{translate('Subscription Reports')}}
                                            </p>
                                        </a>
                                    </li>

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.credit.report.*') ? 'active' :''}}"
                                           href="{{route('user.credit.report.list')}}">
                                            <span><i class="bi bi-credit-card-2-front"></i></span>
                                            <p>
                                                {{translate('Credit Reports')}}
                                            </p>
                                        </a>
                                    </li>

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link  {{request()->routeIs('user.deposit.report.*') ? 'active' :''}}"
                                           href="{{route('user.deposit.report.list')}}">
                                            <span><i class="bi bi-wallet"></i></span>
                                            <p>
                                                {{translate('Deposit Reports')}}
                                            </p>
                                        </a>
                                    </li>

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.withdraw.report.*') ? 'active' :''}}"
                                           href="{{route('user.withdraw.report.list')}}">
                                            <span><i class="bi bi-box-arrow-in-up-left"></i></span>
                                            <p>
                                                {{translate('Withdraw Reports')}}
                                            </p>
                                        </a>
                                    </li>

                                    @if(site_settings("affiliate_system") == App\Enums\StatusEnum::true->status())
                                        <li class="sub-menu-item">
                                            <a class="sidebar-menu-link {{request()->routeIs('user.affiliate.report.*') ? 'active' :''}}"
                                               href="{{route('user.affiliate.report.list')}}">
                                                <span><i class="bi bi-share"></i></span>
                                                <p>
                                                    {{translate('Affiliate Reports')}}
                                                </p>
                                            </a>
                                        </li>

                                        <li class="sub-menu-item">
                                            <a class="sidebar-menu-link {{request()->routeIs('user.affiliate.user.*') ? 'active' :''}}"
                                               href="{{route('user.affiliate.user.list')}}">
                                                <span><i class="bi bi-people"></i></span>
                                                <p>
                                                    {{translate('Affiliate Users')}}
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.transaction.report.*') ? 'active' :''}}"
                                           href="{{route('user.transaction.report.list')}}">
                                            <span><i class="bi bi-arrow-left-right"></i></span>
                                            <p>{{ translate('Transaction Reports' )}}</p>
                                        </a>
                                    </li>

                                    <li class="sub-menu-item">
                                        <a class="sidebar-menu-link {{request()->routeIs('user.kyc.report.*') ? 'active' :''}}"
                                           href="{{route('user.kyc.report.list')}}">
                                            <span><i class="bi bi-shield-lock"></i></span>
                                            <p>
                                                {{translate('KYC Reports')}}
                                            </p>
                                        </a>
                                    </li>

                                    @if($webhookAccess == App\Enums\StatusEnum::true->status())
                                        <li class="sub-menu-item">
                                            <a class="sidebar-menu-link {{request()->routeIs('user.webhook.report.*') ? 'active' :''}}"
                                               href="{{route('user.webhook.report.list')}}">
                                                <span><i class="bi bi-bell"></i></span>
                                                <p>
                                                    {{translate('Webhook Reports')}}
                                                </p>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </li>

                        <li class="sidemenu-item">
                            <a href="{{route('user.ticket.list')}}"
                               class="sidemenu-link  {{request()->routeIs('user.ticket.*') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-patch-question"></i>
                                </div>

                                <span>
                                {{translate("Tickets")}}
                            </span>
                            </a>
                        </li>

                        <li class="side-menu-title">
                            {{translate('Setting')}}
                        </li>

                        <li class="sidemenu-item">
                            <a href="{{route('user.profile')}}"
                               class="sidemenu-link  {{request()->routeIs('user.profile') ? 'active' :''}}">
                                <div class="sidemenu-icon">
                                    <i class="bi bi-gear"></i>
                                </div>

                                <span>
                                {{translate("Profile")}}
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="sidebar-footer">
                    <div class="header-right-item">
                        <div class="dropdown currency">
                            <button
                                class="dropdown-toggle"
                                type="button"
                                @if($currencies->count() > 0)
                                    data-bs-toggle="dropdown"
                                aria-expanded="false"
                                @endif>
                                {{session()->get('currency')?->code}}
                            </button>

                            @if($currencies->count() > 0)
                                <ul class="dropdown-menu dropdown-menu-end">

                                    @foreach($currencies as $currency)
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{route('currency.change',$currency->code)}}"> {{$currency->code}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="total-balance">
                        <h4>
                            {{num_format(number:$user->balance,calC:true)}}
                        </h4>
                        <p>
                            {{translate('Total Balance')}}
                        </p>
                    </div>
                    <a href="{{route('user.logout')}}"><span><i class="bi bi-box-arrow-right"></i></span>
                        {{translate('Logout')}}
                    </a>
                </div>
            </div>
        </div>
    @endif

</aside>

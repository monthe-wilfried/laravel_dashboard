<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini"><img src="{{asset('black/img/tu_chemnitz.png')}}"></a>
            <a href="#" class="simple-text logo-normal">{{ __('TU Chemnitz') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <span class="nav-link-text" >{{ __('User Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="tim-icons icon-badge"></i>
                                <p>{{ __('All Users') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'edit_user') class="active " @endif>

                        </li>
                        <li @if ($pageSlug == 'create_user') class="active " @endif>

                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'professorships') class="active " @endif>
                <a href="{{ route('professorships.index') }}">
                    <i class="tim-icons icon-shape-star"></i>
                    <p>{{ __('Professorships') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'edit_professorship') class="active " @endif>

            </li>
            <li @if ($pageSlug == 'publications') class="active " @endif>
                <a href="{{ route('publications.index') }}">
                    <i class="tim-icons icon-paper"></i>
                    <p>{{ __('Publications') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'create_publication') class="active " @endif>

            </li>
            <li @if ($pageSlug == 'edit_publication') class="active " @endif>

            </li>
            <li @if ($pageSlug == 'roles') class="active " @endif>
                <a href="{{ route('roles.index') }}">
                    <i class="tim-icons icon-tag"></i>
                    <p>{{ __('Roles') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'roles') class="active " @endif>

            </li>

            <li @if ($pageSlug == 'trash') class="active " @endif>

            </li>

            <li @if ($pageSlug == 'media') class="active " @endif>
                <a href="{{ route('pages.media') }}">
                    <i class="tim-icons icon-image-02"></i>
                    <p>{{ __('Media') }}</p>
                </a>
            </li>
            <li @if ($pageSlug == 'icons') class="active " @endif>
                <a href="{{ route('pages.icons') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>

        </ul>
    </div>
</div>

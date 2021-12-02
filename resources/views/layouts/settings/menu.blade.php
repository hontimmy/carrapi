<div class="card {{ Request::is('users*') || Request::is('settings/permissions*') || Request::is('settings/roles*') ? '' : 'collapsed-card' }}">
    <div class="card-header">
        <h6 class="card-title">{{trans('lang.permission_menu')}}</h6>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="{!! route('permissions.index') !!}" class="nav-link {{  Request::is('settings/permissions*') ? 'selected' : '' }}">
                    <i class="fas fa-inbox"></i> {{trans('lang.permission_plural')}}
                </a>
            </li>
            <li class="nav-item">
                <a href="{!! route('roles.index') !!}" class="nav-link {{  Request::is('settings/roles*') ? 'selected' : '' }}">
                    <i class="fas fa-inbox"></i> {{trans('lang.role_plural')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! route('users.index') !!}" class="nav-link {{  Request::is('users*') ? 'selected' : '' }}">
                    <i class="fas fa-users"></i> {{trans('lang.user_plural')}}
                </a>
            </li>

        </ul>
    </div>
</div>

<div class="card {{
             Request::is('settings/app/*') ||
             Request::is('settings/mail*') ||
             Request::is('settings/translation*') ||
             Request::is('settings/payment*') ||
             Request::is('settings/currencies*') ||
             Request::is('settings/taxes*') ||
             Request::is('settings/customFields*')
 ? '' : 'collapsed-card' }}">
    <div class="card-header">
        <h6 class="card-title">{{trans('lang.app_setting_globals')}}</h6>
    </div>
    <div class="card-body widget settings-menu">
        <ul class="">
            <li class="nav-item">
                <a href="{!! url('settings/app/globals') !!}" class="nav-link {{  Request::is('settings/app/globals*') ? 'active' : '' }}">
                    <i class="fas fa-cog fa-3x"></i> {{trans('lang.app_setting_globals')}}
                </a>
            </li>

                      
            <li class="nav-item">
                <a href="{!! url('settings/payment/payment') !!}" class="nav-link {{  Request::is('settings/payment*') ? 'active' : '' }}">
                    <i class="fas fa-credit-card fa-3x"></i> {{trans('lang.app_setting_payment')}}
                </a>
            </li>

            @can('currencies.index')
                <li class="nav-item">
                    <a href="{!! route('currencies.index') !!}" class="nav-link {{ Request::is('settings/currencies*') ? 'active' : '' }}"><i class="nav-icon fas fa-dollar-sign ml-1 fa-3x"></i>{{trans('lang.currency_plural')}}
                    </a>
                </li>
            @endcan
            @can('taxes.index')
                <li class="nav-item">
                    <a href="{!! route('taxes.index') !!}" class="nav-link {{ Request::is('settings/taxes*') ? 'active' : '' }}"><i class="nav-icon fas fa-coins ml-1"></i>{{trans('lang.tax_plural')}}
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a href="{!! url('settings/app/notifications') !!}" class="nav-link {{  Request::is('settings/app/notifications*') || Request::is('notificationTypes*') ? 'active' : '' }}">
                    <i class="fas fa-bell fa-3x"></i> {{trans('lang.app_setting_notifications')}}
                </a>
            </li>

            <li class="nav-item">
                <a href="{!! url('settings/mail/smtp') !!}" class="nav-link {{ Request::is('settings/mail*') ? 'active' : '' }}">
                    <i class="fas fa-envelope fa-3x"></i> {{trans('lang.app_setting_mail')}}
                </a>
            </li>

          
            <li class="nav-item">
                <a href="{!! route('customFields.index') !!}" class="nav-link {{ Request::is('settings/customFields*') ? 'active' : '' }}">
                    <i class="fas fa-list fa-3x"></i> {{trans('lang.custom_field_plural')}}
                </a>
            </li>

        </ul>
    </div>
</div>
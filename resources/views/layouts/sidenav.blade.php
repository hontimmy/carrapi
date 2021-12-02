@php
$icons = "hhh";
@endphp
<!-- Sidebar -->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"><span>Main</span></li>
							@can('dashboard')
							<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
								<a href="{!! url('dashboard') !!}"><i data-feather="home"></i> <span>Dashboard</span></a>
							</li>
							@endcan	

							
							<li class="menu-title"><span>Data Center</span></li>
							<li class="submenu {{ Request::is('categories*') || Request::is('options*') || Request::is('optionGroups*') ? 'active' : '' }}">
								<a href="#"><i data-feather="grid"></i> <span> Data</span> <span class="menu-arrow"></span></a>
								<ul>								
								@can('categories.index')
									<li>
										<a href="{!! route('categories.index') !!}" class="{{ Request::is('categories*') ? 'active' : '' }}">
										<i class="fa fa-list"></i>Categories</a>
									</li>
							   @endcan
								@can('optionGroups.index')
									<li >
										<a href="{!! route('optionGroups.index') !!}" class="{{ Request::is('optionGroups*') ? 'active' : '' }}"><i class="fa fa-list"></i>{{trans('lang.option_group_plural')}}</a>
									</li>
							   @endcan
								@can('options.index')
								<li>
									<a href="{!! route('options.index') !!}" class="{{ Request::is('options*') ? 'active' : '' }}"><i class="fa fa-list"></i>{{trans('lang.option_plural')}}</a>
								</li>
						       @endcan
							   </ul>
							</li>
							
					    @can('eServices.index')
					    <li class="menu-title"><span>Services</span></li>
						<li class="submenu {{ Request::is('eServices*') || Request::is('options*') || Request::is('optionGroups*') || Request::is('eServiceReviews*') || Request::is('availabilityHours*') || Request::is('awards*') || Request::is('eProviderTypes*') ? 'active' : '' }}">
							<a href="#"><i data-feather="briefcase"></i> <span> {{trans('lang.e_service_plural')}}</span> <span class="menu-arrow"></span></a>
						       <ul>
									<li><a href="{!! route('eServices.index') !!}" class="{{ Request::is('eServices*') ? 'active' : '' }}"><i class="fa fa-list"></i>{{trans('lang.e_service_table')}}</a>
									</li>
									<li><a href="{!! route('eServiceReviews.index') !!}" class="{{ Request::is('eServiceReviews*') ? 'active' : '' }}"><i class="fa fa-list"></i>{{trans('lang.e_service_review_plural')}}</a>
									</li>
									@can('eProviderTypes.index')
									<li>
										<a href="{!! route('eProviderTypes.index') !!}" class="{{ Request::is('eProviderTypes*') ? 'active' : '' }}"><i class="fa fa-list"></i> {{trans('lang.e_provider_type_plural')}}</a>
										</li>
									@endcan
									 @can('availabilityHours.index')
									<li>
										<a href="{!! route('availabilityHours.index') !!}" class="{{ Request::is('availabilityHours*') ? 'active' : '' }}"><i class="fa fa-clock"></i>{{trans('lang.availability_hour_plural')}}</a>
									</li>
								@endcan
								
								</ul>
							</li>
							@endcan			
															
							@can('users.index')
							<li class="menu-title"><span>Users Data</span></li>
							<li class="submenu {{ Request::is('users*') || Request::is('eProvider*') || Request::is('users*') ? 'active' : '' }}">
								<a href="#"><i data-feather="users"></i> <span> Users </span> <span class="menu-arrow"></span></a>
								<ul>
									<li><a href="{!! route('users.index') !!}" class="{{ Request::is('users*') ? 'active' : '' }}"> Customers </a></li>
									<li><a href="{!! route('eProviders.index') !!}" class="{{ Request::is('eProviders*') ? 'active' : '' }}"> Providers </a></li>
									<li><a href="{!! route('users.index') !!}"> Admin</a></li>
								</ul>
							</li>
							@endcan
								
					@can('payments.index')
					<li class="menu-title"><span>Payment Data</span></li>
					<li class="submenu {{ Request::is('earnings*') || Request::is('driversPayouts*') || Request::is('eprovidersPayouts*') || Request::is('payments*') ? 'active' : '' }}">
					<a href="#"> 
					   <i data-feather="credit-card"></i> <span> {{trans('lang.payment_plural')}} </span> <span class="menu-arrow"></span>       
					</a>    
		<ul class="">
            @can('payments.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('payments*') ? 'active' : '' }}" href="{!! route('payments.index') !!}"><p>{{trans('lang.payment_table')}}</p></a>
                </li>
            @endcan
            @can('paymentMethods.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('paymentMethods*') ? 'active' : '' }}" href="{!! route('paymentMethods.index') !!}"><p>{{trans('lang.payment_method_plural')}}</p></a>
                </li>
            @endcan

            @can('paymentStatuses.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('paymentStatuses*') ? 'active' : '' }}" href="{!! route('paymentStatuses.index') !!}"><p>{{trans('lang.payment_status_plural')}}</p></a>
                </li>
            @endcan
            @can('earnings.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('earnings*') ? 'active' : '' }}" href="{!! route('earnings.index') !!}"><p>{{trans('lang.earning_plural')}}  </p></a>
                </li>
            @endcan
            @can('eProviderPayouts.index')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('eProviderPayouts*') ? 'active' : '' }}" href="{!! route('eProviderPayouts.index') !!}"><p>{{trans('lang.e_provider_payout_plural')}}</p></a>
                </li>
                @endcan
			</ul>
		</li>
				
			@endcan
			<li class="menu-title"><span>Site Setting Data</span></li>			
			<li class="submenu {{  Request::is('settings/app/globals*') ? 'active' : '' }}">
				<a href="#"><i data-feather="tool"></i> <span> {{trans('lang.app_setting')}} </span> <span class="menu-arrow"></span></a>
				<ul>							
				<li class="{{  Request::is('settings/app/globals*') ? 'active' : '' }}">
					<a href="{!! url('settings/app/globals') !!}" class="nav-link {{  Request::is('settings/app/globals*') ? 'active' : '' }}">
						{{trans('lang.app_setting_globals')}}
					</a>
				</li>
			</ul>
			</li>
			
			@can('galleries.index')
			<li class="menu-title"><span>System Images Data</span></li>
				<li class="{{ Request::is('galleries*') ? 'active' : '' }}">
					<a class="" href="{!! route('galleries.index') !!}"><i data-feather="cloud"></i> <span>{{trans('lang.gallery_plural')}}</span></a>
				</li>
			@endcan				
			
			<li class="menu-title"><span>Exit</span></li>				
			<li> 
				<a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i> <span>Sign Out</span></a>
			 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
			{{ csrf_field() }}
			</form>
			</li>
			</ul>
		</div>
	</div>
</div>
<!-- /Sidebar -->
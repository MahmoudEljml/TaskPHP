<div class="container-fluid">
    <div class="row">
        <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
            <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
                aria-labelledby="sidebarMenuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 active {{ checkRoute( url('admin')) ? 'bg-primary text-white' : '' }}"
                                aria-current="page" href="{{url('admin')}}">
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#house-fill" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 {{ checkRoute( aUrl('categories')) ? 'bg-primary text-white' : '' }}"
                                href="{{aUrl('categories')}}">
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#file-earmark" />
                                </svg>
                                <i class="fa-solid fa-list"></i>
                                {{trans('admin.categories')}}
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 {{ checkRoute( aUrl('news')) ? 'bg-primary text-white' : '' }}"
                                href="{{aUrl('news')}}">
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#file-earmark" />
                                </svg>
                                <i class="fa-regular fa-newspaper"></i>
                                {{trans('admin.news')}}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2 {{ checkRoute( aUrl('users')) ? 'bg-primary text-white' : '' }}"
                                href="{{aUrl('users')}}">
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#file-earmark" />
                                </svg>
                                <i class="fa-regular fa-newspaper"></i>
                                {{trans('admin.users')}}
                            </a>
                        </li>
                    </ul>

                    <hr class="my-3">

                    <ul class="nav flex-column mb-auto">
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="#">
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#gear-wide-connected" />
                                </svg>
                                <i class="fa-solid fa-gear"></i>
                                Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center gap-2" href="{{url(ADMIN.'/logout')}}">
                                <svg class="bi" aria-hidden="true">
                                    <use xlink:href="#file-earmark-text" />
                                </svg>
                                <i style="{{ session('locale')=='en' ? 'rotate: 180deg' : 'rotate: 0deg' }}"
                                    class="fa-solid fa-arrow-right-from-bracket"></i>
                                {{trans('admin.logout')}}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>



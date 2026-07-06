<!-- Sidebar -->
<div class="sidebar sidebar-style-2" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center gap-3">
                <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" height="40" width="40">
                <div>
                    <span class="text-white fw-bold fs-5" style="white-space: nowrap">नेपाल सरकार </span>
                </div>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>ड्यासवोर्ड</p>
                    </a>
                </li>
                @can('training')
                    <li class="nav-item {{ request()->routeIs('admin.training.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.training.index') }}" aria-expanded="false">
                            <i class="fa fa-chalkboard-teacher"></i>
                            <p>
                                @role('trainee')
                                    खुल्ला
                                @endrole तालीमहरु
                            </p>
                        </a>
                    </li>
                @endcan
                @can('application')
                    @hasanyrole('super-admin|admin|trainer')
                        <li class="nav-item {{ request()->routeIs('admin.application.index') ? 'active' : '' }} ">
                            <a href="{{ route('admin.application.index') }}" aria-expanded="false">
                                <i class="fas fa-envelope"></i>
                                <p>आवेदनहरु </p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item {{ request()->routeIs('admin.my-training-application.index') ? 'active' : '' }} ">
                            <a href="{{ route('admin.my-training-application.index') }}" aria-expanded="false">
                                <i class="fas fa-envelope"></i>
                                <p>मेरो आवेदनहरु </p>
                            </a>
                        </li>
                    @endhasanyrole
                @endcan

                @role('trainee')
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" aria-expanded="false">
                            <i class="fas fa-certificate"></i>
                            <p>मेरो प्रमाणपत्र</p>
                        </a>
                    </li>
                @endrole

                @can('budget_bibaran')
                    <li class="nav-item {{ request()->routeIs('admin.budgetBibaran.index') ? 'active' : '' }} ">
                        <a href="{{ route('admin.budgetBibaran.index') }}" aria-expanded="false">
                            <i class="fas fa-rupee-sign"></i>
                            <p> बजेट विवरण </p>
                        </a>
                    </li>
                @endcan

                @can('certificate')
                    <li class="nav-item {{ request()->routeIs('admin.certificate.index') ? 'active' : '' }} ">
                        <a href="{{ route('admin.certificate.index') }}" aria-expanded="false">
                            <i class="fas fa-id-card"></i>
                            <p> प्रमाणपत्रहरु </p>
                        </a>
                    </li>
                @endcan
                @canany(['prashikshan_pratibedan', 'aabedan_pratibedan'])
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#report" aria-expanded="false">
                            <i class="fas fa-file-alt"></i>
                            <p>प्रतिवेदन</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="report">
                            <ul class="nav nav-collapse">
                                @can('prashikshan_pratibedan')
                                    <li><a href="{{ route('admin.prashikshan.pratibedan') }}"
                                            class="{{ request()->routeIs('admin.prashikshan.pratibedan') ? 'active' : '' }}">तालिम
                                            प्रतिवेदन</a></li>
                                @endcan
                                @can('aabedan_pratibedan')
                                    <li><a href="{{ route('admin.aabedan.pratibedan') }}"
                                            class="{{ request()->routeIs('admin.aabedan.pratibedan') ? 'active' : '' }}">आवेदक
                                            प्रतिवेदन</a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany


                @canany(['samachar', 'notice', 'scheme', 'karyabidhi'])
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#notices" aria-expanded="false">
                            <i class="fas fa-comment-dots"></i>
                            <p>सूचना</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="notices">
                            <ul class="nav nav-collapse">
                                @can('samachar')
                                    <li><a href="{{ route('admin.samachar.index') }}"
                                            class="{{ request()->routeIs('admin.samachar.index') ? 'active' : '' }}">समाचार</a>
                                    </li>
                                @endcan
                                @can('notice')
                                    <li><a href="{{ route('admin.notice.index') }}"
                                            class="{{ request()->routeIs('admin.notice.index') ? 'active' : '' }}">नोटिस </a>
                                    </li>
                                @endcan

                                @can('karyabidhi')
                                    <li><a href="{{ route('admin.karyabidhi.index') }}"
                                            class="{{ request()->routeIs('admin.karyabidhi.index') ? 'active' : '' }}">कार्यविधि</a>
                                    </li>
                                @endcan
                                @can('scheme')
                                    <li><a href="{{ route('admin.scheme.index') }}"
                                            class="{{ request()->routeIs('admin.scheme.index') ? 'active' : '' }}">स्कीम</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan


                @canany(['karmachari', 'department', 'banner', 'broadcast','category','education_level','target-group','preference'])

                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#basic-info" aria-expanded="false">
                            <i class="fas fa-cogs"></i>
                            <p>आधारभुत विवरण</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="basic-info">
                            <ul class="nav nav-collapse">
                                @can('karmachari')
                                    <li><a href="{{ route('admin.karmachari.index') }}"
                                            class="{{ request()->routeIs('admin.karmachari.index') ? 'active' : '' }}">कर्मचारी</a>
                                    </li>
                                @endcan

                                @can('department')
                                    <li><a href="{{ route('admin.department.index') }}"
                                            class="{{ request()->routeIs('admin.department.index') ? 'active' : '' }}">विभाग</a>
                                    </li>
                                @endcan

                                @can('category')
                                    <li><a href="{{ route('admin.category.index') }}"
                                            class="{{ request()->routeIs('admin.category.index') ? 'active' : '' }}">क्याटेगोरी</a>
                                    </li>
                                @endcan
                                @can('education_level')
                                    <li><a href="{{ route('admin.education-level.index') }}"
                                            class="{{ request()->routeIs('admin.department.index') ? 'active' : '' }}">शैक्षिक
                                            स्तर</a>
                                    </li>
                                @endcan
                                @can('broadcast')
                                    <li><a href="{{ route('admin.broadcast.index') }}"
                                            class="{{ request()->routeIs('admin.broadcast.index') ? 'active' : '' }}">प्रसारित
                                            सन्देश</a>
                                    </li>
                                @endcan
                                @can('traget_group')
                                    <li><a href="{{ route('admin.target-group.index') }}"
                                            class="{{ request()->routeIs('admin.target-group.index') ? 'active' : '' }}">टार्गेट
                                            समूह</a>
                                    </li>
                                @endcan
                                @can('preference')
                                    <li><a href="{{ route('admin.preference.index') }}"
                                            class="{{ request()->routeIs('admin.preference.index') ? 'active' : '' }}">प्राथमिकता</a>
                                    </li>
                                @endcan
                                @can('banner')
                                    <li><a href="{{ route('admin.banner.index') }}"
                                            class="{{ request()->routeIs('admin.banner.index') ? 'active' : '' }}">ब्यानर</a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan
                @canany(['prayogkarta_darta', 'prayogkarta_bhumika'])

                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#user-management" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <p>प्रयोगकर्ता व्यवस्थापन</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="user-management">
                            <ul class="nav nav-collapse">
                                @can('prayogkarta_darta')
                                    <li><a href="{{ route('admin.prayog-karta-darta.index') }}"
                                            class="{{ request()->routeIs('admin.prayog-karta-darta.index') ? 'active' : '' }}">प्रयोगकर्ता
                                            दर्ता</a></li>
                                @endcan
                                @can('prayogkarta_bhumika')
                                    <li><a href="{{ route('admin.prayog-karta-bhumika.index') }}"
                                            class="{{ request()->routeIs('admin.prayog-karta-bhumika.index') ? 'active' : '' }}">प्रयोगकर्ता
                                            भूमिका</a></li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan


                @can('gallery')
                    <li class="nav-item {{ request()->routeIs('admin.gallery.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.gallery.index') }}" aria-expanded="false">
                            <i class="fas fa-folder"></i>
                            <p>ग्यालेरी</p>
                        </a>
                    </li>
                @endcan

                @can('contact_us')
                    <li class="nav-item {{ request()->routeIs('admin.contact.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.contact.index') }}" aria-expanded="false">
                            <i class="fa fa-phone-volume"></i>
                            <p>सम्पर्क </p>
                        </a>
                    </li>
                @endcan

                @can('about_us')
                    <li class="nav-item {{ request()->routeIs('admin.about-us.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.about-us.index') }}" aria-expanded="false">
                            <i class="far fa-window-maximize"></i>
                            <p>हाम्रो बारेमा</p>
                        </a>
                    </li>
                @endcan
                @canany(['palika_setup', 'arthik_barsha', 'province', 'district', 'sthaniya_taha', 'certificate'])

                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#setup" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <p>मास्टर सेटअप</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="setup">
                            <ul class="nav nav-collapse">
                                @can('palika_setup')
                                    <li><a href="{{ route('admin.organization.index') }}"
                                            class="{{ request()->routeIs('admin.bibad-niyam-dafa.index') ? 'active' : '' }}">पालिका
                                            सेटअप</a></li>
                                @endcan
                                @can('arthik_barsha')
                                    <li><a href="{{ route('admin.arthik-barsa.index') }}"
                                            class="{{ request()->routeIs('admin.arthik-barsa.index') ? 'active' : '' }}">आर्थिक
                                            वर्ष</a></li>
                                @endcan
                                @can('province')
                                    <li><a href="{{ route('admin.province.index') }}"
                                            class="{{ request()->routeIs('admin.province.index') ? 'active' : '' }}">प्रदेश</a>
                                    </li>
                                @endcan
                                @can('district')
                                    <li><a href="{{ route('admin.district.index') }}"
                                            class="{{ request()->routeIs('admin.district.index') ? 'active' : '' }}">जिल्ला</a>
                                    </li>
                                @endcan
                                @can('sthaniya_taha')
                                    <li><a href="{{ route('admin.sthaniya-taha.index') }}"
                                            class="{{ request()->routeIs('admin.sthaniya-taha.index') ? 'active' : '' }}">स्थानिय
                                            तह</a></li>
                                @endcan
                                @can('ward')
                                    <li><a href="{{ route('admin.ward.index') }}"
                                            class="{{ request()->routeIs('admin.ward.index') ? 'active' : '' }}">वडा नं.</a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="#" id="logOutBtn2" aria-expanded="false">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>बाहिर जाने</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->

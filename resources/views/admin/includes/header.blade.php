<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
                @if (isset(get_detail()->logo))
                    <img src="{{ asset('files/'.get_detail()->logo) }}" alt="" alt="navbar brand"
                        class="navbar-brand" height="20">
                @else
                    <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" alt="" alt="navbar brand"
                        class="navbar-brand" height="20">
                @endif

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
    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <nav class="p-0 navbar navbar-header-left navbar-expand-lg navbar-form nav-search d-none d-lg-flex">
                <div>
                    <h6><b> {{ get_detail()->palika_name ?? 'महाराजगंज नगरपालिका ' }} </b></h6>
                    <h6><b>{{ get_detail()->district->name ?? 'महाराजगंज, कपिलवस्तु' }},
                            {{ get_detail()->province->name ?? 'लुम्बिनी प्रदेश' }},
                            {{ get_detail()->country ?? 'नेपाल' }}</b></h6>
                </div>
            </nav>

            <!-- Moved date section here, before the user dropdown -->
            

            <div class="d-none d-md-block nav mx-auto text-center">
                <h6>
                    <span>आर्थिक वर्ष</span> <br>
                    <span class="npNum">{{ \App\Models\ArthikBarsa::where('status', 1)->first()->arthik_barsa ?? '' }}</span>
                </h6>
            </div>
            <div class="d-none d-md-block me-3">
                <h6>
                    <span class="npNum" id="npDate"></span><br>
                    <span id="engdate">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span> ,
                    <span>{{ \Carbon\Carbon::now()->format('l') }}</span>
                </h6>
            </div>
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                <!-- Notification Bell -->
                <li class="nav-item topbar-notification dropdown hidden-caret">
                    <a class="dropdown-toggle position-relative" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fas fa-bell text-white"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge" style="display: none;">
                            0
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-notification animated fadeIn" style="width: 350px;">
                        <li>
                            <div class="dropdown-header d-flex justify-content-between align-items-center">
                                <span>नोटिफिकेसनहरू</span>
                                <a href="#" class="mark-all-read text-decoration-none small">सबै पढिसक्यो</a>
                            </div>
                        </li>
                        <li class="scrollbar-outer notification-list">
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-3 no-notifications" style="display: none;">
                                <p class="text-muted mb-0">कुनै नोटिफिकेसन छैन</p>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            @if (isset(get_detail()->logo))
                                <img src="{{ asset('files/'.get_detail()->logo) }}" alt=""
                                    class="avatar-img rounded-circle">
                            @else
                                <img src="{{ asset('dist/img/logo/Government_Logo.png') }}" alt=""
                                    class="avatar-img rounded-circle">
                            @endif

                        </div>
                        <span class="profile-username text-white">
                            <span class="op-7">नमस्ते,</span>
                            <span class="fw-bold">{{ Auth::user()->name ?? 'प्रयोगकर्ता' }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        @if (isset(get_detail()->logo))
                                            <img src="{{ asset('files/'.get_detail()->logo) }}"
                                                alt="image profile" class="rounded avatar-img">
                                        @else
                                            <img src="{{ asset('dist/img/logo/Government_Logo.png') }}"
                                                class="rounded avatar-img">
                                        @endif

                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name ?? 'प्रयोगकर्ता' }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email ?? '' }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item py-2 mb-1" href="{{ route('home') }}">
                                    <i class="fas fa-home me-3"></i> गृह पृष्ठ
                                </a>
                                <a class="dropdown-item py-2 mb-1" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user me-3"></i> मेरो प्रोफाइल
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logOutBtn1">
                                    <i class="fas fa-sign-out-alt me-2"></i> लग आउट
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load notifications
    function loadNotifications() {
        fetch('{{ route("notifications.index") }}')
            .then(response => response.json())
            .then(data => {
                const badge = document.querySelector('.notification-badge');
                const notificationList = document.querySelector('.notification-list');
                const noNotifications = document.querySelector('.no-notifications');
                
                // Update badge
                if (data.unread_count > 0) {
                    badge.style.display = 'block';
                    badge.textContent = data.unread_count > 9 ? '9+' : data.unread_count;
                } else {
                    badge.style.display = 'none';
                }
                
                // Update notification list
                if (data.notifications.length > 0) {
                    noNotifications.style.display = 'none';
                    notificationList.innerHTML = '<div class="dropdown-divider"></div>';
                    
                    data.notifications.forEach(notification => {
                        const item = document.createElement('div');
                        item.className = 'dropdown-item ' + (notification.is_read ? 'read' : 'unread');
                        item.innerHTML = `
                            <a href="${notification.link}" class="notification-link" data-id="${notification.id}">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">${notification.title}</h6>
                                        <p class="mb-1 small text-muted">${notification.message}</p>
                                        <small class="text-muted">${new Date(notification.created_at).toLocaleString()}</small>
                                    </div>
                                    ${!notification.is_read ? '<span class="badge bg-primary ms-2">नयाँ</span>' : ''}
                                </div>
                            </a>
                        `;
                        notificationList.appendChild(item);
                    });
                } else {
                    noNotifications.style.display = 'block';
                }
            })
            .catch(error => console.error('Error loading notifications:', error));
    }
    
    // Initial load
    loadNotifications();
    
    // Refresh notifications every 30 seconds
    setInterval(loadNotifications, 30000);
    
    // Mark all as read
    document.querySelector('.mark-all-read')?.addEventListener('click', function(e) {
        e.preventDefault();
        fetch('{{ route("notifications.mark-all-read") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotifications();
            }
        });
    });
    
    // Mark single notification as read when clicked
    document.addEventListener('click', function(e) {
        const link = e.target.closest('.notification-link');
        if (link) {
            e.preventDefault();
            e.stopPropagation(); // Prevent dropdown from closing
            const id = link.dataset.id;
            
            fetch('{{ route("notifications.mark-read", ":id") }}'.replace(':id', id), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadNotifications();
                }
            });
        }
    });
});
</script>

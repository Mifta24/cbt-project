<nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="{{ route('dashboard') }}" class="active">Home<br></a></li>
        <li><a href="{{ route('about') }}">About</a></li>

        <li><a href="{{ route('lecturers') }}">Dosen</a></li>

        @auth

            {{-- <li><a href="pricing.html">Pricing</a></li> --}}
            <li class="dropdown"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-top border-secondary">
                        <div class="px-4">
                            <div class="fw-bold text-body">{{ Auth::user()->name }}</div>
                            <div class="text-muted">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('profile.edit') }}" class="btn btn-link text-decoration-none">
                                {{ __('Profile') }}
                            </a>

                            <a href="{{ route('courses') }}">
                                My Courses
                            </a>


                            <a href="{{ route('assignment.grades') }}" class="btn btn-link text-decoration-none">
                                Exam Grades
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="btn btn-link text-decoration-none"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </ul>
            </li>
        @endauth
        <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>


    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
</nav>

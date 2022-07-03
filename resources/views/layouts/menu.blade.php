<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('home')}}">
        <i class=" fas fa-building"></i><span>VCIRS</span>
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('userList')}}">
        <i class="fas fa-user"></i><span>USER</span>
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('penyakitList')}}">
        <i class="fas fa-bacteria"></i><span>Penyakit/Hama</span>
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('gejalaList')}}">
        <i class="fas fa-syringe"></i><span>Gejala</span>
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('ruleList')}}">
        <i class="fas fa-clipboard-list"></i><span>Rule</span>
    </a>
</li>

<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="{{route('pilihanList')}}">
        <i class="fas fa-filter"></i><span>Pilihan</span>
    </a>
</li>

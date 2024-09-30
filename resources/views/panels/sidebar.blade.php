<nav class="d-flex flex-column sidebar bg-light border-end h-100" style="width: 220px;">
    <header class="d-flex flex-row border-bottom" style="height: 45px !important;">
        <div class="d-flex flex-row w-100 ps-4 pt-2 pb-1 px-3 justify-content-between align-items-center"
             style="height: 45px !important;">
            <div class="d-flex flex-column workspace-actions">
                <span class="d-flex flex-row" style="font-size: 30px; font-weight: 300">P</span>
            </div>
            <div class="d-flex flex-column button-close">
                <x-button class="toggle-left" size="sm" monochrome outline iconRight="burger-menu-svgrepo-com"></x-button>
            </div>
        </div>
    </header>
    <div class="d-flex flex-column menu-bar justify-content-between h-100 w-100">
        <div class="menu d-flex flex-row w-100">
            <div class="d-flex flex-column gap-4 w-100 ps-4 pt-3">
                <div class="d-flex flex-row justify-content-start align-items-center w-100">
                    <a href="{{route('categories.index')}}" class="d-flex flex-row gap-2 align-items-center w-100">
                        <i class="bx bx-category icon fs-5"></i>
                        <span class="d-flex flex-column text nav-text">Категории</span>
                    </a>
                </div>
                <div class="d-flex flex-row justify-content-start align-items-center w-100">
                    <a href="{{ route('products.index') }}" class="d-flex flex-row gap-2 align-items-center w-100">
                        <i class="bx bx-laptop icon fs-5"></i>
                        <span class="d-flex flex-column text nav-text">Товары</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="d-flex flex-row bottom-content">
            <div class="d-flex flex-column gap-3 w-100 ps-4 pb-3">
                <div class="d-flex flex-row justify-content-start align-items-center w-100">
                    <a href="{{ route('dashboard') }}" class="d-flex flex-row gap-2 align-items-center w-100">
                        <i class="bx bx-home-alt icon fs-5"></i>
                        <span class="d-flex flex-column text nav-text">Главная</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

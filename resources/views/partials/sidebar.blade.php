@php
    use Illuminate\Support\Facades\Route;
@endphp

<style>
    /* ==== SIDEBAR STYLE ==== */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 240px;
        background: linear-gradient(180deg, #1e293b, #0f172a);
        color: #f1f5f9;
        padding: 20px 0;
        box-shadow: 2px 0 10px rgba(0,0,0,0.2);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s ease-in-out;
    }

    .sidebar h4 {
        text-align: center;
        font-weight: 700;
        color: #38bdf8;
        margin-bottom: 30px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        color: #cbd5e1;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
    }

    .sidebar a:hover {
        background: rgba(255,255,255,0.08);
        color: #fff;
        border-left: 4px solid #38bdf8;
    }

    .sidebar a.active {
        background: rgba(56,189,248,0.2);
        color: #fff;
        border-left: 4px solid #38bdf8;
    }

    .sidebar i {
        font-size: 1.1rem;
    }

    /* ==== LOGOUT BUTTON ==== */
    .sidebar form {
        padding: 20px;
        border-top: 1px solid rgba(255,255,255,0.1);
        text-align: center;
    }

    .sidebar button.btn-danger {
        width: 100%;
        background: #ef4444;
        border: none;
        font-weight: 600;
        transition: 0.2s;
    }

    .sidebar button.btn-danger:hover {
        background: #dc2626;
        transform: scale(1.03);
    }

    /* ==== RESPONSIVE ==== */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            flex-direction: column;
        }
    }
</style>

<div class="sidebar">
    <div>
        <h4><i class="bi bi-speedometer2"></i> My Dashboard</h4>

        @if(Route::has('dashboard'))
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
        @else
            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
        @endif

        <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>

        @if(Route::has('categories.index'))
            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Categories
            </a>
        @endif

        <a href="{{ route('supplier.index') }}" class="{{ request()->routeIs('supplier.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i> Suppliers
        </a>

        <a href="{{ route('transaksi_penjualan.index') }}" class="{{ request()->routeIs('transaksi_penjualan.*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i> Transaksi Penjualan
        </a>
    </div>

    @if(Route::has('logout'))
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    @endif
</div>

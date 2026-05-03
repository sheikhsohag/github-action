<style>
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .topbar-brand {
        font-size: 18px;
        font-weight: bold;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .notification-icon {
        position: relative;
        cursor: pointer;
        font-size: 20px;
        color: #fff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .notification-icon:hover {
        color: #ddd;
    }

    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: #e74c3c;
        color: #fff;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 10px;
        min-width: 16px;
        text-align: center;
    }
</style>

<div class="topbar">
    <div class="topbar-brand">
        <a href="{{ url('/') }}" style="color: inherit; text-decoration: none;">MyApp</a>
    </div>
    <div class="topbar-right">
        <a href="#" class="notification-icon" title="Notifications">
            &#128276;
            <span class="notification-badge">3</span>
        </a>
    </div>
</div>

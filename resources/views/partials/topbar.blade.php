<style>
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

    .notification-wrapper {
        position: relative;
    }

    .notification-icon {
        position: relative;
        cursor: pointer;
        font-size: 20px;
        color: #fff;
        text-decoration: none;
        transition: color 0.3s;
        background: none;
        border: none;
        padding: 5px;
    }

    .notification-icon:hover {
        color: #ddd;
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #fdfbfb;
        color: green;
        border-radius: 50%;
        padding: 2px 3px;
        font-size: 10px;
        width: 16px;
        height: 16px;
        text-align: center;
        line-height: 1.2;
    }

    .notification-dropdown {
        --dropdown-width: 300px;
        --dropdown-max-height: 400px;
        --dropdown-font-size: 13px;
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        background-color: #fff;
        color: #333;
        min-width: 200px;
        max-width: 600px;
        width: var(--dropdown-width);
        min-height: 150px;
        max-height: var(--dropdown-max-height);
        overflow: auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
        margin-top: 10px;
        z-index: 1000;
        font-size: var(--dropdown-font-size);
        resize: both;
    }

    .notification-dropdown::-webkit-resizer {
        background: linear-gradient(135deg, transparent 50%, #999 50%, #999 60%, transparent 60%, transparent 70%, #999 70%, #999 80%, transparent 80%);
        border-radius: 0 0 8px 0;
    }

    .notification-dropdown.show {
        display: block;
    }

    .notification-dropdown-header {
        padding: 12px 15px;
        border-bottom: 1px solid #eee;
        font-weight: bold;
        font-size: 14px;
        color: #333;
    }

    .notification-item {
        padding: 12px 15px;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-item-title {
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 4px;
        color: #333;
    }

    .notification-item-text {
        font-size: 12px;
        color: #666;
        margin-bottom: 4px;
    }

    .notification-item-time {
        font-size: 11px;
        color: #999;
    }

    .notification-empty {
        padding: 20px;
        text-align: center;
        color: #999;
        font-size: 13px;
    }
</style>

<div class="topbar">
    <div class="topbar-brand">
        <a href="{{ url('/') }}" style="color: inherit; text-decoration: none;">MyApp</a>
    </div>
    <div class="topbar-right">
        <div class="notification-wrapper">
            <button class="notification-icon" id="notificationBtn" title="Notifications">
                &#128276;
                <span class="notification-badge" id="notificationCount">6</span>
            </button>
            <div class="notification-dropdown" id="notificationDropdown">
                <div class="notification-dropdown-header">Notifications</div>
                <div id="notificationList">
                    <div class="notification-item">
                        <div class="notification-item-title">New User Registered</div>
                        <div class="notification-item-text">John Doe has created a new account.</div>
                        <div class="notification-item-time">2 minutes ago</div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-item-title">Order Completed</div>
                        <div class="notification-item-text">Order #12345 has been successfully processed.</div>
                        <div class="notification-item-time">15 minutes ago</div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-item-title">System Update</div>
                        <div class="notification-item-text">A new system update is available.</div>
                        <div class="notification-item-time">1 hour ago</div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-item-title">Payment Received</div>
                        <div class="notification-item-text">Payment of $250.00 has been received.</div>
                        <div class="notification-item-time">3 hours ago</div>
                    </div>
                    <div class="notification-item">
                        <div class="notification-item-title">New Comment</div>
                        <div class="notification-item-text">Sarah commented on your post.</div>
                        <div class="notification-item-time">5 hours ago</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('notificationBtn').addEventListener('click', function(e) {
        e.stopPropagation();
        var dropdown = document.getElementById('notificationDropdown');
        dropdown.classList.toggle('show');
    });

    document.addEventListener('click', function(e) {
        var dropdown = document.getElementById('notificationDropdown');
        if (!dropdown.contains(e.target) && e.target.id !== 'notificationBtn') {
            dropdown.classList.remove('show');
        }
    });
</script>

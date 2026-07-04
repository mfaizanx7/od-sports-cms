@extends(BaseHelper::getAdminMasterLayoutTemplate())
@section('content')
    <div id="dashboard-alerts">
        {!! apply_filters(DASHBOARD_FILTER_ADMIN_NOTIFICATIONS, null) !!}
    </div>

    <style>
        .welcome-dashboard-container {
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
        }

        .welcome-card {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(30, 41, 59, 0.95) 100%);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 20px;
            padding: 50px 60px;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            max-width: 800px;
            width: 100%;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 60%);
            animation: pulse-glow 8s infinite alternate ease-in-out;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes pulse-glow {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.1); opacity: 1; }
        }

        .welcome-icon {
            font-size: 64px;
            color: #3b82f6;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
            text-shadow: 0 0 40px rgba(59, 130, 246, 0.6);
            display: inline-block;
            background: linear-gradient(135deg, #60a5fa, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-title {
            font-size: 36px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
        }

        .welcome-title span {
            color: #3b82f6;
        }

        .welcome-subtitle {
            font-size: 18px;
            color: #94a3b8;
            margin-bottom: 40px;
            line-height: 1.6;
            position: relative;
            z-index: 1;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .welcome-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            position: relative;
            z-index: 1;
        }

        .btn-welcome {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-welcome:hover {
            background: #2563eb;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            color: white;
            text-decoration: none;
        }

        .btn-welcome-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: #e2e8f0;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-welcome-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }
        
        /* Stats row below welcome card */
        .dashboard-stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 40px;
            position: relative;
            z-index: 1;
        }
        
        .stat-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            background: rgba(30, 41, 59, 0.8);
            border-color: rgba(59, 130, 246, 0.3);
            transform: translateY(-3px);
        }
        
        .stat-icon {
            font-size: 24px;
            color: #60a5fa;
            margin-bottom: 12px;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
        }
        
        .stat-label {
            font-size: 13px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>

    <div class="welcome-dashboard-container">
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h1 class="welcome-title">WELCOME TO <span>ADMIN DASHBOARD</span></h1>
            <p class="welcome-subtitle">
                You are currently logged into the OD Sports management portal. From here, you have full control over your website's content, media, and platform settings.
            </p>
            
            <div class="welcome-actions">
                <a href="{{ route('admin.website-content.index') }}" class="btn-welcome">
                    <i class="fas fa-edit"></i> Manage Website Content
                </a>
                <a href="{{ route('public.index') }}" target="_blank" class="btn-welcome-secondary">
                    <i class="fas fa-external-link-alt"></i> View Live Site
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            @if (WidgetGroup::group('dashboard_sidebar')->getWidgets())
                <div class="dashboard-widgets-container" style="margin-top: 20px;">
                    {!! WidgetGroup::group('dashboard_sidebar')->render() !!}
                </div>
            @endif
        </div>
    </div>
@stop

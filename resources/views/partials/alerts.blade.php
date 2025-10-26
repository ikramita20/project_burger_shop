@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@section('styles')
<style>
    :root {
        --success-bg: rgba(126, 255, 180, 0.15);  
        --success-border: #2ecc71;               
        --success-text: #27ae60;                 
        --error-bg: rgba(231, 76, 60, 0.15);     
        --error-border: #e74c3c;
        --error-text: #c0392b;
    }

    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 350px;
        padding: 1.25rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(8px);
        border: none;
        border-left: 4px solid;
        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 9999;
        opacity: 1;
        transform: translateY(0);
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    .alert-success {
        background: var(--success-bg);
        border-left-color: var(--success-border);
        color: var(--success-text);
    }

    .alert-danger {
        background: var(--error-bg);
        border-left-color: var(--error-border);
        color: var(--error-text);
    }

    .alert.alert-hide {
        opacity: 0;
        transform: translateY(-100px);
    }

    .btn-close {
        padding: 0.5rem;
        opacity: 0.7;
        transition: opacity 0.2s ease;
        filter: brightness(0.7); /* Assombrit légèrement l'icône */
    }

    .btn-close:hover {
        opacity: 1;
        filter: brightness(1);
    }

    /* Animation spécifique pour le succès */
    .alert-success .btn-close {
        filter: brightness(0.6) sepia(1) hue-rotate(60deg) saturate(0.5);
    }

    @media (max-width: 576px) {
        .alert {
            width: calc(100% - 40px);
            left: 20px;
            right: 20px;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.classList.add('alert-hide');
                setTimeout(() => alert.remove(), 400);
            }, 2000);
            
            alert.querySelector('.btn-close').addEventListener('click', function() {
                alert.classList.add('alert-hide');
                setTimeout(() => alert.remove(), 400);
            });
        });
    });
</script>
@endsection
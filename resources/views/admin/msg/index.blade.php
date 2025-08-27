<script>
    // Automatically hide alert messages after 5 seconds (5000ms)
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000); // 5000ms = 5 seconds
</script>

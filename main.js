// main.js - Mock Backend Logic

document.addEventListener('DOMContentLoaded', () => {

    // Helper function to simulate a minimal, elegant alert
    function showNotification(message, type = 'success') {
        // Remove any existing notification
        const existingNotify = document.querySelector('.custom-notification');
        if (existingNotify) existingNotify.remove();

        // Create new notification element
        const notify = document.createElement('div');
        notify.className = `custom-notification ${type}`;
        notify.textContent = message;
        
        // Inline styles for minimal notification
        Object.assign(notify.style, {
            position: 'fixed',
            bottom: '40px',
            right: '40px',
            backgroundColor: type === 'success' ? 'var(--color-text)' : '#ff4c4c',
            color: '#fff',
            padding: '15px 30px',
            fontFamily: 'var(--font-body)',
            fontSize: '14px',
            letterSpacing: '1px',
            boxShadow: '0 10px 30px rgba(0,0,0,0.1)',
            zIndex: '9999',
            opacity: '0',
            transform: 'translateY(20px)',
            transition: 'all 0.4s ease'
        });

        document.body.appendChild(notify);

        // Animate in
        setTimeout(() => {
            notify.style.opacity = '1';
            notify.style.transform = 'translateY(0)';
        }, 10);

        // Remove after 3 seconds
        setTimeout(() => {
            notify.style.opacity = '0';
            notify.style.transform = 'translateY(20px)';
            setTimeout(() => notify.remove(), 400);
        }, 3000);
    }

    // --- Login Form Handler ---
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const email = document.getElementById('login-email').value;
            const password = document.getElementById('login-password').value;
            
            // Mock authentication logic
            const users = JSON.parse(localStorage.getItem('jewelry_users')) || [];
            const user = users.find(u => u.email === email && u.password === password);

            if (user) {
                // Simulate session
                localStorage.setItem('jewelry_session', JSON.stringify({ email: user.email, name: user.name }));
                showNotification('Welcome back, ' + user.name + '!', 'success');
                setTimeout(() => window.location.href = 'index.html', 1500);
            } else {
                showNotification('Invalid email or password.', 'error');
            }
        });
    }

    // --- Register Form Handler ---
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('register-name').value;
            const email = document.getElementById('register-email').value;
            const password = document.getElementById('register-password').value;

            const users = JSON.parse(localStorage.getItem('jewelry_users')) || [];
            
            if (users.find(u => u.email === email)) {
                showNotification('Account with this email already exists.', 'error');
                return;
            }

            // Save new user
            users.push({ name, email, password });
            localStorage.setItem('jewelry_users', JSON.stringify(users));

            showNotification('Account created successfully! Please log in.', 'success');
            setTimeout(() => window.location.href = 'login.html', 2000);
        });
    }

    // --- Contact Form Handler ---
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            // Just simulate a successful message send
            showNotification('Your message has been sent successfully.', 'success');
            contactForm.reset();
        });
    }

    // --- Profile Logout Handler ---
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            // Clear session data
            localStorage.removeItem('jewelry_session');
            showNotification('Logged out successfully.', 'success');
            setTimeout(() => {
                window.location.href = 'login.html';
            }, 1000);
        });
    }

});

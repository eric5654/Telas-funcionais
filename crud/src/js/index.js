// script.js

const loginTab = document.getElementById('loginTab');
const registerTab = document.getElementById('registerTab');
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const phoneInput = document.getElementById('registerPhone');
const phoneError = document.getElementById('phoneError');
const registerPassword = document.getElementById('registerPassword');
const confirmPassword = document.getElementById('confirmPassword');

// Function to toggle tabs
function toggleTabs(showForm, hideForm, showTab, hideTab) {
    showForm.classList.remove('hidden');
    hideForm.classList.add('hidden');
    showTab.classList.add('bg-blue-500', 'text-white');
    hideTab.classList.remove('bg-blue-500', 'text-white');
    hideTab.classList.add('bg-gray-200');
}

// Event listeners for tab switching
loginTab.addEventListener('click', () => {
    toggleTabs(loginForm, registerForm, loginTab, registerTab);
});

registerTab.addEventListener('click', () => {
    toggleTabs(registerForm, loginForm, registerTab, loginTab);
});

// Phone input formatting
phoneInput.addEventListener('input', (e) => {
    e.target.value = formatPhone(e.target.value.replace(/\D/g, '').slice(0, 11));
});

// Phone validation function
function validatePhone(phone) {
    return /^(\d{2})(\d{5})(\d{4})$/.test(phone);
}

// Phone formatting function
function formatPhone(phone) {
    if (!phone) return '';
    if (phone.length < 3) return phone;
    if (phone.length < 8) return phone.replace(/(\d{2})/, '($1) ');
    return phone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
}

// Form validation and submission
registerForm.addEventListener('submit', (e) => {
    e.preventDefault();
    let isValid = true;

    // Phone validation
    const phone = phoneInput.value.replace(/\D/g, '');
    if (!validatePhone(phone)) {
        phoneError.classList.remove('hidden');
        phoneError.textContent = "Telefone inválido. Use o formato (XX) XXXXX-XXXX";
        isValid = false;
    } else {
        phoneError.classList.add('hidden');
    }

    // Password validation
    if (registerPassword.value !== confirmPassword.value) {
        isValid = false;
        alert("As senhas não coincidem.");
    }

    if (isValid) {
        registerForm.submit();
    }
});
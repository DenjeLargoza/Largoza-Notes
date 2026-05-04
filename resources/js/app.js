// Show/hide password functionality
document.addEventListener('DOMContentLoaded', function () {
	const password = document.getElementById('password');
	const passwordConfirmation = document.getElementById('password_confirmation');
	const togglePassword = document.getElementById('toggle-password');
	const togglePasswordConfirmation = document.getElementById('toggle-password-confirmation');
	if (togglePassword && password) {
		togglePassword.addEventListener('click', function () {
			if (password.type === 'password') {
				password.type = 'text';
				togglePassword.textContent = 'Hide';
			} else {
				password.type = 'password';
				togglePassword.textContent = 'Show';
			}
		});
	}
	if (togglePasswordConfirmation && passwordConfirmation) {
		togglePasswordConfirmation.addEventListener('click', function () {
			if (passwordConfirmation.type === 'password') {
				passwordConfirmation.type = 'text';
				togglePasswordConfirmation.textContent = 'Hide';
			} else {
				passwordConfirmation.type = 'password';
				togglePasswordConfirmation.textContent = 'Show';
			}
		});
	}
});
// Real-time password match checker for registration form
document.addEventListener('DOMContentLoaded', function () {
	const password = document.getElementById('password');
	const passwordConfirmation = document.getElementById('password_confirmation');
	const message = document.getElementById('password-match-message');
	if (password && passwordConfirmation && message) {
		function checkMatch() {
			if (passwordConfirmation.value.length === 0) {
				message.textContent = '';
				message.className = 'text-sm mt-1';
				return;
			}
			if (password.value === passwordConfirmation.value) {
				message.textContent = 'Passwords match';
				message.className = 'text-green-600 text-sm mt-1';
			} else {
				message.textContent = 'Passwords do not match';
				message.className = 'text-red-600 text-sm mt-1';
			}
		}
		password.addEventListener('input', checkMatch);
		passwordConfirmation.addEventListener('input', checkMatch);
	}
});
//

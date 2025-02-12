//submit用ステータス確認関数
const fieldStates = {
	email: false,
	password: false,
	passwordconfirm: false,
	lastname: false,
	firstname: false,
	//	gender: false,
	address: false,
	// joinyear: false
};

const emailInput = document.getElementById('email');
const emailError = document.getElementById('emailError');
const passwordInput = document.getElementById('password');
const passwordError = document.getElementById('passwordError');
const passwordconfirmInput = document.getElementById('password_confirmation');
const passwordconfirmError = document.getElementById('passwordConfirmError');
const lastnameInput = document.getElementById('last_name');
const lastnameError = document.getElementById('lastNameError');
const firstnameInput = document.getElementById('first_name');
const firstnameError = document.getElementById('firstNameError');
//const seiInput = document.getElementById('sei');
//const seiError = document.getElementById('seiError');
const addressInput = document.getElementById('address');
const addressError = document.getElementById('addressError');
// const joinyearInput = document.getElementById('join_year');
// const joinyearError = document.getElementById('joinYearError');
const submitButton = document.querySelector('button[type="submit"]');

// email形式検証
function validateEmail(value) {
	const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
	return emailPattern.test(value.trim());
}

function validateemail() {
	const value = emailInput.value;

	if (value.trim() === '') {
		emailError.textContent = 'メールアドレスを入力してください。';
		fieldStates.email = false;
	}
	else if (!validateEmail(value)) {
		emailError.textContent = '正しい形式のメールアドレスを入力してください。';
		fieldStates.email = false;
	}
	else {
		emailError.textContent = '';
		fieldStates.email = true;
	}
	toggleSubmitButton();
}

function validatePassword() {
	const value = passwordInput.value;

	if (value.trim() === '') {
		passwordError.textContent = 'パスワードを入力してください';
		fieldStates.password = false;
	}
	else if (value.trim().length < 4) {
		passwordError.textContent = 'パスワードは4文字以上で入力してください';
		fieldStates.password = false;
	}
	else {
		passwordError.textContent = '';
		fieldStates.password = true;
	}
	toggleSubmitButton();
}

function validatePasswordConfirm() {
	const value = passwordconfirmInput.value;

	if (value === '') {
		passwordconfirmError.textContent = '確認用パスワードを入力してください';
		fieldStates.passwordconfirm = false;
	} else if (value !== passwordInput.value) {
		passwordConfirmError.textContent = 'パスワードが一致しません';
		fieldStates.passwordconfirm = false;
	} else {
		passwordConfirmError.textContent = '';
		fieldStates.passwordconfirm = true;
	}

	toggleSubmitButton();
}
function validateFirstName() {
	const value = firstnameInput.value;

	if (value.trim() === '') {
		firstnameError.textContent = '名前を入力してください';
		fieldStates.firstname = false;
	}
	else {
		firstnameError.textContent = '';
		fieldStates.firstname = true;
	}
	toggleSubmitButton();
}

function validateLastName() {
	const value = lastnameInput.value;

	if (value.trim() === '') {
		lastnameError.textContent = '苗字を入力してください';
		fieldStates.lastname = false;
	}
	else {
		lastnameError.textContent = '';
		fieldStates.lastname = true;
	}
	toggleSubmitButton();
}



//function validateGender() {
//	const value = seiInput.value;
//
//	if (value.trim() === '') {
//		seiError.textContent = '性別を選択してください';
//		fieldStates.gender = false;
//	}
//	else {
//		seiError.textContent = '';
//		fieldStates.gender = true;
//	}
//	toggleSubmitButton();
//}

function validateAddress() {
	const value = addressInput.value;

	if (value.trim() === '') {
		addressError.textContent = '住所を入力してください';
		fieldStates.address = false;
	}
	else {
		addressError.textContent = '';
		fieldStates.address = true;
	}
	toggleSubmitButton();
}

// function validateJoinYear() {
// 	const value = nenInput.value;

// 	if (value.trim() === '') {
// 		joinyearError.textContent = '入社年度を選択してください';
// 		fieldStates.joinyear = false;
// 	}
// 	else {
// 		joinyearError.textContent = '';
// 		fieldStates.joinyear = true;
// 	}
// 	toggleSubmitButton();
// }

function toggleSubmitButton() {
	const allValid = Object.values(fieldStates).every(state => state === true);
	submitButton.disabled = !allValid;
}

document.addEventListener('DOMContentLoaded', () => {
	validateemail();
	validatePassword();
	validatePasswordConfirm();
	validateLastName();
	validateFirstName();
	//	validateGender();
	validateAddress();
	// validateJoinYear();
});

emailInput.addEventListener('input', validateemail);
passwordInput.addEventListener('input', validatePassword);
passwordconfirmInput.addEventListener('input', validatePasswordConfirm);
lastnameInput.addEventListener('input', validateLastName);
firstnameInput.addEventListener('input', validateFirstName);

//seiInput.addEventListener('input', validateGender);

addressInput.addEventListener('input', validateAddress);
// joinyearInput.addEventListener('input', validateJoinYear);
